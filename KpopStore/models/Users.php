<?php

namespace Models;


class Users extends Database {

    public function getAllUsers() {
        $req = "SELECT *	
                FROM users
                ORDER BY id
                LIMIT 20 ";
        return $this->findAll($req);
    }
}
