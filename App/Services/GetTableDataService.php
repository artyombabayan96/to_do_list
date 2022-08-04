<?php

namespace App\Services;

use App\Databases\Database;

class GetTableDataService
{
    public function getCount($DB, $tableName): int
    {
        $query = "SELECT COUNT(*) as count FROM $tableName";

        $count = +$DB->query($query)[0]['count'];

        return $count;
    }

    public function getByID(string $tableName, string $primaryKey, string $primaryKeyValue): array
    {
        $DB = new Database();
        $query = "SELECT * FROM $tableName WHERE $primaryKey=$primaryKeyValue";

        $data = $DB->query($query);

        if (isset($data[0])) {
            return $data[0];
        } else {
            return [];
        }
    }

    public function get(string $tableName, array $columns, string $orderColumn = '', string $order ='', int $page=1, int $chunk=3): array
    {
        $DB = new Database();

        $count = $this->getCount($DB, $tableName);
        $pagesCount = intval(ceil($count/3));

        $_COOKIE['pages_count'] = $pagesCount;
        setcookie('pages_count', $pagesCount, 0, "/");

        $query = "SELECT ";

        foreach ($columns as $column) {
            $query .= "$column,";
        }

        if (str_ends_with($query, ',')){
            $query = substr($query, 0, -1);
        }

        $query .= " FROM " . "$tableName";

        if ($orderColumn != '') {
            $query .= " ORDER BY $orderColumn";
        }

        if ($order != '') {
            $query .= " $order";
        }

        $query .= " LIMIT " . ($page - 1) * $chunk. "," . $chunk;

        $data = $DB->query($query);

        return $data;
    }
}