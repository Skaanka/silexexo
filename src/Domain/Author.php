<?php

namespace MyBooks\Domain;

class Author {

    /**
     * Author id.
     *
     * @var integer
     */
    private $id;

    /**
     * Book author first name
     *
     * @var string
     */
    private $firstName;

    /**
     * Book author last name.
     *
     * @var string
     */
    private $lastName;



    public function getId() {
        return $this->authorId;
    }

    public function setId($authorId) {
        $this->authorId = $authorId;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }


    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

}
