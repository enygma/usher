<?php

namespace Lib\Task\Syntax;

/**
 * Runs a php lint check on the project directory
 * 
 * @package usher
 */
class PhpLint extends \Lib\Task
{
	
	public function execute()
	{
		// get the project basedir
		$projectDir = $this->getProjectConfig('projectBase');

		if($projectDir != null){
			$exec = 'php -l '.$projectDir;
			Console\Execute::run($exec);
		}else{
			throw new \Exception('Could not determine project directory (projectBase)');
		}
		
	}

}

?>
