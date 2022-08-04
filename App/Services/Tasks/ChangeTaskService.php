<?php

namespace App\Services\Tasks;

use App\Consts\TaskConsts;
use App\Databases\Database;

class ChangeTaskService
{
    public function change(array $data): void
    {
        $DB = new Database();
        $tableName = TaskConsts::TASKS_TABLE_NAME;
        $primaryKey = TaskConsts::TASKS_ID_COLUMN_NAME;

        $query = "UPDATE `$tableName` SET ";

        $query .= "task ='" . $data['task'] . "'";
        $query .= ",status ='" . $data['status'] . "'";
        $query .= " WHERE " . $primaryKey . "='" . $data['task_id'] . "'";

        $DB->execute($query);
    }
}