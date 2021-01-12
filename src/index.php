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
            height: 100%;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-evenly;
            margin-top: 40px;
            margin-bottom: 40px;
            margin-left: 20px;
            margin-right: 20px;

            text-align: center;
            text-shadow:
                2px 2px 4px #ffffff,
                2px 2px 8px #ffffff,
                2px 2px 16px #ffffff;
        }

        #mission {
            font-size: 16pt;
        }

        @media screen and (min-width: 640px) {
            #mission {
                max-width: 600px;
            }
        }
    </style>
</head>

<body>
    <?php include 'header.inc.php' ?>

    <div class="content">
        <h1>AGRILAND</h1>
        <p id="mission">
            Agriland staat voor overzicht en duurzaamheid. Op Agriland kunt u, door
            gebruik te maken van onze database, uw opbrengsten per gewas bijhouden.
            Hierdoor heeft u duidelijk inzicht in het rendement van uw gewassen.
            Ook is er de mogelijkheid om opbrengsten te vergelijken met verschillende jaren.
            Hierdoor kunt u streven naar de optimale winst van uw perceel.
        </p>
    </div>
</body>

</html>