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
  <div class="page-software page-blender page-board">
    <nav class="navigation-global-l">
      <a href="../../index.html" class="button-arrow-l pointer">
        <i class="arrow arrow-color arrow-push arrow-link"></i>
        <div class="logo pushed">
          <h1>CRÉER LIBRE</h1>
          <h5>
            logiciel <br />
            Blender
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
              <p><a href="#presentation">Présentation</a></p>
            </li>
            <li>
              <p><a href="#site">Site Web</a></p>
            </li>
            <li>
              <p><a href="#doc">Documentation</a></p>
            </li>
            <li>
              <p><a href="#more">En savoir plus</a></p>
            </li>
          </ol>
        </nav>

        <div class="article background">
          <div class="container-corps container-solo">
            <div class="intro" id="presentation">
              <h1 class="blender">Présentation</h1>
              <p>
                Blender est un logiciel de <i>création 3D multitâche</i> (modélisation, animation, rendu) créé en 1994 par Ton Roosendaal.
              </p>
              <p>
                Il est aujourd’hui l’un des logiciels libres de création le plus réputé et utilisé face aux alternatives propriétaires tels que Maya, Cinema4D, 3DS Max, Zbrush et Houdini.
              </p>
            </div>
            <div id="site">
              <h1 class="blender">Site Web</h1>
              <p>
                [en] <a href="https://www.blender.org/" target="_blank">blender.org</a>
              </p>
            </div>
            <div id="doc">
              <h1 class="blender">Documentation</h1>
              <p>
                [fr] <a href="https://docs.blender.org/manual/fr/latest/" target="_blank">docs.blender.org/manual/fr/latest</a>
              </p>
            </div>
            <div class="container-last" id="more">
              <h1 class="blender">En savoir plus</h1>
              <p>
                [fr] <a href="https://fr.wikipedia.org/wiki/Blender" target="_blank">fr.wikipedia.org/wiki/Blender</a>
                <br />
                [en] <a href="https://github.com/blender/blender" target="_blank">github.com/blender/blender</a>
                <br />
              <div class='workshop'><a class='button' href='../../workshop/workshop_01/workshop_01.php'><span class='workshop01'>Workshop 01</span></a></div>
              </p>
            </div>
          </div>
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