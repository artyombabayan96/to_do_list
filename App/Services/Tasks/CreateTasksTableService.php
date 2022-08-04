<?php

namespace App\Services\Tasks;

use App\Consts\TaskConsts;
use App\Models\Task;
use App\Services\CreateTableService;

class CreateTasksTableService
{
    public function create(): void
    {
        $schema = (new Task())->getSchema();

        (new CreateTableService())->create(TaskConsts::TASKS_TABLE_NAME, $schema);
    }
}