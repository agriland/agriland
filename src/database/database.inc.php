<?php

function db_connect(): PDO
{
    include 'database_conninfo.inc.php';

    try {
        $conn = new PDO(
            "mysql:host=$db_host;dbname=$db_database",
            $db_username,
            $db_password,
            array(
                PDO::MYSQL_ATTR_SSL_KEY => './certs/client-key.pem',
                PDO::MYSQL_ATTR_SSL_CERT => './certs/client-cert.pem',
                PDO::MYSQL_ATTR_SSL_CA => './certs/ca-cert.pem',
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false
            )
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        die("Could not connect to database: " . $e->getMessage());
    }
}
