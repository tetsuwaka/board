<?php

require '../bootstrap.php';
require '../BoardApplication.php';

$app = new BoardApplication(true);
$app->run();