<?php

namespace Lib;

class Loader
{
	public static function init()
	{
		spl_autoload_register(array('\Lib\Loader','autoload'));	
	}

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