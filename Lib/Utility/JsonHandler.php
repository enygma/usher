<?php

namespace Lib\Utility;

class JsonHandler
{
	public function __construct()
	{
		
	}

	public static function output($jsonString)
	{
		return stripslashes($jsonString);
	}
}

?>