#!/usr/bin/php
<?php
include_once 'Lib/Loader.php';

Lib\Loader::init();
Lib\Config::load();

Lib\Console\Output::msg('Executing project "'.Lib\Config::getOption('project.name').'"');

// get and execute our tasks
$app = new Lib\Application();

$tasks = $app->getTasks();
var_dump($tasks);


?>