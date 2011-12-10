<?php

namespace Lib;

class Task
{
	public $passStatus = true;

	public $configuration = array();

	public function configure($configData)
	{
		$this->configuration = $configData;
	}
}

?>