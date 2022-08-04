<?php

namespace App\Models;

class User
{
    private array $schema = [
        'user_id' => 'INT PRIMARY KEY NOT NULL AUTO_INCREMENT',
        'username' => 'VARCHAR(36) NOT NULL',
        'password' => 'VARCHAR(255) NOT NULL'
    ];

    public function getSchema(): array
    {
        return $this->schema;
    }
}