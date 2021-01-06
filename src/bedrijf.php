<?php

include 'database/database.inc.php';

$db_conn = new Database();

if ($_POST["Bedrijf_ID"] != "" && 
    $_POST["Naam_Eigenaar"] != "" && 
    $_POST["Voornaam_Eigenaar"] != "" &&
    $_POST["Geslacht"] != "" &&
    $_POST["Geboortedatum"] != "" &&
    $_POST["Adres"] != "" &&
    $_POST["Postcode"] != "" &&
    $_POST["Telefoonnummer"] != "" &&
    $_POST["Email"] != "" &&
    $_POST["Vestigingsplaats"] != "") {
    $BedrijfID = filter_input(INPUT_POST, "Bedrijf", FILTER_SANITIZE_NUMBER_INT);
    $NaamEigenaar = filter_input(INPUT_POST, "NaamEigenaar", FILTER_SANITIZE_STRING);
    $VoornaamEigenaar = filter_input(INPUT_POST, "VoorNaamEigenaar", FILTER_SANITIZE_STRING);
    $Geslacht = filter_input(INPUT_POST, "Geslacht", FILTER_SANITIZE_STRING);
    $Geboortedatum = filter_input(INPUT_POST, "Geboortedatum", FILTER_SANITIZE_STRING);
    $Adres = filter_input(INPUT_POST, "Adres", FILTER_SANITIZE_STRING);
    $Postcode = filter_input(INPUT_POST, "Postcode", FILTER_SANITIZE_STRING);
    $Telefoonnummer = filter_input(INPUT_POST, "Telefoonnummer", FILTER_SANITIZE_NUMBER_INT);
    $Email = filter_input(INPUT_POST, "Email", FILTER_SANITIZE_STRING);
    $Vestigingsplaats = filter_input(INPUT_POST, "Vestigingsplaats", FILTER_SANITIZE_STRING);

    $db_conn->voegBedrijvenToe($BedrijfID, $NaamEigenaar, $VoornaamEigenaar, $Geslacht, $Geboortedatum, 
    $Adres, $Postcode, $Telefoonnummer, $Email, $Vestigingsplaats);
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Bedrijf toevoegen &middot; Agriland</title>
    <?php include 'head.inc.php' ?>

    <style>
    label {
        float: left;
        display: block;
        width: 150px;
    }
    </style>
</head>
<body>
    <?php include 'header.inc.php' ?>

    <h1>Bedrijven</h1>

    <h2>Bedrijf toevoegen</h2>
    <form method="POST">
        <label for="NaamEigenaar">Naam eigenaar</label>
        <input type="text" name="NaamE1igenaar" />
        <br />

        <label for="VoornaamEigenaar">Voornaam eigenaar</label>
        <input type="text" name="VoornaamEigenaar" />
        <br />

        <label for="Geslacht">Man</label>
        <input type="radio" name="Geslacht" />
        <label for="Geslacht">Vrouw</label>
        <input type="radio" name="Geslacht" />
        <br />

        <label for="Geboortedatum">Geboortedatum</label>
        <input type="text" name="Geboortedatum" value="yyyy-mm-dd" />
        <br />

        <label for="Adres">Adres</label>
        <input type="text" name="Adres" />
        <br />

        <label for="Postcode">Postcode</label>
        <input type="text" name="Postcode" value="1234AB"/>
        <br />

        <label for="Telefoonnummer">Telefoonnummer</label>
        <input type="text" name="Telefoonnummer" />
        <br />

        <label for="Email">Email</label>
        <input type="text" name="Email" />
        <br />

        <label for="Vestigingsplaats">Vestigingsplaats</label>
        <input type="text" name="Vestigingsplaats" />
        <br />
        
            <?php 

            $bedrijven = $db_conn->haalBedrijvenOp();
            foreach ($bedrijven as $bedrijf) {
                $id = $bedrijf["Bedrijf_ID"];
                $naamEigenaar = $bedrijf["Naam_Eigenaar"];
                #echo "<option value=\"" . $id . "\">" . $naamEigenaar . " - " . $id . "</option>";
            }
            ?>
        </select>
        <br />

        <input type="submit" value="Toevoegen" />
    </form>

    <h2>Bedrijven</h2>
    <table>
<style>
th, td {
  padding: 5px;
  text-align: left;
}

th{background-color: #ffffff;}
tr:nth-child(odd) {background-color: #00f50c;}
tr:nth-child(even) {background-color: #f50000;}
tr:hover {background-color: #24c6d1;}
    </style>
        <thead>
            <tr>
                <th>Naam eigenaar</th>
                <th>Adres</th>
                <th>Telefoonnummer</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $Bedrijven = $db_conn->haalBedrijvenOp();

            foreach ($Bedrijven as $Bedrijf) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($Bedrijf["Naam_Eigenaar"]) ?></td>
                    <td><?php echo htmlspecialchars($Bedrijf["Voornaam_Eigenaar"]) ?></td>
                    <td><?php echo htmlspecialchars($Bedrijf["Adres"]) ?></td>
                    <td><?php echo htmlspecialchars($Bedrijf["Telefoonnummer"]) ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
