<?php

namespace App\Services;

use App\Databases\Database;

class InsertTableDataService
{
    public function insert($tableName, $data): void
    {
        $DB = new Database();
        $query = "INSERT INTO `$tableName` SET";

        foreach ($data as $key => $value) {
            $query .= " $key='$value',";
        }

        $query = substr($query, 0, -1);

        $DB->execute($query);
    }
}