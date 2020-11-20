<?php

include 'database_conninfo.inc.php';

class Field {
    public string $address;
}

class Database
{
    public PDO $conn;

    function __construct()
    {
        global $db_host, $db_database, $db_username, $db_password;

        try {
            $this->conn = new PDO(
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
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Could not connect to database: " . $e->getMessage());
        }
    }

    function haalBedrijvenOp(): array {
        $sth = $this->conn->prepare("SELECT * FROM Boerenbedrijf ORDER BY Naam_Eigenaar");
        $sth->execute();

        return $sth->fetchAll();
    }

    function voegPerceelToe(int $bedrijfID, float $oppervlakte, string $straatnaam) {
        $sth = $this->conn->prepare("INSERT INTO Percelen (Bedrijf_ID, Oppervlakte, Straatnaam) VALUES (?, ?, ?)");
        $sth->execute([$bedrijfID, $oppervlakte, $straatnaam]);
    }
}
