<?php

include 'database/database.inc.php';

$db_conn = new Database();

if ($_POST["bedrijf"] != "" && $_POST["oppervlakte"] != "" && $_POST["straatnaam"] != "") {
    $bedrijfID = filter_input(INPUT_POST, "bedrijf", FILTER_SANITIZE_NUMBER_INT);
    $oppervlakte = filter_input(INPUT_POST, "oppervlakte", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $straatnaam = filter_input(INPUT_POST, "straatnaam", FILTER_SANITIZE_STRING);

    $db_conn->voegPerceelToe($bedrijfID, $oppervlakte, $straatnaam);
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriland &middot; Perceel toevoegen</title>

    <style>
    label {
        float: left;
        display: block;
        width: 100px;
    }
    </style>
</head>
<body>
    <form method="POST">
        <label for="oppervlakte">Oppervlakte</label>
        <input type="number" step="0.1" name="oppervlakte" />
        <br />

        <label for="straatnaam">Straatnaam</label>
        <input type="text" name="straatnaam" />
        <br />

        <label for="bedrijf">Bedrijf</label>
        <select name="bedrijf">
            <?php 

            $bedrijven = $db_conn->haalBedrijvenOp();
            foreach ($bedrijven as $bedrijf) {
                $id = $bedrijf["Bedrijf_ID"];
                $naamEigenaar = $bedrijf["Naam_Eigenaar"];
                echo "<option value=\"" . $id . "\">" . $naamEigenaar . " - " . $id . "</option>";
            }
            ?>
        </select>
        <br />

        <input type="submit" value="Toevoegen" />
    </form>
</body>
</html>