<?php
use app\controllers\Controller;
session_start();
require __DIR__ . '/autoload.php';
$obj = new Controller();
$obj->run();

