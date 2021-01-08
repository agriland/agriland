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
        img {
            max-width: 380px;
            float: centre;
        }

        html,
        body {
            background-color: white;
            height: 100%;
        }

        .content {
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: center;
            justify-content: space-evenly;
            height: 30%;
        }
    </style>
</head>

<body>
    <?php include 'header.inc.php' ?>

    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1497092801449-b782257c9756?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1353&q=80');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 110%;
        }
    </style>

    <div class="content">
        <div>
            <h1 ALIGN="center">AGRILAND</h1>
            <div>

                <div>
                    Agriland staat voor overzicht en duurzaamheid. Op Agriland kunt u, door<br />
                    gebruik te maken van onze database, uw opbrengsten per gewas bijhouden.<br />
                    Hierdoor heeft u duidelijk inzicht in het rendement van uw gewassen.<br />
                    Ook is er de mogelijkheid om opbrengsten te vergelijken met verschillende jaren.<br />
                    Hierdoor kunt u streven naar de optimale winst van uw perceel.
                </div>
            </div>
        </div>
    </div>
</body>

</html>