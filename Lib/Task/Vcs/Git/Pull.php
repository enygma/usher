<?php

namespace Lib\Task\Vcs\Git;

class PullTask extends \Lib\Task
{
	
	public function execute()
	{
		$this->getOption('repositoryPath');
		
	}

}


?>