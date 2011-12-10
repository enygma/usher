<?php

namespace Lib\Console;

/**
 * Standard output class
 *
 * @package Usher
 */
class Output
{
	/**
	 * Output a formatted "message" to the console
	 *
	 * @param string $message Message to print
	 * @return void
	 */
	public static function msg($message)
	{
		echo Output\Color::decorate('msg',$message);
	}

	/**
	 * Output a formatted "error" to the console
	 *
	 * @param string $message Message to print
	 * @param string $errorType[optional] Error type, defaults to "GENERAL"
	 * @return void
	 */
	public static function error($message,$errorType='GENERAL')
	{
		echo Output\Color::decorate('error',array($errorType,$message));
	}
}

?>