<?php

use PDO;

class Db
{
    private $db;

    public function __construct()
    {
        $dbinfo = require '/config/database.php';
        $this->db = new \PDO('mysql:dbname=' . $dbinfo['dbname'] . ';host=' . $dbinfo['host'], $dbinfo['login'],$dbinfo['password']);
    }

    public function query(string $sql, $params = []): array
    {
        $stmt = $this->db->prepare($sql);
        if ( !empty($params) ) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }
       $stmt->execute();
       return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(string $sql,array $params = []): array
    {
        return $this->query($sql, $params);
    }
}