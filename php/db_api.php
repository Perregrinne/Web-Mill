<?php
//This script deals with the database abstraction layer (PDO) and ORM.
//Between PDO and the ORM, users should be able to connect to the most
//commonly used RDBMSs like MySQL, Postgres, MS SQL Server, and so on.
//Will there eventually be support for NoSQL? Perhaps. But for now, no

@require_once $_SERVER['DOCUMENT_ROOT'] . '/php/admin/config.php';
@require_once $_SERVER['DOCUMENT_ROOT'] . '/php/admin/secrets.php';
@require_once $_SERVER['DOCUMENT_ROOT'] . '/php/logger.php';

function connect() {
    //Make our connection string
    //Form: "mysql:host=$host;dbname=$db;charset=$charset" mysql can be swapped with pgsql, sqlsrv, sqlite, etc
    $PDO_CONNECTION = "";
    $CONNECTION = "$DB_DRIVER:host=$HOST;dbname=$DB_NAME;charset=$DB_CHARSET";
    $PDO_OPTIONS = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    try {
        //Pass this in to functions:
        $PDO_CONNECTION = new PDO(
            "$DB_DRIVER:host=$HOST;dbname=$DB_NAME;charset=$DB_CHARSET", 
            $DB_USER, $DB_PASSWORD, 
            $PDO_OPTIONS
        );
   } catch (\PDOException $e) {
        //Log the error:
        logMsg("Failed to create connection string: " . $e->getMessage() . " " . (int)$e->getCode());
        return false;
        //throw new \PDOException($e->getMessage(), (int)$e->getCode());
   }
}

//Function to generate DB/DT?