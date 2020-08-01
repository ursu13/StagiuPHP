<?php


class Author
{
    public int $id;
    public int $book_id;
    public int $name;

    /**
     * Gett-eri si sett-eri initiali, ganditi ptr altceva, ce nu am reusit sa implementez
     *
     */
    public function setName($name){
        $this->name=$name;
    }
    public function getName(){
        return $this->name;
    }

    public function setBookId($bookId){
        $this->book_id=$bookId;
    }
    public function getBookId(){
        return $this->book_id;
    }


}