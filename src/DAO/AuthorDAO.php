<?php

namespace MyBooks\DAO;

use MyBooks\Domain\Author;

class AuthorDAO extends DAO {

	/**
     * Returns the author matching the supplied id.
     *
     * @param integer $id.
     *
     * @return \MyBooks\Domain\Author|throws an exception if no matching author is found
     */
    public function find($id) {
        $sql = "SELECT * FROM author WHERE auth_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No author matching id " . $id);
    }

    /**
     * Creates an Author object based on a DB row.
     *
     * @param array $row The DB row containing Author data.
     *
     * @return \MyBooks\Domain\Author.
     */
    protected function buildDomainObject($row) {
        $author = new Author();
        $author->setId($row['auth_id']);
        $author->setFirstName($row['auth_first_name']);
        $author->setLastName($row['auth_last_name']);
        return $author;
    }
}
