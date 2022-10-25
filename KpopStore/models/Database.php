<?php

namespace Models;

require('config/config.php');

class Database {

    protected $bdd;

    public function __construct() {
        $this->bdd = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }

    protected function findAll($req, $params = []) {
        $query = $this->bdd->prepare($req);
        $query->execute($params);
        return $query->fetchAll();
    }

    protected function getOneById($table, $pre, $id) {
        $query = $this->bdd->prepare("SELECT * FROM " . $table . " WHERE ". $pre ."id = ?");
        $query->execute([$id]);
        $data = $query->fetch();
        $query->closeCursor(); 
        return $data;
    }

    protected function getAllById($table, $columnId, $id, $orderBy="") {
        $query = $this->bdd->prepare("SELECT * FROM " . $table . " WHERE ". $columnId ." = ? " . $orderBy);
        $query->execute([$id]);
        $data = $query->fetchAll();
        $query->closeCursor();
        return $data;
    }

    protected function getOneByEmail($table, $email) {
        $query = $this->bdd->prepare("SELECT * FROM " . $table . " WHERE user_mail = ?");
        $query->execute([$email]);
        $data = $query->fetch();
        $query->closeCursor();
        return $data;
    }

    // protected function addProduct(string $table, string $columns, string $values, $data ) {
    //     $query = $this->bdd->prepare('INSERT INTO ' . $table . '(' . $columns . ') values (' . $values . ')');
    //     $query->execute($data);
    //     $query->closeCursor();
    // }

    protected function addProduct(string $table, string $columns, string $values,string $origin, string $foreign, string $table2,$data ) {
        $query = $this->bdd->prepare('INSERT INTO ' . $table . '(' . $columns . ') values (' . $values . ')');
        $query = $this->bdd->$origin->references($foreign)->on($table2);
        $query->execute($data);
        $query->closeCursor();
    }

   
} 

