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
  <div class="page-software page-board">
    <nav class="navigation-global-l">
      <a href="../../index.html" class="button-arrow-l pointer">
        <i class="arrow arrow-color arrow-push arrow-link"></i>
        <div class="logo pushed">
          <h1>CRÉER LIBRE</h1>
          <h5>
            logiciel <br />
            Penpot
          </h5>
        </div>
      </a>
    </nav>

    <nav class="navigation-global-r">
      <a href="../../a_propos.php" class="button-arrow-r pointer">
        <h1 class="pushed">À PROPOS</h1>
        <i class="arrow arrow-color arrow-push arrow-link"></i>
      </a>
    </nav>

    <nav class="navigation-bottom-r">
      <div class="button-arrow-r pointer open-map">
        <h1 class="pushed">CARTE</h1>
        <i class="arrow arrow-color arrow-push arrow-rotate"></i>
      </div>
    </nav>

    <nav class="navigation-bottom-l">
      <div class="button-arrow-l pointer">
        <i class="arrow arrow-color arrow-push"></i>
        <h1 class="pushed">INFORMATIONS</h1>
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

      <article class="container-article">
        <nav class="close-article background" onclick="hideArticle()">
          <i class="arrow arrow-color arrow-rotate pointer"></i>
        </nav>

        <nav class="summary background">
          <ol>
            <li>
              <p><a href="#intro">Introduction</a></p>
            </li>
            <li>
              <p><a href="#presentation">Présentation</a></p>
            </li>
            <li>
              <p><a href="#theme">Thème</a></p>
            </li>
            <li>
              <p><a href="#projets">Exemple de projets</a></p>
            </li>
            <li>
              <p><a href="#logiciels">Logiciels</a></p>
            </li>
            <li>
              <p><a href="#ressources">Ressources typographique</a></p>
            </li>
          </ol>
        </nav>

        <div class="article background">

        </div>
      </article>
    </section>

    <?php
    require_once $rootDir . "loadGrid.php";
    ?>
  </div>

  <script src="../../libraries/jquery.min.js"></script>
  <script src="../../libraries/jquery-ui.min.js"></script>
  <script src="../../libraries/pagemap-1.4.0.min.js"></script>
  <script type="module" src="../../js/script.js"></script>
</body>

</html>