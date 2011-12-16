#!/usr/bin/php
<?php
include_once 'Lib/Loader.php';

try {
	Lib\Loader::init();
	Lib\Config::load();
}catch(Exception $e){
	Lib\Console\Output::msg('Error on setup: '.$e->getMessage());
	die();
}

Lib\Console\Output::msg('Executing project "'.Lib\Config::getOption('project.name').'"');

// get and execute our tasks
try {
	$app = new Lib\Application();
	$app->execute();
}catch(Exception $e){
	Lib\Console\Output::error('Error on build! ('.$e->getMessage().')');
}

?>