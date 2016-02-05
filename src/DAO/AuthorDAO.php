<?php

namespace MyBooks\DAO;

use MyBooks\Domain\Book;
use MyBooks\Domain\Author;

class AuthorDAO extends DAO { 

    /**
     * @var \MyBooks\DAO\BookDAO
     */
    private $bookDAO;

    public function setBookDAO(BookDAO $bookDAO) {
        $this->BookDAO = $bookDAO;
    }

    /**
     * Return a list of all comments for an article, sorted by date (most recent last).
     *
     * @param integer $articleId The article id.
     *
     * @return array A list of all comments for the article.
     */
    public function findByBook($bookId) {
        // The associated book is retrieved only once
        $book = $this->BookDAO->find($bookId);

        // book_id is not selected by the SQL query
        // The book won't be retrieved during domain objet construction
        $sql = "select * from author where auth_id=?";
        $result = $this->getDb()->fetchAll($sql, array($bookId));

        // Convert query result to an array of domain objects
        $authors = array();
        foreach ($result as $row) {
            $authorId = $row['auth_id'];
            $author = $this->buildDomainObject($row);
            // The associated article is defined for the constructed comment
            $author->setBook($book);
            $authors[$authorId] = $author;
        }
        return $authors;
    }

    /**
     * Creates an Author object based on a DB row.
     *
     * @param array $row The DB row containing Comment data.
     * @return \MyBooks\Domain\author
     */
    protected function buildDomainObject($row) {
        $author = new Author();
        $author->setId($row['auth_id']);
        $author->setAuthFirstName($row['auth_first_name']);
        $author->setAuthLastName($row['auth_last_name']);

        if (array_key_exists('auth_id', $row)) {
            // Find and set the associated article
            $bookId = $row['book_id'];
            $book = $this->bookDAO->find($bookId);
            $author->setBook($book);
        }

        return $author;
    }

}