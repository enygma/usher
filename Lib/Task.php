<?php

namespace Lib;

abstract class Task
{
	public $passStatus = true;

	public $configuration = array();

	public function configure($configData)
	{
		$this->configuration = $configData;
	}
	public function getOption($optionName)
	{
		return (isset($this->configuration->$optionName)) 
			? $this->configuration->$optionName : null;
	}
	public function execute(){ }
}

?>