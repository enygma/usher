<?php
 /**
 * Run the PHPDocumentor command to build the documentation
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
 * Class PhpdocumentorTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class PhpdocumentorTask extends \Lib\Task
{
    /**
     * Execute the task
     *
     * @return void
     */
    public function execute()
    {
        $options    = $this->getOption('options');
        $exec       = 'phpdoc ';

        if ($options == null) {
            throw new \Exception('Options not found in PHPDocumentor task');
        }

        $command = $this->appendOptions($exec, $options[0]);

        try {
            \Usher\Lib\Console\Execute::run($exec);
        }catch(\Exception $e){
            throw new \Exception('Error on command: '.$e->getMessage());
        }
    }
}

