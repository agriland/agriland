<?php

include 'database/database.inc.php';

$db_conn = new Database();

if ($_POST["perceel"] != "" && 
    $_POST["gewasgroep"] != "" && 
    $_POST["teeltjaar"] != "" &&
    $_POST["totaal_opbrengst"] != "" &&
    $_POST["bijzonderheden"] != "") {
    $perceelID = filter_input(INPUT_POST, "perceel", FILTER_SANITIZE_NUMBER_INT);
    $gewasgroep = filter_input(INPUT_POST, "gewasgroep", FILTER_SANITIZE_STRING);
    $teeltjaar = filter_input(INPUT_POST, "teeltjaar", FILTER_SANITIZE_NUMBER_INT);
    $totaalOpbrengst = filter_input(INPUT_POST, "totaal_opbrengst", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $bijzonderheden = filter_input(INPUT_POST, "bijzonderheden", FILTER_SANITIZE_STRING);

    $db_conn->voegPerceelToe($perceelID, $gewasgroep, $teeltjaar, $totaalOpbrengst, $bijzonderheden);
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriland &middot; Geteeld gewas toevoegen</title>

    <style>
    label {
        float: left;
        display: block;
        width: 150px;
    }
    </style>
</head>
<body>
    <h1>Geteelde gewassen</h1>

    <h2>Geteeld gewas toevoegen</h2>
    <form method="POST">
        <label for="gewasgroep">Gewasgroep</label>
        <select name="gewasgroep">
            <?php 

            $gewassen = $db_conn->haalGewassenOp();
            foreach ($gewassen as $gewas) {
                $gewasgroep = $gewas["Gewasgroep"];
                $gemiddeldeOpbrengst = $gewas["Gemiddelde_Opbrengst"];
                echo "<option value=\"" . $gewasgroep . "\">" . $gewasgroep . " (gemiddelde opbgrengst(ton/ha): " . $gemiddeldeOpbrengst . ")" . "</option>";
            }
            ?>
        </select>
        <br />

        <label for="teeltjaar">Teeltjaar</label>
        <input type="number" step="1" name="teeltjaar" />
        <br />

        <label for="totaalopbrengst">Totaalopbrengst</label>
        <input type="number" step="0.1" name="totaalopbrengst" />
        <br />

        <label for="bijzonderheden">Bijzonderheden</label>
        <input type="text" name="bijzonderheden" />
        <br />

        <label for="perceel">Perceel</label>
        <select name="perceel">
            <?php 

            $percelen = $db_conn->haalPercelenOp();
            foreach ($percelen as $perceel) {
                $id = $perceel["Perceel_ID"];
                $bedrijfID = $perceel["Bedrijf_ID"];
                $naamEigenaar = $perceel["Naam_Eigenaar"];
                $straatnaam = $perceel["Straatnaam"];
                $oppervlakte = $perceel["Oppervlakte"];
                echo "<option value=\"" . $id . "\">" . $naamEigenaar . " (" . $bedrijfID . ") - " . $straatnaam  . " (" . $oppervlakte . " ha) - " . $id . "</option>";
            }
            ?>
        </select>
        <br />

        <input type="submit" value="Toevoegen" />
    </form>

    <h2>Percelen</h2>
    <table>
        <thead>
            <tr>
                <th>Teeltjaar</th>
                <th>Naam eigenaar</th>
                <th>Gewas</th>
                <th>Straatnaam</th>
                <th>Totaalopbrengst</th>
                <th>Bijzonderheden</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $gewassen = $db_conn->haalGeteeldeGewassenOp();

            foreach ($gewassen as $gewas) {
            ?>
                <tr>
                    <td><?php echo $gewas["Teeltjaar"] ?></td>
                    <td><?php echo htmlspecialchars($gewas["Naam_Eigenaar"]) ?></td>
                    <td><?php echo htmlspecialchars($gewas["Gewasgroep"]) ?></td>
                    <td><?php echo htmlspecialchars($gewas["Straatnaam"]) ?></td>
                    <td><?php echo number_format($gewas["Totaal_Opbrengst"], 1, ",", ".") . " (gemiddeld " . number_format($gewas["Gemiddelde_Opbrengst"], 1, ",", ".") . ")" ?></td>
                    <td><?php echo htmlspecialchars($gewas["Bijzonderheden"]) ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
