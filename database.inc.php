<?php

function db_connect(): PDO
{
    include 'database_conninfo.inc.php';

    try {
        return new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_database", "$db_username", "$db_password");
    } catch (PDOException $e) {
        die("Could not connect to database: " . $e->getMessage());
    }
}
