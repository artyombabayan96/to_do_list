<?php

namespace App\Services\Tasks;

use App\Consts\TaskConsts;
use App\Services\GetTableDataService;

class GetTasksService
{
    public function get(string $order_column='', string $order='', int $page=1, int $chunk=3): array
    {
        return (new GetTableDataService())->get(TaskConsts::TASKS_TABLE_NAME, TaskConsts::TASKS_TABLE_COLUMNS, $order_column, $order, $page, $chunk);
    }
}