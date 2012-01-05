<?php
 /**
 * Run the DocBlox command to build the documentation
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Lib\Task\Documentation;

/**
 * Class DocbloxTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class DocbloxTask extends \Lib\Task
{
    /**
     * Execute the task
     *
     * @return void
     */
    public function execute()
    {
        $options    = $this->getOption('options');
        $exec       = 'docblox ';

        if ($options == null) {
            throw new \Exception('Options not found in DocBlox task');
        }

        $command = $this->appendOptions($exec, $options[0]);

        try {
            \Usher\Lib\Console\Execute::run($exec);
        }catch(\Exception $e){
            throw new \Exception('Error on command: '.$e->getMessage());
        }
    }
}

