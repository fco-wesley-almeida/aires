<?php

namespace App\Src\Data\Databases;



use App\Src\Data\Dao\Db;

abstract class MySqlConnection extends Db
{
    abstract protected function configureAccessCredentials(): void;

    protected function configurePDOConfig(): void {
        $this->pdoConfig = "mysql:host={$this->hostspec};dbname={$this->database};charset=UTF8";
    }

    protected function configureAfterConnection(): void
    {
//        $this->connection->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_SYSTEM);
    }
}

?>
