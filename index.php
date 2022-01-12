<?php

use CRUD\Controller\PersonController;

use CRUD\Helper\DBConnector;

include ("loader.php");

$controller = new PersonController();
$controller->switcher($_SERVER['REQUEST_URI'],$_REQUEST);
