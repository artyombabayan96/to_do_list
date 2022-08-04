<?php

namespace App\Services\Tasks;

use App\Consts\TaskConsts;
use App\Services\InsertTableDataService;

class CreateTaskService
{
    public function create(array $data): void
    {
        (new InsertTableDataService())->insert(TaskConsts::TASKS_TABLE_NAME, $data);
    }
}