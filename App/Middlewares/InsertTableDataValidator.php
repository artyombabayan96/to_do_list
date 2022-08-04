<?php

namespace App\Middlewares;

use App\Consts\TaskConsts;

class InsertTableDataValidator
{
    private array $patterns = [
        'email' => '/[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]/'
    ];

    private string $warnings = '';

    private function checkDataCompletion($data): void
    {
        if (!isset($data['username']) || $data['username'] === '') {
            $this->warnings .= TaskConsts::TASK_USERNAME_EMPTY_MESSAGE . '<br>';
        }
        if (!isset($data['email']) || $data['email'] === '') {
            $this->warnings .= TaskConsts::TASK_EMAIL_EMPTY_MESSAGE . '<br>';
        }
        if (!isset($data['task']) || $data['task'] === '') {
            $this->warnings .= TaskConsts::TASK_TEXT_EMPTY_MESSAGE . '<br>';
        }
    }

    private function sanitize($data)
    {

        $data['username'] = trim($data['username']);
        $data['email'] = trim($data['email']);
        $data['task'] = trim($data['task']);

        $data['email'] = strtolower($data['email']);

        return $data;
    }

    public function checkDataValidation($data): void
    {
        if ( !preg_match($this->patterns['email'], $data['email']) ) {
            $this->warnings .= TaskConsts::TASK_EMAIL_VALIDATION_MESSAGE . '<br>';
        }
        if (strlen($data['username']) < 2 or strlen($data['username']) > 36) {
            $this->warnings .= TaskConsts::TASK_USERNAME_VALIDATION_MESSAGE . '<br>';
        }
        if (strlen($data['task']) < 2 or strlen($data['task']) > 500) {
            $this->warnings .= TaskConsts::TASK_TEXT_VALIDATION_MESSAGE . '<br>';
        }
    }

    public function validate($data): string
    {
        $this->checkDataCompletion($data);

        if ($this->warnings != '') {
            return $this->warnings;
        }

        $data = $this->sanitize($data);

        $this->checkDataValidation($data);

        return $this->warnings;
    }
}