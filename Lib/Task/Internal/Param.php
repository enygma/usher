<?php
 /**
 * Set an internal parameter
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Task\Internal;

/**
 * Class ParamTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class ParamTask extends \Usher\Lib\Task
{
    /**
     * Execute the task
     *
     * @return void
     */
    public function execute()
    {
        //set up a valirable internal to the scope of the execution 
        $value = $this->getOption('value');
        $name  = $this->getOption('name');

        \Usher\Lib\Utility\SessionManage::set($name, $value);
    }
}

?>
