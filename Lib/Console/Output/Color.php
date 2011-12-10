<?php

namespace Lib\Console\Output;

class Color
{
	private static $colorSet = array(
		//'error'  => "\n\033[41m> ERROR: \033[01;30;40m (%s)\033[40;31m %s\n\n",
		'error'  => "\n\033[41m>%s ERROR: \033[40;31m (%s)\033[40;31m %s\n\n",
		'msg'    => "\033[33m%s %s\n\n",
		'notice' => "\033[33m%s %s\n\n",
		'reset'	 => "\033[0m"
	);

	public static function decorate($messageType,$data)
	{
		if(!is_array($data)){ $data = array($data); }
		array_unshift($data,'['.date('m.d.Y H:i:s').']');
		return 
			vsprintf(self::$colorSet[$messageType],$data).
			self::$colorSet['reset'];
	}
}

?>