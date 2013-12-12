<?php

chdir(dirname(__DIR__));

$app = require "./app/bootstrap.php";
$app->run();
