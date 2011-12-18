<?php

/**
 * Generic repository for execution/session specific information
 *
 */
namespace Usher\Lib\Utility;

class SessionManage
{
	private static $repository;
	
	public static function set($keyname,$value)
	{
		self::$repository[$keyname] = $value;
	}
	public static function get($keyname)
	{
		return (isset(self::$repository[$keyname])) ? self::$repository[$keyname] : null;
	}
}

?>