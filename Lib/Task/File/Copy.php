<?php

namespace Lib\Task\File;

class Copy extends \Lib\Task
{
	public function execute()
	{
		$sourcePath = $this->getOption('source');
		$targetPath = $this->getOption('target');

		copy($sourcePath,$targetPath);
	}	
}

?>