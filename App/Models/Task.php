<?php

namespace App\Models;

class Task
{
    private array $schema = [
        'task_id' => 'INT PRIMARY KEY NOT NULL AUTO_INCREMENT',
        'username' => 'VARCHAR(36) NOT NULL',
        'email' => 'VARCHAR(50) NOT NULL',
        'task' => 'TEXT(500) NOT NULL',
        'status' => 'TEXT(36) NOT NULL'
    ];

    public function getSchema(): array
    {
        return $this->schema;
    }
}