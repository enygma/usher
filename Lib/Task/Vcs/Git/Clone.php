<?php

namespace Lib\Task\Git;

class Clone extends \Lib\Task
{
	
	public function execute()
	{
		$repositoryPath  = $this->getOption('repositoryPath');
		$destinationPath = $this->getOption('destinationPath');	

		if($repositoryPath == null){
			throw new \Exception('Repository path not set! (repoPath)');
		}
		if($destinationPath == null){
			throw new \Exception('Destination path not set! (destinationPath)');
		}

		$exec = 'git clone '.$repositoryPath.' '.$destinationPath;
		Console\Execute::run($exec,$projectPath);
	}

}


?>
