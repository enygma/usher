<?php
/**
 * Handles execution and output buffering of commands
 *
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console;

/**
 * Class Execute
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class Execute
{
    /**
     * Execute the given command
     *
     * @param string $command Command to execute
     * @param array  $args    Arguments for command
     *
     * @return mixed $return Command output
     */
    public function run($command,$args=null)
    {
        Output::msg('Executing command: "'.$command.'"');

	// filter the command
        $command = escapeshellcmd($command);

        $descSpec = array(
            0 => array('pipe', 'r'), //stdin
            1 => array('pipe', 'w'), //stdout
            //2 => array('file','/tmp/error-out.log','a') //stderr
            2 => array('pipe', 'w') // stderr
        );
        $pipes   = null;
        $return  = null;
        $process = proc_open($command, $descSpec, $pipes);

        if (is_resource($process)) {

            $return = stream_get_contents($pipes[1]);

            if (empty($return)) {
                // probably some sort of error
                if (is_resource($pipes[2])) {
                    $err = trim(stream_get_contents($pipes[2]));
                    fclose($pipes[2]);
                    throw new \Exception($err);
                }
            }
            fclose($pipes[1]);

            $returnCode = proc_close($process);
            Output::msg("Execution result:\n".$return);
        }

        return $return;
    }
}

?>
