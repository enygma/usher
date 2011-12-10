<?php

namespace Lib;

class Config
{
	private static $configFile 		= 'config.json';
	private static $currentConfig 	= null;

	public static function load()
	{
		// look for a configuration file
		$configFilePath = self::$configFile;
		echo 'cfg: '.$configFilePath."\n";

		if(is_file($configFilePath)){
			self::$currentConfig = json_decode(file_get_contents($configFilePath));
		}else{
			throw new \Exception('No config file found!');
		}
	}

	public function getOption($optionPath)
	{
		$ex = new Utility\ExpandObject();
		return $ex->find(self::$currentConfig,$optionPath,'.');
	}
}

?>