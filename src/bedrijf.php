<?php

include 'database/database.inc.php';

$db_conn = new Database();

if (
    isset($_GET["delete"]) &&
    isset($_GET["delete"]["id"]) && $_GET["delete"]["id"] != ""
) {
    $db_conn->verwijderBedrijf(intval($_GET["delete"]["id"]));
    return;
}

if (
    isset($_POST["naam_eigenaar"]) && $_POST["naam_eigenaar"] != "" &&
    isset($_POST["voornaam_eigenaar"]) && $_POST["voornaam_eigenaar"] != "" &&
    isset($_POST["geslacht"]) && $_POST["geslacht"] != "" &&
    isset($_POST["geboortedatum"]) && $_POST["geboortedatum"] != "" &&
    isset($_POST["adres"]) && $_POST["adres"] != "" &&
    isset($_POST["postcode"]) && $_POST["postcode"] != "" &&
    isset($_POST["telefoonnummer"]) && $_POST["telefoonnummer"] != "" &&
    isset($_POST["email"]) && $_POST["email"] != "" &&
    isset($_POST["vestigingsplaats"]) && $_POST["vestigingsplaats"] != ""
) {
    $naamEigenaar = filter_input(INPUT_POST, "naam_eigenaar", FILTER_SANITIZE_STRING);
    $voornaamEigenaar = filter_input(INPUT_POST, "voornaam_eigenaar", FILTER_SANITIZE_STRING);
    $geslacht = filter_input(INPUT_POST, "geslacht", FILTER_SANITIZE_STRING);
    $geboortedatum = filter_input(INPUT_POST, "geboortedatum", FILTER_SANITIZE_STRING);
    $adres = filter_input(INPUT_POST, "adres", FILTER_SANITIZE_STRING);
    $postcode = filter_input(INPUT_POST, "postcode", FILTER_SANITIZE_STRING);
    $telefoonnummer = filter_input(INPUT_POST, "telefoonnummer", FILTER_SANITIZE_NUMBER_INT);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $vestigingsplaats = filter_input(INPUT_POST, "vestigingsplaats", FILTER_SANITIZE_STRING);

    $db_conn->voegBedrijfToe(
        $naamEigenaar,
        $voornaamEigenaar,
        $geslacht,
        $geboortedatum,
        $adres,
        $postcode,
        $telefoonnummer,
        $email,
        $vestigingsplaats
    );
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Bedrijven &middot; Agriland</title>
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
                    <label for="naam_eigenaar" class="label">Naam eigenaar</label>
                    <div class="control">
                        <input type="text" name="naam_eigenaar" class="input" required />
                    </div>
                </div>

                <div class="field">
                    <label for="voornaam_eigenaar" class="label">Voornaam eigenaar</label>
                    <div class="control">
                        <input type="text" name="voornaam_eigenaar" class="input" required />
                    </div>
                </div>

                <div class="control">
                    <label class="label">Geslacht</label>
                    <?php /* 
                    
                        Ten minste één van de twee moet aangeklikt worden, 
                        in HTML hoef je dan maar voor één required aan te zetten.

                        Zie https://stackoverflow.com/questions/8287779/how-to-use-the-required-attribute-with-a-radio-input-field
                        
                    */ ?>
                    <label for="geslacht" class="radio">
                        <input type="radio" name="geslacht" value="m" required />
                        Man
                    </label>
                    <label for="geslacht" class="radio">
                        <input type="radio" name="geslacht" value="v" />
                        Vrouw
                    </label>
                </div>

                <div class="field">
                    <label for="geboortedatum" class="label">Geboortedatum</label>
                    <div class="control">
                        <input type="date" id="start" name="geboortedatum" min="1900" max="<?php echo date('Y-m-d') ?>" required />
                    </div>
                </div>

                <div class="field">
                    <label for="vestigingsplaats" class="label">Vestigingsplaats</label>
                    <div class="control has-icons-left">
                        <input type="text" name="vestigingsplaats" class="input" required />
                        <span class="icon is-small is-left">
                            <i class="fas fa-city"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="adres" class="label">Adres</label>
                    <div class="control has-icons-left">
                        <input type="text" name="adres" class="input" required />
                        <span class="icon is-small is-left">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="postcode" class="label">Postcode</label>
                    <div class="control has-icons-left">
                        <input type="text" name="postcode" placeholder="1234AB" class="input" required />
                        <span class="icon is-small is-left">
                            <i class="fas fa-inbox"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="telefoonnummer" class="label">Telefoonnummer</label>
                    <div class="control has-icons-left">
                        <input type="text" name="telefoonnummer" class="input" required />
                        <span class="icon is-small is-left">
                            <i class="fas fa-phone"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label for="email" class="label">Email</label>
                    <div class="control has-icons-left">
                        <input type="email" name="email" class="input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>

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
                            <th>Acties</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $bedrijven = $db_conn->haalBedrijvenOp();

                        foreach ($bedrijven as $bedrijf) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($bedrijf["Naam_Eigenaar"]) ?></td>
                                <td><?php echo htmlspecialchars($bedrijf["Voornaam_Eigenaar"]) ?></td>
                                <td><?php echo htmlspecialchars($bedrijf["Adres"]) ?></td>
                                <td><?php echo htmlspecialchars($bedrijf["Telefoonnummer"]) ?></td>
                                <td>
                                    <button onclick='verwijderBedrijf(<?php echo $bedrijf["Bedrijf_ID"] ?>)' class="button is-danger is-rounded" title="Verwijderen">
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
        async function verwijderBedrijf(id) {
            await fetch(`?delete[id]=${id}`);
            window.location.reload(true);
        }
    </script>
</body>

</html>