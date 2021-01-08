<?php

include 'database/database.inc.php';

$db_conn = new Database();

if (
    $_POST["Bedrijf_ID"] != "" &&
    $_POST["Naam_Eigenaar"] != "" &&
    $_POST["Voornaam_Eigenaar"] != "" &&
    $_POST["Geslacht"] != "" &&
    $_POST["Geboortedatum"] != "" &&
    $_POST["Adres"] != "" &&
    $_POST["Postcode"] != "" &&
    $_POST["Telefoonnummer"] != "" &&
    $_POST["Email"] != "" &&
    $_POST["Vestigingsplaats"] != ""
) {
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

    $db_conn->voegBedrijvenToe(
        $BedrijfID,
        $NaamEigenaar,
        $VoornaamEigenaar,
        $Geslacht,
        $Geboortedatum,
        $Adres,
        $Postcode,
        $Telefoonnummer,
        $Email,
        $Vestigingsplaats
    );
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Bedrijf toevoegen &middot; Agriland</title>
    <?php include 'head.inc.php' ?>
</head>

<body>
    <?php include 'header.inc.php' ?>

    <div class="container form-container">
        <div class="notification form-container-bg">
            <h1 class="is-size-2">Bedrijven</h1>

            <h2 class="is-size-3">Bedrijf toevoegen</h2>
            <form method="POST">
                <div class="field">
                    <label for="NaamEigenaar" class="label">Naam eigenaar</label>
                    <div class="control">
                        <input type="text" name="NaamE1igenaar" class="input" />
                    </div>
                </div>

                <div class="field">
                    <label for="VoornaamEigenaar" class="label">Voornaam eigenaar</label>
                    <div class="control">
                        <input type="text" name="VoornaamEigenaar" class="input" />
                    </div>
                </div>

                <div class="control">
                    <label class="label">Geslacht</label>
                    <label for="Geslacht" class="radio">
                        <input type="radio" name="Geslacht" />
                        Man
                    </label>
                    <label for="Geslacht" class="radio">
                        <input type="radio" name="Geslacht" />
                        Vrouw
                    </label>
                </div>

                <div class="field">
                    <label for="Geboortedatum" class="label">Geboortedatum</label>
                    <div class="control">
                        <input type="text" name="Geboortedatum" placeholder="yyyy-mm-dd" class="input" />
                    </div>
                </div>

                <div class="field">
                    <label for="Adres" class="label">Adres</label>
                    <div class="control">
                        <input type="text" name="Adres" class="input" />
                    </div>
                </div>

                <div class="field">
                    <label for="Postcode" class="label">Postcode</label>
                    <div class="control">
                        <input type="text" name="Postcode" placeholder="1234AB" class="input" />
                    </div>
                </div>

                <div class="field">
                    <label for="Telefoonnummer" class="label">Telefoonnummer</label>
                    <div class="control">
                        <input type="text" name="Telefoonnummer" class="input" />
                    </div>
                </div>

                <div class="field">
                    <label for="Email" class="label">Email</label>
                    <div class="control">
                        <input type="text" name="Email" class="input" />
                    </div>
                </div>

                <div class="field">
                    <label for="Vestigingsplaats" class="label">Vestigingsplaats</label>
                    <div class="control">
                        <input type="text" name="Vestigingsplaats" class="input" />
                    </div>
                </div>

                <?php

                $bedrijven = $db_conn->haalBedrijvenOp();
                foreach ($bedrijven as $bedrijf) {
                    $id = $bedrijf["Bedrijf_ID"];
                    $naamEigenaar = $bedrijf["Naam_Eigenaar"];
                    #echo "<option value=\"" . $id . "\">" . $naamEigenaar . " - " . $id . "</option>";
                }
                ?>
                </select>

                <div class="control">
                    <input type="submit" value="Toevoegen" class="button is-primary" />
                </div>
            </form>

            <br />
            <h2 class="is-size-3">Bedrijven</h2>
            <div class="table-container">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>Naam eigenaar</th>
                            <th>Voornaam eigenaar</th>
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
            </div>
        </div>
    </div>
</body>

</html>