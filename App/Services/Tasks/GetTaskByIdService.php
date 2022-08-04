<?php

namespace App\Services\Tasks;

use App\Consts\TaskConsts;
use App\Services\GetTableDataService;

class GetTaskByIdService
{
    public function get($task_id): array
    {
        return (new GetTableDataService())->getByID(TaskConsts::TASKS_TABLE_NAME, TaskConsts::TASKS_ID_COLUMN_NAME, $task_id);
    }
}