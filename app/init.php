<?php

spl_autoload_register(function($class_name) {
    $parts = explode("\\", $class_name);
    $class_name = array_pop($parts);
    require_once "../app/models/" . $class_name . ".php";
});

require "../app/core/config.php";
require "../app/core/functions.php";
require "../app/core/database.php";
require "../app/core/model.php";
require "../app/core/controller.php";
require "../app/core/app.php";
