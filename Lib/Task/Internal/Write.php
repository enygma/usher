<?php
 /**
 * Write a message out as a part of the build
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
 
namespace Lib\Task\Internal;

/**
 * Class WriteTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class WriteTask extends \Usher\Lib\Task
{
    /**
     * Execute the task
     *
     * @return void
     */
    public function execute()
    {
        //echo out the string given in the parameter
        $message = $this->getOption('message');

        if ($message == null) {
            throw new \Exception('Message not found in write task');
        }

        \Usher\Lib\Console\Output::msg($message);       
    }
}

?>
