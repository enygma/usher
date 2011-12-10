<?php

namespace Lib\Console;

class Output
{
	public static function msg($message)
	{
		echo Output\Color::decorate('msg',$message);
	}
	public static function error($message,$errorType='GENERAL')
	{
		echo Output\Color::decorate('error',array($errorType,$message));
	}
}

?>