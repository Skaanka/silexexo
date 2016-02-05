<?php

namespace MyBooks\Domain;

class Author {
    
    /**
     * Book id.
     *
     * @var integer
     */
    private $id;

    /**
     * Book author first name
     *
     * @var string
     */
    private $auth_first_name;

    /**
     * Book autho last name.
     *
     * @var string
     */
    private $auth_last_name;
    
    /**
     * associated article
     *
     * @var \MyBooks\Domain\Book
     */
    private $book;
    

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAuthFirstName() {
        return $this->auth_first_name;
    }

    public function setAuthFirstName($auth_first_name) {
        $this->auth_first_name = $auth_first_name;
    }

    
    public function getAuthLastName() {
        return $this->auth_last_name;
    }

    public function setAuthLastName($auth_last_name) {
        $this->auth_last_name = $auth_last_name;
    }
    
    //association avec un livre via $book
    
    public function getBook() {
        return $this->book;
    }

    public function setBook(Book $book) {
        $this->book = $book;
    }

}
