<?php

namespace Lib\Task\Package;

class Composer extends \Lib\Task
{
	private $composerPath = './bin/composer';
	
	public function execute()
	{
		$config = $this->getOption('config');

		$exec = $this->composerPath;

		echo $exec;
		
	}

}


?>