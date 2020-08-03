<?php

/**
 * Aici se modifica bd-ul , cu acces dat prin controller
 */

namespace BookStore\repository;

use BookStore\service\DatabaseConnectionService;
use BookStore\service\BookStoreService;
use PDO;

use BookStore\model\Book;

class BookStoreRepository
{

    public PDO $connection;
    public DatabaseConnectionService $databaseConnectionService;


    public function __construct()
    {
        $this->databaseConnectionService = new DatabaseConnectionService();
        $this->connection                = $this->databaseConnectionService->databaseInstance();
    }


    public function getAllBooks()
    {
        $sql       = 'SELECT * FROM books';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $books = $statement->fetchAll(PDO::FETCH_CLASS, Book::class);

        return $books;
    }

    public function getBookById($values)
    {
        $sql       = 'SELECT * FROM books WHERE id = :id';
        $statement = $this->connection->prepare($sql);
        DatabaseConnectionService::PDOBindArray($statement, $values);
        $statement->execute();
        $book = $statement->fetchAll(PDO::FETCH_CLASS, Book::class)[0];
        if ( ! $book) {
            return false;
        } else {
            return $book;
        }
    }

    public function updateAuthor($authorData)
    {
        $statement = $this->connection->prepare(
            '
            UPDATE author
                SET
                   name = :author_name

                WHERE
                    book_id = :book_id
            '
        );
        DatabaseConnectionService::PDOBindArray($statement, $authorData);
        $statement->execute();
    }

    public function updatePublisher($publisherData)
    {
        $statement = $this->connection->prepare(
            '
            UPDATE publisher
                SET
                   name = :publisher_name

                WHERE
                    book_id = :book_id
            '
        );
        DatabaseConnectionService::PDOBindArray($statement, $publisherData);
        $statement->execute();
    }

    public function updateBook($values)
    {
        $sanitizedValues = BookStoreService::sanitizeInput($values);

        if ( ! $sanitizedValues) {
            return false;
        } else {
            $statement = $this->connection->prepare(
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

            $authorData    = [
                'book_id'     => $sanitizedValues['id'],
                'author_name' => $sanitizedValues['author_name'],
            ];
            $publisherData = [
                'book_id'        => $sanitizedValues['id'],
                'publisher_name' => $sanitizedValues['publisher_name'],
            ];
            self::updateAuthor($authorData);
            self::updatePublisher($publisherData);


            return $statement;
        }
    }

    public function deleteBookById($values)
    {
        $values    = ['id' => $_GET['id']];
        $statement = $this->connection->prepare(
            'DELETE books, author, publisher FROM books INNER JOIN author INNER JOIN publisher
WHERE books.id=author.book_id AND author.book_id=publisher.book_id AND books.id = :id'
        );
        DatabaseConnectionService::PDOBindArray($statement, $values);
        $statement->execute();

        return $statement;
    }

    public function saveNewBook($values)
    {
        if ( ! BookStoreService::sanitizeInput($values)) {
            return false;
        } else {
            $statement = $this->connection->prepare(
                'INSERT INTO books(title,author_name,publisher_name,publish_year,created_at) 
        VALUES (:title, :author_name, :publisher_name, :publish_year, NOW())'
            );

            DatabaseConnectionService::PDOBindArray($statement, $values);
            $statement->execute();

            $lastGeneratedId = $this->connection->lastInsertId();

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


    public function saveAuthor($authorData)
    {
        $statement = $this->connection->prepare(
            'INSERT INTO author (name,book_id) 
        VALUES (:name,:book_id)'
        );
        DatabaseConnectionService::PDOBindArray($statement, $authorData);


        $statement->execute();
    }

    public function savePublisher($publisherData)
    {
        $statement = $this->connection->prepare(
            'INSERT INTO publisher (name,book_id) 
        VALUES (:name, :book_id)'
        );
        DatabaseConnectionService::PDOBindArray($statement, $publisherData);
        $statement->execute();
    }


}