<?php

namespace Lib;

/**
 * Main application execution class
 *
 * @package Usher
 */
class Application
{
	private $currentTasks = array();

	private $failureMessages = array();

	/**
	 * Execute the build
	 *
	 * @return void
	 * @throws Exception
	 */
	public function execute()
	{
		foreach($this->getTasks() as $task){
			try {
				Console\Output::msg('Executing task: '.$task->configuration->type);

				if(method_exists($task,'init')){
					$task->init();
				}
				$task->execute();
			}catch(Exception $e){
				//$failureMessages[$task->configuration->id][] = $e->getMessage();
				throw new \Exception('Application error: '.$e->getMessage());
			}
		}
	}

	/**
	 * Get the list of current tasks and transform them into 
	 * the corresponding classes
	 *
	 * @return array $taskObjects Objects made from task data
	 */
	public function getTasks()
	{
		// pull them from the config file and make them classes
		$tasks 		 = Config::getOption('project.tasks');
		$project	 = Config::getOption('project');
		$taskObjects = array();

		foreach($tasks as $index => $task){

			$typeParts = explode('.',$task->type);
			$typePath  = '';
			foreach($typeParts as $part){
				$typePath .= ucwords(strtolower($part)).'\\';
			}
			$typePath = substr($typePath,0,strlen($typePath)-1);
			
			$taskName 		= '\Lib\\Task\\'.$typePath;
			$taskObject 	= new $taskName($project);
			$task->id = $index;
			$taskObject->configure($task);

			$taskObjects[] 	= $taskObject;
		}
		return $taskObjects;
	}
}

?>