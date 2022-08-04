<?php

namespace App\Controllers;

use App\Services\Tasks\CreateTasksTableService;
use App\Services\Users\CreateAdminService;
use App\Services\Users\CreateUsersTableService;

class MigrationController
{
    public function migrate (): void
    {
        (new CreateTasksTableService())->create();
        (new CreateUsersTableService())->create();
        (new CreateAdminService())->create();
    }
}