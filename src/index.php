<?php

include 'database/database.inc.php';

$db_conn = new Database();

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Home &middot; Agriland</title>
    <?php include 'head.inc.php' ?>

    <style>
        .content {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: center;
            justify-content: space-evenly;
            text-shadow: 0px 0px 4px #ffffff, 0px 0px 2px #ffffff;
        }
    </style>
</head>

<body>
    <?php include 'header.inc.php' ?>

    <div class="content">
        <h1 class="is-size-1 has-text-centered">AGRILAND</h1>
        <p>
            Agriland staat voor overzicht en duurzaamheid. Op Agriland kunt u, door<br />
            gebruik te maken van onze database, uw opbrengsten per gewas bijhouden.<br />
            Hierdoor heeft u duidelijk inzicht in het rendement van uw gewassen.<br />
            Ook is er de mogelijkheid om opbrengsten te vergelijken met verschillende jaren.<br />
            Hierdoor kunt u streven naar de optimale winst van uw perceel.
        </p>
    </div>
</body>

</html>