<?php

require_once("./config.php");

class DB
{
    private $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->mysqli->connect_errno) {
            printf("Connect failed: %s\n", $this->mysqli->connect_error);
            exit();
        }
    }

    public function getResults($query)
    {
        $result = $this->mysqli->query($query);

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    public function getCount($query){
        $result = $this->getResults($query);
        return $result[0]["c"];
    }

    public function query($query){
        $this->mysqli->query($query);
        return $this->mysqli->insert_id;
    }
}