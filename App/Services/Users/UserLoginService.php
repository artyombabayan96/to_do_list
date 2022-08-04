<?php

namespace App\Services\Users;

use App\Consts\UserConsts;
use App\Databases\Database;

class UserLoginService
{
    public function login($data): array
    {
        $DB = new Database();

        $query = "SELECT * FROM ";
        $query .= UserConsts::USERS_TABLE_NAME . " WHERE ";
        $query .= "username ='" . $data['username'] . "'";

        $answer = $DB->query($query);

        $result = [];

        if (isset($answer[0])) {

            if (password_verify($data['password'], $answer[0]['password'])) {

                $result['authorized'] = true;
                $result['username'] = $answer[0]['username'];
            } else {

                $result['authorized'] = false;
            }
        } else {

            $result['authorized'] = false;
        }

        return $result;
    }
}