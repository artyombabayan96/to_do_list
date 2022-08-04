<?php

namespace App\Services\Users;

use App\Consts\UserConsts;
use App\Databases\Database;
use App\Services\GetTableDataService;
use App\Services\InsertTableDataService;

class CreateAdminService
{
    public function create(): void
    {
        $DB = new Database();

        if(
            (new GetTableDataService())->getCount($DB,UserConsts::USERS_TABLE_NAME) !== 1
        ) {
            $hashedPassword = password_hash(UserConsts::USERS_DEFAULT_PASSWORD, PASSWORD_DEFAULT);

            (new InsertTableDataService())->insert(UserConsts::USERS_TABLE_NAME, [
                'username' => UserConsts::USERS_DEFAULT_USERNAME,
                'password' => $hashedPassword,
            ]);
        }

    }
}