<?php

class Users extends Wayfinder {

    private $_stuff, $_db;

    function __construct() {
        $this->load('libraries', 'db');
        $this->_db = new Db();
    }

    public function getUsers() {
        $sql = "SELECT * FROM users ORDER BY id ASC";
        return $this->_db->query($sql);
    }

    public function getUser() {

    }

    public function updateSelf() {

    }

}
