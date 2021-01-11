<?php

include 'database/database.inc.php';

$db_conn = new Database();

if (
    isset($_GET["delete"]) &&
    isset($_GET["delete"]["perceel"]) &&
    isset($_GET["delete"]["teeltjaar"]) &&
    isset($_GET["delete"]["gewasgroep"])
) {
    $db_conn->verwijderGeteeldGewas(
        intval($_GET["delete"]["perceel"]),
        intval($_GET["delete"]["teeltjaar"]),
        $_GET["delete"]["gewasgroep"]
    );
    return;
}

if (
    isset($_POST["perceel"]) &&
    isset($_POST["gewasgroep"]) &&
    isset($_POST["teeltjaar"]) &&
    isset($_POST["totaalopbrengst"]) &&
    isset($_POST["bijzonderheden"])
) {
    $perceelID = filter_input(INPUT_POST, "perceel", FILTER_SANITIZE_NUMBER_INT);
    $gewasgroep = filter_input(INPUT_POST, "gewasgroep", FILTER_SANITIZE_STRING);
    $teeltjaar = filter_input(INPUT_POST, "teeltjaar", FILTER_SANITIZE_NUMBER_INT);
    $totaalOpbrengst = filter_input(INPUT_POST, "totaalopbrengst", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $bijzonderheden = filter_input(INPUT_POST, "bijzonderheden", FILTER_SANITIZE_STRING);

    $db_conn->voegGeteeldGewasToe($perceelID, $gewasgroep, $teeltjaar, $totaalOpbrengst, $bijzonderheden);
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Geteeld gewas toevoegen &middot; Agriland</title>
    <?php include 'head.inc.php' ?>

    <style>
        img {
            max-width: 80px;
        }
    </style>
</head>

<body>
    <?php include 'header.inc.php' ?>

    <div class="container form-container">
        <div class="notification form-container-bg">
            <h1 class="is-size-2">Geteelde gewassen</h1>

            <h2 class="is-size-3">Geteeld gewas toevoegen</h2>

            <form method="POST" class="form">
                <div class="field">
                    <label for="gewasgroep" class="label">Gewasgroep</label>
                    <p class="control has-icons-left">
                        <span class="select">
                            <select name="gewasgroep">
                                <?php

                                $gewassen = $db_conn->haalGewassenOp();
                                foreach ($gewassen as $gewas) {
                                    $gewasgroep = $gewas["Gewasgroep"];
                                    $gemiddeldeOpbrengst = $gewas["Gemiddelde_Opbrengst"];
                                    echo "<option value=\"" . $gewasgroep . "\">" . $gewasgroep . " (gemiddelde opbgrengst (ton/ha): " . $gemiddeldeOpbrengst . ")" . "</option>";
                                }
                                ?>
                            </select>
                        </span>
                        <span class="icon is-small is-left">
                            <i class="fas fa-seedling"></i>
                        </span>
                    </p>
                </div>

                <div class="field">
                    <label for="teeltjaar" class="label">Teeltjaar</label>
                    <div class="control has-icons-left">
                        <input type="number" step="1" name="teeltjaar" class="input" />
                        <span class="icon is-small is-left">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="totaalopbrengst" class="label">Totaalopbrengst</label>
                    <div class="control has-icons-left">
                        <input type="number" step="0.1" name="totaalopbrengst" class="input" />
                        <span class="icon is-small is-left">
                            <i class="fas fa-balance-scale"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="bijzonderheden" class="label">Bijzonderheden</label>
                    <div class="control has-icons-left">
                        <input type="text" name="bijzonderheden" class="input" />
                        <span class="icon is-small is-left">
                            <i class="fas fa-sticky-note"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="perceel" class="label">Perceel</label>
                    <div class="control has-icons-left">
                        <div class="select">
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
                            <span class="icon is-small is-left">
                                <i class="fas fa-map-marked"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="control">
                    <input type="submit" value="Toevoegen" class="button is-primary" />
                </div>
            </form>
            <br />

            <h2 class="is-size-3">Percelen</h2>
            <div class="table-container">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Teeltjaar</th>
                            <th>Naam eigenaar</th>
                            <th>Gewas</th>
                            <th>Straatnaam</th>
                            <th>Totaalopbrengst</th>
                            <th>Bijzonderheden</th>
                            <th>Acties</th>
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
                                <td><?php echo number_format($gewas["Totaal_Opbrengst"], 1, ",", ".") . " (gemiddeld " . number_format($gewas["Gemiddelde_Opbrengst"], 1, ",", ".") . " ton/ha)" ?></td>
                                <td><?php echo htmlspecialchars($gewas["Bijzonderheden"]) ?></td>
                                <td>
                                    <button onclick='verwijderGeteeldGewas(<?php echo $gewas["Perceel_ID"] . ", " . $gewas["Teeltjaar"] . ", " . json_encode($gewas["Gewasgroep"]) ?>)' class="button is-danger is-rounded" title="Verwijderen">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        async function verwijderGeteeldGewas(perceel, teeltjaar, gewasgroep) {
            await fetch(`?delete[perceel]=${perceel}&delete[teeltjaar]=${teeltjaar}&delete[gewasgroep]=${gewasgroep}`);
            window.location.reload(true);
        }
    </script>
</body>

</html>