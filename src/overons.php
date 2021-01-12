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

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .text {
            color: aliceblue;
            font-size: 16pt;

            text-shadow:
                2px 2px 4px #000000,
                2px 2px 8px #000000,
                2px 2px 16px #000000;
        }

        .text-glow {
            text-shadow:
                2px 2px 4px #ffffff,
                2px 2px 8px #ffffff,
                2px 2px 16px #ffffff;
        }

        .member-picture {
            border-radius: 100%;
        }

        .members {
            margin-left: 20px;
            margin-right: 40px;
        }

        .content {
            margin-top: 40px;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <?php include 'header.inc.php' ?>

    <div class="content">
        <h1 class="is-size-3 has-text-centered text-glow">Deze site is gemaakt door:</h1>
        <div class="columns members">
            <div class="column">
                <h1 class="is-size-3 has-text-centered text-glow">Rutger Broekhoff</h1>
                <img class="center member-picture" src="Rutger.jpg">
                <p class="text">
                    Rutger: Ik ben Rutger Broekhoff, leerling VWO 6 aan het Calvijn College.
                    In mijn vrije tijd werk ik als software ontwikkelaar en DevOps-engineer bij Profects bv in Kapelle.
                    Ik heb ervaring met agri-gerelateerde websites zoals <a href="https://agro4all.com/">Agro4all</a>.
                </p>
            </div>
            <div class="column">
                <h1 class="is-size-3 has-text-centered text-glow">Tom van den Dorpel</h1>
                <img class="center member-picture" src="Tom.jpg">
                <p class="text">
                    Tom: Ik ben Tom van den Dorpel, leerling VWO 6 aan het Calvijn College.
                    De reden voor mij om voor dit onderwerp te kiezen is mijn interesse in de agricultuur,
                    vaak help ik mijn opa in de groentetuin met het planten van gewassen, het poten van aardappels, etc.
                    Ook hebben we thuis een grote tuin, waar ik vaak te vinden ben.
                </p>
            </div>
            <div class="column">
                <h1 class="is-size-3 has-text-centered text-glow">Robert Wieringa</h1>
                <img class="center member-picture" src="Robert.jpg">
                <p class="text">
                    Robert: Ik ben Robert Wieringa, leerling VWO 6 aan het Calvijn College.
                    De reden om dit onderwerp te kiezen is mijn achtergrond, in mijn vrije tijd werk ik bij een boer.
                </p>
            </div>
        </div>
    </div>
</body>

</html>