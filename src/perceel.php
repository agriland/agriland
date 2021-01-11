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
    <title>Perceel toevoegen &middot; Agriland</title>
    <?php include 'head.inc.php' ?>

    <style>
        label {
            float: left;
            display: block;
            width: 120px;
        }
        
    </style>
</head>

<body>
    <?php include 'header.inc.php' ?>

    <div class="container form-container">
        <div class="notification form-container-bg">
            <h1 class="is-size-2">Percelen</h1>

            <h2 class="is-size-3">Perceel toevoegen</h2>
            <form method="POST">
                <div class="field">
                    <label for="oppervlakte" class="label">Oppervlakte(ha)</label>
                    <div class="control">
                        <input type="number" step="0.1" name="oppervlakte" class="input" />
                    </div>
                </div>

                <div class="field">
                    <label for="straatnaam" class="label">Straatnaam</label>
                    <div class="control">
                        <input type="text" name="straatnaam" class="input" />
                    </div>
                </div>

                <div class="field">
                    <label for="bedrijf" class="label">Bedrijf</label>
                    <div class="control">
                        <div class="select">
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
                        </div>
                    </div>
                </div>

                <div class="control">
                    <input type="submit" value="Toevoegen" class="button is-primary" />
                </div>
            </form>
            <br />

            <h2 class="is-size-2">Percelen</h2>
            <div class="table-container">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Naam eigenaar</th>
                            <th>Straatnaam</th>
                            <th>Oppervlakte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $percelen = $db_conn->haalPercelenOp();

                        foreach ($percelen as $perceel) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($perceel["Naam_Eigenaar"]) ?></td>
                                <td><?php echo htmlspecialchars($perceel["Straatnaam"]) ?></td>
                                <td><?php echo number_format($perceel["Oppervlakte"], 1, ",", ".") ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>