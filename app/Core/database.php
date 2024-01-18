<?php

namespace app\Core;

use PDO;

// connect to MySQL DB and execute a query
class Database {

    public $connection;
    public $query;


    public function __construct($config, $username = 'root', $pwd = '1111') {

        $dsn = "mysql:" . http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $username, $pwd,
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

    }

    public function query($query, $params = []) {
        // preparing safe queries

        $this->query = $this->connection->prepare($query);
        $this->query->execute($params);

        return $this;

    }

    public function getLastInsertedId() { //  Сомнительно, но окЭй
        return intval($this->connection->lastInsertId());
    }

    public function getAll() {
        return $this->query->fetchAll();
    }

    public function find() {
        return $this->query->fetch();
    }

    public function findOrFail() {
        $result = $this->find();

        // returns page not found (no such element)
        
        if (! $result) {
            abort();
        }

        return $result;
    }
}

