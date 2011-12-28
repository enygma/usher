<?php
 /**
 * Execute the given command
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Lib\Task\System;

/**
 * Class ExecTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class ExecTask extends \Lib\Task
{
    /**
     * Execute the task
     *
     * @throws Exception
     * @return void
     */
    public function execute()
    {
        $command = $this->getOption('command');
        try {
            \Lib\Console\Execute::run($command);
        }catch(\Exception $e){
            throw new \Exception('Error on command: '.$e->getMessage());
        }
    }

}

?>
