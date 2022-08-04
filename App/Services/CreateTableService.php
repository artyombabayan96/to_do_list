<?php

namespace App\Services;

use App\Databases\Database;

class CreateTableService
{
    public function create(string $tableName, array $schema): void
    {
        $DB = new Database();
        $query = "CREATE TABLE IF NOT EXISTS `$tableName` (";

        foreach ($schema as $key => $value) {
            $query .= $key . " " . $value . ",";
        }

        $query = substr($query, 0, -1);
        $query .= ")";

        $DB->execute($query);
    }
}