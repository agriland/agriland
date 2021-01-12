<?php

include 'database_conninfo.inc.php';

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

    function haalBedrijvenOp(): array
    {
        $sth = $this->conn->prepare("SELECT * FROM Boerenbedrijf ORDER BY Naam_Eigenaar");
        $sth->execute();

        return $sth->fetchAll();
    }

    function voegBedrijfToe(
        string $NaamEigenaar,
        string $VoornaamEigenaar,
        string $Geslacht,
        string $Geboortedatum,
        string $Adres,
        string $Postcode,
        string $Telefoonnummer,
        string $Email,
        string $Vestigingsplaats
    ) {
        $sql = <<<'SQL'
        INSERT INTO Boerenbedrijf (
            Naam_Eigenaar, 
            Voornaam_Eigenaar,
            Geslacht,
            Geboortedatum,
            Adres,
            Postcode,
            Telefoonnummer,
            Email,
            Vestigingsplaats
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
SQL;

        $sth = $this->conn->prepare($sql);
        $sth->execute([
            $NaamEigenaar, $VoornaamEigenaar, $Geslacht, $Geboortedatum,
            $Adres, $Postcode, $Telefoonnummer, $Email, $Vestigingsplaats
        ]);
    }

    function voegPerceelToe(int $bedrijfID, float $oppervlakte, string $straatnaam)
    {
        $sth = $this->conn->prepare("INSERT INTO Percelen (Bedrijf_ID, Oppervlakte, Straatnaam) VALUES (?, ?, ?)");
        $sth->execute([$bedrijfID, $oppervlakte, $straatnaam]);
    }

    function haalPercelenOp(): array
    {
        $sql = <<<'SQL'
        SELECT * FROM Percelen AS p
        INNER JOIN Boerenbedrijf b on b.Bedrijf_ID = p.Bedrijf_ID
        ORDER BY b.Naam_Eigenaar, Straatnaam
SQL;

        $sth = $this->conn->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    function haalGewassenOp(): array
    {
        $sth = $this->conn->prepare("SELECT * FROM Gewassen ORDER BY Gewasgroep");
        $sth->execute();

        return $sth->fetchAll();
    }

    function haalGeteeldeGewassenOp(): array
    {
        $sql = <<<'SQL'
        SELECT gg.Perceel_ID, gg.Teeltjaar, b.Naam_Eigenaar, gg.Gewasgroep, p.Straatnaam, p.Oppervlakte, gw.Gemiddelde_Opbrengst, gg.Totaal_Opbrengst, gg.Bijzonderheden FROM Geteelde_Gewassen AS gg
        INNER JOIN Percelen p on gg.Perceel_ID = p.Perceel_ID
        INNER JOIN Gewassen gw ON gw.Gewasgroep = gg.Gewasgroep
        INNER JOIN Boerenbedrijf b on b.Bedrijf_ID = p.Bedrijf_ID
        ORDER BY gg.Teeltjaar DESC, b.Naam_Eigenaar, gg.Gewasgroep, p.Straatnaam, gg.Totaal_Opbrengst, gg.Bijzonderheden
SQL;

        $sth = $this->conn->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    function voegGeteeldGewasToe(int $perceelID, string $gewasgroep, int $teeltjaar, float $totaalOpbrengst, string $bijzonderheden)
    {
        $sql = <<<'SQL'
        INSERT INTO Geteelde_Gewassen (Perceel_ID, Gewasgroep, Teeltjaar, Totaal_Opbrengst, Bijzonderheden)
        VALUES (?, ?, ?, ?, ?)
SQL;
        $sth = $this->conn->prepare($sql);
        $sth->execute([$perceelID, $gewasgroep, $teeltjaar, $totaalOpbrengst, $bijzonderheden]);
    }

    function verwijderGeteeldGewas(int $perceelID, int $teeltjaar, string $gewasgroep) {
        $sth = $this->conn->prepare("DELETE FROM Geteelde_Gewassen WHERE Perceel_ID = ? AND Teeltjaar = ? AND Gewasgroep = ?");
        $sth->execute([$perceelID, $teeltjaar, $gewasgroep]);
    }

    function verwijderPerceel(int $id) {
        $sth = $this->conn->prepare("DELETE FROM Percelen WHERE Perceel_ID = ?");
        $sth->execute([$id]);
    }

    function verwijderBedrijf(int $id) {
        $sth = $this->conn->prepare("DELETE FROM Boerenbedrijf WHERE Bedrijf_ID = ?");
        $sth->execute([$id]);
    }
}
