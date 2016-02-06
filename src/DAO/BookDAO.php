<?php

namespace MyBooks\DAO;

use MyBooks\Domain\Book;

class BookDAO extends DAO { 
    
    /**
     * @var \MicroCMS\DAO\AuthorDAO
     */
    private $AuthorDAO;

    public function setAuthorDAO(AuthorDAO $AuthorDAO) {
        $this->AuthorDAO = $AuthorDAO;
    }
    
    /**
     * Return a list of all books, sorted by date (most recent first).
     *
     * @return array A list of all books.
     */
    public function findAll() {
        $sql = "SELECT * from book order by book_id desc";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $books = array();
        foreach ($result as $row) {
            $bookId = $row['book_id'];
            $author = $row['auth_id'];
            $books[$bookId] = $this->buildDomainObject($row);
        }
        return $books;
        
    }
    
    /**
     * Returns an book matching the supplied id.
     *
     * @param integer $id The book id.
     *
     * @return \MyBooks\Domain\Book|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from book WHERE book_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No book matching id " . $id);
        }
    }   

    
    /**
     * Return a list of all author for an book, sorted by id (most recent last).
     *
     * @param integer $authorId The author id.
     *
     * @return array A list of all authors for the book.
     */
    public function findByAuthor($authorId) {
        // The associated author is retrieved only once
        $author = $this->authorDAO->find($authorId);

        // art_id is not selected by the SQL query
        // The author won't be retrieved during domain objet construction
        $sql = "select * from author where auth_id=?";
        $result = $this->getDb()->fetch($sql, array($authorId));

        // Convert query result to an array of domain objects
        $authors = array();
        foreach ($result as $row) {
            $authID = $row['auth_id'];
            $author = $this->buildDomainObject($row);
            // The associated article is defined for the constructed comment
            $author->setArticle($article);
            $authors[$authID] = $author;
        }
        return $authors;
        
    }
    
    
     /**
     * Creates an Book object based on a DB row.
     *
     * @param array $row The DB row containing Author data.
     * @return \MicroCMS\Domain\Author
     */
    protected function buildDomainObject($row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);
        $book->setAuthorId($row['auth_id']);
        
        return $book;
        
    }


}