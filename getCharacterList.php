<?php
require_once "vendor/autoload.php";

use App\Api\renderCharacterBlocks;

$api = new renderCharacterBlocks;

print($api->renderGridList());