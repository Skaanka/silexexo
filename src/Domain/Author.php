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
    * Author first name.
    *
    * @var string
    */
    private $authFirstName;
    
    /**
    * Author last name.
    *
    * @var string
    */
    private $authLastName;
    
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getFirstName() {
        return $this->authFirstName;
    }

    public function setFirstName($authFirstName) {
        $this->authFirstName = $authFirstName;
    }
    
    public function getLastName() {
        return $this->authLastName;
    }

    public function setLastName($authLastName) {
        $this->authLastName = $authLastName;
    }
    
    

}