<?php

namespace Lib\Task;

class Sample extends \Lib\Task
{
	public function execute()
	{
		echo 'executing sample';
		throw new \Exception('fail!');
	}
}

?>