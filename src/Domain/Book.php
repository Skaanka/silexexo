<?php

namespace MyBooks\Domain;

class Book {
    
    /**
     * Book id.
     *
     * @var integer
     */
    private $id;

    /**
     * Book title.
     *
     * @var string
     */
    private $title;

    /**
     * Book isbn.
     *
     * @var string
     */
    private $isbn;
    
    /**
     * Book summary.
     *
     * @var string
     */
    private $summary;
    
    /**
     * Book id Author.
     *
     * @var integer
     */
    private $author;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    
    public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }
    
    public function getSummary() {
        return $this->summary;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }

    public function getAuth() {
        return $this->auth_id;
    }

    public function setAuth($author) {
        $this->auth_id = $author;
    }
}
