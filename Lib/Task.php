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
	public function execute(){ }
}

?>