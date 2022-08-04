<?php

namespace App\Databases;

use PDO;
use App\Config\Configuration;

class Database
{

    private mixed $link;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $dsn =
            'mysql:host='.Configuration::DB_HOST.
            ';dbname='.Configuration::DB_DATABASE.
            ';charset='.Configuration::DB_CHARSET;

        $this->link = new PDO($dsn, Configuration::DB_USERNAME, Configuration::DB_PASSWORD);

        return $this;
    }

    public function execute($sql)
    {
        $sth = $this->link->prepare($sql);

        return $sth->execute();
    }

    public function query($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false) {
            return [];
        }

        return  $result;
    }
}





