<?php

include 'database/database.inc.php';

$db_conn = new Database();

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriland Home</title>
</head>
<body>
    <p> Agriland staat voor overzicht en duurzaamheid. 
        Op agriland kunt u, door gebruik te maken van onze database, uw opbrengsten per gewas bijhouden. 
        Hierdoor heeft u duidelijk inzicht in het rendement van uw gewassen. 
        Ook is er de mogelijkheid om opbrengsten te vergelijken met verschillende jaren. 
        Hierdoor kunt u streven naar de optimale winst van uw perceel. </p>
    <nav>
        <ul>
            <li>
                <a href="/perceel.php">Perceel toevoegen<br></a>
            </li>
            <li>
                <a href="/geteeldgewas.php">Teelt toevoegen<br></a>
            </li>
            <li>
                <a href="/bedrijf.php">Bedrijf toevoegen<br></a>
            </li>
            <li>
                <a href="/geteeldgewas.php">Gewas toevoegen<br><br></a>
            </li>
            <li>
                <a href="/over.php">Over deze site</a>
            </li>
        </ul>
    </nav>
</body>
</html>
