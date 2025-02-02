<?php

class Users extends Wayfinder {

    private $_stuff, $_db;

    function __construct() {
        $this->load('libraries', 'db');
        $this->_db = new Db();
    }

    public function getUsers() {
        //$sql = "SELECT * FROM users ORDER BY id ASC";
        //return $this->_db->query($sql);
        return [
            'cchana' => [
                'handle' => 'cchana',
                'name' => 'Chaz',
                'color' => 'orangered',
                'hash' => '7aabb61a65ff8cb0ae5c09a5f3682a22',
                'id' => 1
            ],
            'rchana' => [
                'handle' => 'rchana',
                'name' => 'Ranj',
                'color' => 'deeppink',
                'hash' => '9d82166bbc1ade777906e8db8e753d29',
                'id' => 2
            ],
            'akbhatti' => [
                'handle' => 'akbhatti',
                'name' => 'Amandeep',
                'color' => 'crimson',
                'hash' => 'c049da31e0c254bec70dcf62aee3033b',
                'id' => 3
            ],
            'abhatti' => [
                'handle' => 'abhatti',
                'name' => 'Aman',
                'color' => 'rebeccapurple',
                'hash' => 'c109a8d27979c89ed085f72471684d07',
                'id' => 4
            ]
        ];
    }

    public function getUser($id) {
        $users = $this->getUsers();
        //$pos = array_search($id, array_column($users, 'id'));
        foreach($users as $user => $data) {
            if($data['id'] == $id) {
                return $users[$user];
            }
        }
    }

    public function updateSelf() {

    }

}
