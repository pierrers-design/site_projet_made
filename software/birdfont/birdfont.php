<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../style/normalize.css" />
    <link rel="stylesheet" href="../../style/jquery-ui.css" />
    <link rel="stylesheet" href="../../style/jquery-ui.structure.css" />
    <link rel="stylesheet" href="../../style/jquery-ui.theme.css" />
    <link rel="stylesheet" href="../../style/style.css" />
    <title>Document</title>
</head>

<body>
    <div class="global page-software page-board">
        <nav class="navigation-global">
            <div>
                <a href="../../index.html" class="button-arrow-l logo">
                    <i class="arrow arrow-color arrow-push"></i>
                    <h1>CRÉER LIBRE</h1>
                </a>
            </div>
            <div>
                <a href="../../a_propos.html" class="button-arrow-r pointer">
                    <h1>À PROPOS</h1>
                    <i class="arrow arrow-color arrow-push"></i>
                </a>
            </div>
        </nav>

        <section class="content">
            <?php

            $rootDir = "../../";
            $contentDir = "../../workshop/workshop_01/";
            $currentFile = basename($_SERVER['SCRIPT_FILENAME'], ".php");
            $content = glob($contentDir . "creations/*$currentFile*.*");

            require_once $rootDir . "loadContent.php";

            ?>
        </section>

        <?php
        require_once $rootDir . "loadGrid.php";
        ?>
    </div>

    <script src="../../libraries/jquery.min.js"></script>
    <script src="../../libraries/jquery-ui.min.js"></script>
    <script src="../../libraries/pagemap-1.4.0.min.js"></script>
    <script type="module" src="../../js/content.js"></script>
</body>

</html>