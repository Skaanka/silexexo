<?php

namespace MyBooks\DAO;

use MyBooks\Domain\Book;

class BookDAO extends DAO { 

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

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No book matching id " . $id);
    }   

    
    
     /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \MicroCMS\Domain\Article
     */
    protected function buildDomainObject($row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);
        $book->setAuth($row['auth_id']);
        return $book;
    }

}