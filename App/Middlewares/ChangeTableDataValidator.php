<?php

namespace App\Middlewares;

use App\Consts\TaskConsts;

class ChangeTableDataValidator
{
    private string $warnings = '';

    private function checkDataCompletion($data): void
    {
        if (!isset($data['task_id']) || $data['task_id'] === '') {
            $this->warnings .= TaskConsts::TASK_ID_NOT_SET_MESSAGE . '<br>';
        }
        if (!isset($data['task']) || $data['task'] === '') {
            $this->warnings .= TaskConsts::TASK_TEXT_EMPTY_MESSAGE . '<br>';
        }
        if (!isset($data['status']) || $data['status'] === '') {
            $this->warnings .= TaskConsts::TASK_STATUS_EMPTY_MESSAGE . '<br>';
        }
    }

    private function sanitize($data)
    {
        $data['task'] = trim($data['task']);
        $data['status'] = trim($data['status']);

        return $data;
    }

    public function checkDataValidation($data): void
    {
        if (strlen($data['task']) < 2 or strlen($data['task']) > 500) {
            $this->warnings .= TaskConsts::TASK_TEXT_VALIDATION_MESSAGE . '<br>';
        }
        if (strlen($data['status']) < 2 or strlen($data['status']) > 36) {
            $this->warnings .= TaskConsts::TASK_STATUS_VALIDATION_MESSAGE . '<br>';
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