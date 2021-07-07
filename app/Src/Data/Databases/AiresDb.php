<?php

namespace App\Src\Data\Databases;



class AiresDb extends MySqlConnection
{
    protected function configureAcessCredentials(): void
    {
        $connectionConfig = [
            parent::DEVELOPMENT => [
                'username' => env('DB_USERNAME'),
                'hostspec' => env('DB_HOST'),
                'password' => env('DB_PASSWORD'),
                'database' => env('DB_DATABASE')
            ],
            parent::QA => [
                'username' => env('DB_USERNAME'),
                'hostspec' => env('DB_HOST'),
                'password' => env('DB_PASSWORD'),
                'database' => env('DB_DATABASE')
            ],
            parent::PRODUCTION => [
                'username' => env('DB_USERNAME'),
                'hostspec' => env('DB_HOST'),
                'password' => env('DB_PASSWORD'),
                'database' => env('DB_DATABASE')
            ]
        ];

        $this->username = $connectionConfig[$this->environment]['username'];
        $this->hostspec = $connectionConfig[$this->environment]['hostspec'];
        $this->password = $connectionConfig[$this->environment]['password'];
        $this->database = $connectionConfig[$this->environment]['database'];
    }
}
