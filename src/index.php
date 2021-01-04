<?php

include 'database/database.inc.php';

$db_conn = new Database();


?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriland &middot; Home</title>

    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="bulma.min.css" rel="stylesheet" type="text/css" />

    <style>
    img {
        max-width: 380px;
        float: centre;
    }

    html, body {
        background-color: yellowgreen;
        height: 100%;
    }

    .content {
        display: flex;
        flex-direction: column;
        width: 100%;
        align-items: center;
        justify-content: space-evenly;
        height: 100%;
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

    <div class="content">

    <div>
    Agriland staat voor overzicht en duurzaamheid. Op Agriland kunt u, door<br />
    gebruik te maken van onze database, uw opbrengsten per gewas bijhouden.<br />
    Hierdoor heeft u duidelijk inzicht in het rendement van uw gewassen.<br />
    Ook is er de mogelijkheid om opbrengsten te vergelijken met verschillende jaren.<br />
    Hierdoor kunt u streven naar de optimale winst van uw perceel.
    </div>
    
    <div>
        <img src="https://images1.persgroep.net/rcs/0Uaav2_L3cw4Fu__UnpjAA9wq5k/diocontent/131294043/_fitwidth/694/?appId=21791a8992982cd8da851550a453bd7f&quality=0.8" />
    </div>

    </div>
</body>

</html>
