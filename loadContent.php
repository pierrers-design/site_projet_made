<?PHP

echo "
<section class='map'>
<i class='arrow arrow-color arrow-rotate' onclick='map()'></i>
<canvas id='minimap'></canvas>
</section>
";

foreach ($content as $file) {
  // get file path
  $dataPath = pathinfo($file);
  // get extension of files
  $extension = pathinfo($file, PATHINFO_EXTENSION);
  // get file name
  $fileName = $dataPath['filename'];
  // to string
  $fileNameToString = (string) $fileName;
  // split string with "-" as a delimiter.
  $arrayString = explode("+", $fileNameToString);
  // remove "_"
  $workshopSeparate = explode("_", $arrayString[0]);
  $makerSeparate = explode("_", $arrayString[1]);
  // merge names
  $workshopMerge = implode(" ", $workshopSeparate);
  $makerMerge = implode(" ", $makerSeparate);
  // set good names
  $findName = array("rome", "elisa", "leila", "mailie", "-p");
  $replaceName = array("romé", "élisa", "leïla", "maïlie", "-P");
  $makerName = str_replace($findName, $replaceName, $makerMerge);

  //files names
  $workshopFileName = (string) $arrayString[0];
  $makerFileName = (string) $arrayString[1];
  $softwareFileName = (string) $arrayString[2];
  //search files
  $workshopPath = $rootDir . "workshop/$workshopFileName/$workshopFileName.php";
  $makerPath = $rootDir . "workshop/$workshopFileName/makers/$makerFileName/$makerFileName.php";
  $softwarePath = $rootDir . "software/$softwareFileName/$softwareFileName.php";

  if ($extension != "mp4") {
    echo "
    <figure class='loaded visual bottom'>
    <img src='$file' loading='lazy'/>
    <ol class='ol-button button-file'>
    <li class='workshop'><a class='button' href='$workshopPath'><span class='$workshopSeparate[0]$workshopSeparate[1]'>$workshopMerge</span></a></li>
    <li class='maker'><a class='button' href='$makerPath'><span class='default'>$makerName</span></a></li>
    <li class='software'><a class='button' href='$softwarePath'><span class='$arrayString[2]'>$softwareFileName</span></a></li>
    </ol>
    </figure>
    ";
  } else {
    echo "
    <div class='loaded visual bottom'>
    <video autoplay muted loop playsinline>
    <source src='$file'/>
    Your browser does not support the video tag.
    </video>
    <ol class='ol-button button-file'>
    <li class='workshop'><a class='button' href='$workshopPath'><span class='$workshopSeparate[0]$workshopSeparate[1]'>$workshopMerge</span></a></li>
    <li class='maker'><a class='button' href='$makerPath'><span class='default'>$makerName</span></a></li>
    <li class='software'><a class='button' href='$softwarePath'><span class='$arrayString[2]'>$softwareFileName</span></a></li>
    </ol>
    </div>";
  }
}