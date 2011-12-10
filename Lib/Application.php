<?php

namespace Lib;

class Application
{
	private $currentTasks = array();

	public function exec()
	{
		$tasks = $this->getTasks();
		var_dump($tasks);
	}

	public function getTasks()
	{
		// pull them from the config file and make them classes
		$tasks 		 = Config::getOption('project.tasks');
		$taskObjects = array();

		foreach($tasks as $task){
			$taskName 		= '\Lib\\Task\\'.ucwords(strtolower($task->type));
			$taskObject 	= new $taskName();
			$taskObject->configure($task);

			$taskObjects[] 	= $taskObject;
		}
		return $taskObjects;
	}
}

?>