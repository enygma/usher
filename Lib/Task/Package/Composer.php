<?php

namespace Usher\Lib\Task\Package;
use Usher\Lib\Utility as Util;
use Usher\Lib\Console as Console;

class ComposerTask extends \Usher\Lib\Task
{
	/**
	 * Default path for Composer phar
	 * @var string
	 */
	private $composerPath  = './bin/composer.phar';

	/**
	 * Path for temporary composer config
	 * @var string
	 */
	private $configFile = 'composer.json';
	
	public function execute()
	{
		$config 		= $this->getOption('config');
		$projectPath	= $this->getProjectOption('projectBase');
		$configString 	= Util\JsonHandler::output(json_encode($config));
		$currentDir		= getcwd();

		$composerPath	= $this->getOption('composerPath');
		if($composerPath != null){
			$this->composerPath = $composerPath;
		}else{
			throw new \Exception('Composer path not found in congifuration (composerPath)');
		}
		$exec = 'php '.$this->composerPath.' install';

		// composer doesn't let us specify the config on the command line
		// so let's write a temp file in our project path....
		if(is_dir($projectPath)){
			chdir($projectPath);
			file_put_contents($this->configFile,$configString);

			chdir($currentDir);

			// now run it!
			Console\Execute::run($exec,$projectPath);
		}else{
			throw new \Exception('Project directory not found! '.$projectPath);
		}
	}

}


?>
