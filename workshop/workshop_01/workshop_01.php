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
  <div class="global page-workshop">
    <nav class="neutral">
      <a href="../../index.html" class="button" onclick="loadContent('workshop_01')"><span class="default">ACCUEIL</span></a>
    </nav>

    <section class="content">
      <?php
      $images = glob("creations/{*.jpg,*.jpeg,*.gif,*.png,*.svg}", GLOB_BRACE);
      $videos = glob("creations/*.mp4");
      foreach ($images as $image) {
        $randomVw = (string) rand(0, 300);
        echo "<div class='loaded bottom'><img src='$image'/></div>";
      }
      // foreach ($videos as $video) {
      //   echo "<div class='loaded'><video autoplay loop controls><source src='$video'/></video></div>";
      // }
      ?>
    </section>

    <div class="background-grid">
      <div class="grid-below"></div>
      <div class="grid grid-s"></div>
      <div class="grid grid-l"></div>
    </div>
  </div>



  <script src="../../libraries/jquery.min.js"></script>
  <script src="../../libraries/jquery-ui.min.js"></script>
  <script type="module" src="../../js/workshop.js"></script>
</body>

</html>