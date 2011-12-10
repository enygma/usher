<?php

namespace Lib;

/**
 * Loader class (sets up autoloader)
 *
 * @package Usher
 */
class Loader
{
	/**
	 * Initialize the loader, set up the autoloader
	 *
	 * @return void
	 */
	public static function init()
	{
		spl_autoload_register(array('\Lib\Loader','autoload'));	
	}

	/**
	 * Autoloader method, handles conversion of namespace paths
	 *
	 * @param string $className Name of the class requested
	 * @return void
	 * @throws Exception
	 */
	public static function autoload($className)
	{
		$classPath = implode('/',explode('\\',$className)).'.php';
		//echo $classPath."\n\n";	

		if(is_file($classPath)){
			include_once $classPath;
		}else{
			throw new \Exception('Class "'.$className.'" not found');
		}
	}
}

?>