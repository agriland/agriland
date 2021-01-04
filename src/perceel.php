<a href="/index.php"><img src="Agriland.jpg"><br></a>
<style> 

body {
  background-image: url('https://images.unsplash.com/photo-1497092801449-b782257c9756?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1353&q=80');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 110%;
}

 img {
     max-width:80px;
 }
 </style>
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
        width: 120px;
    }
    </style>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="agriland.jpg" width="28" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/">Home</a>
                <a class="navbar-item" href="/perceel.php">Perceel toevoegen</a>
                <a class="navbar-item" href="/geteeldgewas.php">Gewas toevoegen</a>
                <a class="navbar-item" href="">Over ons</a>
                <a class="navbar-item" href="">Contact</a>
            </div>
        </div>
    </nav>

    <h1>Percelen</h1>
    

    <h2>Perceel toevoegen</h2>
    <form method="POST">
        <label for="oppervlakte">Oppervlakte(ha)</label>
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

    <h2>Percelen</h2>
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
</body>
</html>
