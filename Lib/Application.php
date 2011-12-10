<?php

namespace Lib;

class Application
{
	private $currentTasks = array();

	private $failureMessages = array();

	public function execute()
	{
		foreach($this->getTasks() as $task){
			try {
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

	public function getTasks()
	{
		// pull them from the config file and make them classes
		$tasks 		 = Config::getOption('project.tasks');
		$taskObjects = array();

		foreach($tasks as $index => $task){
			$taskName 		= '\Lib\\Task\\'.ucwords(strtolower($task->type));
			$taskObject 	= new $taskName();
			$task->id = $index;
			$taskObject->configure($task);

			$taskObjects[] 	= $taskObject;
		}
		return $taskObjects;
	}
}

?>