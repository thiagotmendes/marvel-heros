<?php
require_once "vendor/autoload.php";

use App\Api\renderCharacterBlocks;

$api = new renderCharacterBlocks;

if(isset($_GET['characterid']) && !empty($_GET['characterid'])) {
  print($api->renderCharacterContent($_GET['characterid']));
}

