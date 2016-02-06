<?php

namespace MyBooks\DAO;

use MyBooks\Domain\Author;

class AuthorDAO extends DAO { 

    /**
     * Return a list of all authors, sorted by id (most recent first).
     *
     * @return array A list of all authors.
     */
    public function findAll() {
        $sql = "SELECT * from author order by auth_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $authors = array();
        foreach ($result as $row) {
            $authorId = $row['auth_id'];
            $authors[$authorId] = $this->buildDomainObject($row);
        }
        return $authors;

    }
    
    /**
     * Returns an Author matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MicroCMS\Domain\Author|throws an exception if no matching author is found
     */
    public function find($id) {
        $sql = "select * from author where auth_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row) {
            return $this->buildDomainObject($row);
        } else {
            throw new \Exception("No author matching id " . $id);
        }
    }

    
    /**
     * Creates an author object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \MyBooks\Domain\Auhtor
     */
    protected function buildDomainObject($row) {
        $author = new Author();
        $author->setId($row['auth_id']);
        $author->setFirstName($row['auth_first_name']);
        $author->setLastName($row['auth_last_name']);
        return $author;
    }
    
}