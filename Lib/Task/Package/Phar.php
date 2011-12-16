<?php

namespace Lib\Task\Package;

class PharTask extends \Lib\Task
{
	public function execute()
	{
		$target 		 = $this->getOption('target');
		$sourceDirectory = $this->getOption('sourceDirectory');
		$stubFile		 = $this->getOption('stubFile');

		if(!extension_loaded('phar')){
			throw new \Exception('Phar extension not loaded');
		}
		if(!is_dir($sourceDirectory)){
			throw new \Exception('Source directory not found: '.$sourceDirectory);
		}

		// check to see if we can create phar files
		$readOnly = ini_get('phar.readonly');

		if($readOnly != 1){
			
			$phar = new \Phar($target,0,basename($target));
			$phar->startBuffering();
			$phar->buildFromDirectory($sourceDirectory);

			$stub = $phar->createDefaultStub();
			$phar->setStub($stub);

			$phar->stopBuffering();
			//$phar->compress(Phar::GZ);

		}else{
			throw new \Exception('Cannot create phar! (read-only enabled)');
		}

	}
}

?>