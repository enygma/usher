#!/usr/bin/php
<?php
include_once 'Lib/Loader.php';

Lib\Loader::init();
Lib\Config::load();

Lib\Console\Output::msg('Executing project "'.Lib\Config::getOption('project.name').'"');

// get and execute our tasks
try {
	$app = new Lib\Application();
	$app->execute();
}catch(Exception $e){
	Lib\Console\Output::msg('Error on build! ('.$e->getMessage().')');
}

?>