<?php

namespace Lib\Task\File;

/**
 * File copy task
 * 
 * Configuration parameters:
 * "source" : File path to use as a source
 * "target" : File path to copy the file(s) to
 *
 * @package Usher
 */
class Copy extends \Lib\Task
{
	public function execute()
	{
		$sourcePath = $this->getOption('source');
		$targetPath = $this->getOption('target');

		if($sourcePath != null && $targetPath != null && is_file($sourcePath)){
			copy($sourcePath,$targetPath);
		}elseif(!is_file($sourcePath)){
			throw new \Exception('Source file "'.$sourcePath.'" not found');
		}
	}	
}

?>