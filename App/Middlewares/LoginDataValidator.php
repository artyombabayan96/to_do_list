<?php

namespace App\Middlewares;

use App\Consts\UserConsts;

class LoginDataValidator
{
    private string $warnings = '';

    private function checkDataCompletion($data): void
    {
        if (!isset($data['username']) || $data['username'] === '') {
            $this->warnings .= UserConsts::AUTH_USERNAME_EMPTY_MESSAGE . '<br>';
        }
        if (!isset($data['password']) || $data['password'] === '') {
            $this->warnings .= UserConsts::AUTH_PASSWORD_EMPTY_MESSAGE . '<br>';
        }
    }

    public function checkDataValidation($data): void
    {
        if (strlen($data['username']) < 2 or strlen($data['username']) > 36) {
            $this->warnings .= UserConsts::AUTH_USERNAME_VALIDATION_MESSAGE . '<br>';
        }
        if (strlen($data['password']) < 2 or strlen($data['password']) > 36) {
            $this->warnings .= UserConsts::AUTH_PASSWORD_VALIDATION_MESSAGE . '<br>';
        }
    }

    public function validate($data): string
    {
        $this->checkDataCompletion($data);

        if ($this->warnings != '') {
            return $this->warnings;
        }

        $this->checkDataValidation($data);

        return $this->warnings;
    }
}