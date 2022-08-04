<?php

namespace App\Services\Users;

use App\Consts\UserConsts;
use App\Models\User;
use App\Services\CreateTableService;

class CreateUsersTableService
{
    public function create(): void
    {
        $schema = (new User())->getSchema();

        (new CreateTableService())->create(UserConsts::USERS_TABLE_NAME, $schema);
    }
}