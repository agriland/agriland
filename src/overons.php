<!DOCTYPE html>
<html lang="nl">

<head>
    <title>Over ons &middot; Agriland</title>

    <?php include 'head.inc.php' ?>

    <style>
        img {
            max-width: 380px;
            float: centre;
        }

        .content {
            display: flex;
            flex-direction: column;
            width: 100%;
            align-items: center;
            justify-content: space-evenly;
            height: 30%;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;

        }

        .text {
            color: aliceblue;
        }
    </style>
</head>

<body>
    <?php include 'header.inc.php' ?>

    <div class="columns">
        <div class="column">
            <h1 class="is-size-3 has-text-centered"></br>Rutger Broekhoff</h1>
            <img class="center" src="Rutger.jpg">
            <p class=text> Rutger: Ik ben Rutger Broekhoff, klas 6 leerling aan het Calvijn College.
                In mijn vrije tijd werk ik als software ontwikkelaar en DevOps-engineer bij Profex bv in Kapelle.
                Ik heb ervaring met agri gerelateerde websites zoals Agro4all.nl.</p>
        </div>
        <div class="column">
            <h1 class="is-size-3 has-text-centered">Deze site is gemaakt door:<br>
                Tom van den Dorpel</h1>
            <img class="center" src="Tom.jpg">
            <p class=text> 
        </div>
        <div class="column">
            <h1 class="is-size-3 has-text-centered"></br>Robert Wieringa</h1><br />
            <img class="center" src="Robert.jpg">
            <p class=text> Robert: Ik ben Robert Wieringa, klas 6 leerling aan het Calvijn College.
                De reden om dit onderwerp te kiezen is mijn achtergrond, in mijn vrije tijd werk ik bij een boer. </p>
        </div>
    </div>
</body>