<?php

namespace Lib;

/**
 * Works with the JSON-based configuration file
 *
 * @package Usher
 */
class Config
{
	/**
	 * Filename for the default config file
	 * @var string
	 */
	private static $configFile 		= 'config.json';

	/**
	 * Current configuration options
	 * @var array
	 */
	private static $currentConfig 	= null;

	/**
	 * Load the configuration from the given file
	 *
	 * @return void
	 */
	public static function load()
	{
		// look for a configuration file
		$configFilePath = self::$configFile;
		if(is_file($configFilePath)){
			self::$currentConfig = json_decode(file_get_contents($configFilePath));
			if(self::$currentConfig == NULL){
				throw new \Exception('Error parsing configuration file "'.self::$configFile.'"!');
			}
		}else{
			throw new \Exception('No config file found!');
		}
	}

	/**
	 * Get an option from the configuration file
	 *
	 * @param string $optionPath Option path to find
	 * @param mixed Found result or null
	 */
	public function getOption($optionPath)
	{
		$ex = new Utility\ExpandObject();
		return $ex->find(self::$currentConfig,$optionPath,'.');
	}
}

?>