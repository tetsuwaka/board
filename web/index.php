<?php

require '../bootstrap.php';
require '../BoardAppliction.php';

$app = new BoardApplication(true);
$app->run();