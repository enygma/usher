<?php

namespace Lib\Console;

/**
 * Handles execution and output buffering of commands
 */
class Execute
{
	public function run($command,$workingDir=null)
	{
		$return = null;

		Output::msg('Executing command: "'.$command.'"');
		ob_start();
		$ret = system($command,$return);

		$buffer = ob_get_clean();
		if($buffer !== false){
			Output::msg("Execution result:\n".$buffer);
		}

		return $return;
	}
}

?>