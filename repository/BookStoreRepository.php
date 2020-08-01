<?php

/**
 * Aici se modifica bd-ul , cu acces dat prin controller
 */
class BookStoreRepository
{
    public static function getAllBooks()
    {
        $connection = DatabaseConnectionService::databaseInstance();

        $sql       = 'SELECT * FROM books';
        $statement = $connection->prepare($sql);
        $statement->execute();

        $books = $statement->fetchAll(PDO::FETCH_CLASS, Book::class);

        return $books;
    }

    public static function getBookById($values)
    {
        $connection = DatabaseConnectionService::databaseInstance();

        $sql       = 'SELECT * FROM books WHERE id = :id';
        $statement = $connection->prepare($sql);
        DatabaseConnectionService::PDOBindArray($statement, $values);
        $statement->execute();
        $book = $statement->fetchAll(PDO::FETCH_CLASS, Book::class)[0];
        if ( ! $book) {
            return false;
        } else {
            return $book;
        }
    }

    public static function updateBook($values)
    {
        $connection      = DatabaseConnectionService::databaseInstance();
        $sanitizedValues = BookStoreService::sanitizeInput($values);

        if ( ! $sanitizedValues) {
            return false;
        } else {
            $statement = $connection->prepare(
                '
            UPDATE books
                SET 
                    title = :title, 
                    author_name = :author_name,
                    publisher_name = :publisher_name, 
                    publish_year = :publish_year, 
                    updated_at = NOW()
                WHERE 
                    id = :id
            '
            );
            DatabaseConnectionService::PDOBindArray($statement, $sanitizedValues);
            $statement->execute();

            return $statement;
        }
    }

    public static function deleteBookById($values)
    {
        $connection = DatabaseConnectionService::databaseInstance();
        $values     = ['id' => $_GET['id']];
//DELETE cu join
        $statement = $connection->prepare(
            'DELETE books, author, publisher FROM books INNER JOIN author INNER JOIN publisher
WHERE books.id=author.book_id AND author.book_id=publisher.book_id AND books.id = :id'
        );


        DatabaseConnectionService::PDOBindArray($statement, $values);
        $statement->execute();

        return $statement;
    }

    public static function saveNewBook($values)
    {
        if ( ! BookStoreService::sanitizeInput($values)) {
            return false;
        } else {
            $connection = DatabaseConnectionService::databaseInstance();
            $statement  = $connection->prepare(
                'INSERT INTO books(title,author_name,publisher_name,publish_year,created_at) 
        VALUES (:title, :author_name, :publisher_name, :publish_year, NOW())'
            );


            DatabaseConnectionService::PDOBindArray($statement, $values);
            $statement->execute();


            $lastGeneratedId = $connection->lastInsertId();

            header('Location: /?' . $lastGeneratedId);

            $authorData    = [
                'book_id' => $lastGeneratedId,
                'name'    => $values['author_name'],
            ];
            $publisherData = [
                'book_id' => $lastGeneratedId,
                'name'    => $values['publisher_name'],
            ];


            self::saveAuthor($authorData);
            self::savePublisher($publisherData);

            return $statement;
        }
    }


    public static function saveAuthor($authorData)
    {
        $connection = DatabaseConnectionService::databaseInstance();
        $statement  = $connection->prepare(
            'INSERT INTO author (name,book_id) 
        VALUES (:name,:book_id)'
        );
        DatabaseConnectionService::PDOBindArray($statement, $authorData);


        $statement->execute();
    }

    public static function savePublisher($publisherData)
    {
        $connection = DatabaseConnectionService::databaseInstance();
        $statement  = $connection->prepare(
            'INSERT INTO publisher (name,book_id) 
        VALUES (:name, :book_id)'
        );
        DatabaseConnectionService::PDOBindArray($statement, $publisherData);
        $statement->execute();
    }


}