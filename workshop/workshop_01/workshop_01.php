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
  <link rel="stylesheet" href="../../style/interface.css" />
  <link rel="stylesheet" href="../../style/style.css" />
  <!-- <script src="https://unpkg.com/pagedjs/dist/paged.polyfill.js"></script> -->
  <title>Document</title>
</head>

<body>
  <div class="page-workshop page-workshop01 page-board">

    <nav class="navigation-global-l">
      <a href="../../index.html" class="button-arrow-l pointer">
        <i class="arrow arrow-color arrow-push arrow-link"></i>
        <div class="logo pushed">
          <h1>CRÉER LIBRE</h1>
          <h5>
            workshop <br />
            motion design et typographie animée
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

    <section id="board" class="content">
      <?php

      // $rootDir = substr(__DIR__, 0, strpos(__DIR__, "site_projet_made")) . "site_projet_made/";
      $rootDir = "../../";
      // $contentDir = $rootDir . "workshop/workshop_01/creations";
      $contentDir = "";
      print_r($contentDir);
      $currentFile = basename($_SERVER['SCRIPT_FILENAME'], ".php");
      $content = glob($contentDir . "creations/*$currentFile*.*");

      require_once $rootDir . "loadContent.php";
      ?>

    </section>

    <article class="container-article background">

      <nav class="close-article background">
        <i class="arrow arrow-color arrow-rotate pointer"></i>
        <span class="button-print pointer">IMPRIMER</span>
        <span class="button-fullscreen pointer">⬓</span>
      </nav>

      <iframe class="instruction-print" src="" frameborder="0"></iframe>

      <nav class="summary">
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
            <p><a href="#projets">Exemples de versionnage</a></p>
          </li>
          <li>
            <p><a href="#logiciels">Logiciels</a></p>
          </li>
          <li>
            <p><a href="#ressources">Ressources typographique</a></p>
          </li>
        </ol>
      </nav>

      <?php
      require_once "instruction/content_instruction.php";
      ?>

    </article>

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