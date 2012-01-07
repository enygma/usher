<?php
 /**
 * Execute the PHPUnit-based test suite
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Lib\Task\Test;

/**
 * Class PHPUnitTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class PhpunitTask extends \Usher\Lib\Task
{
    /**
     * Execute the task
     *
     * @return void
     */
    public function execute()
    {
        $options    = $this->getOption('options');
        $exec       = 'phpunit ';

        if ($options == null) {
            throw new \Exception('Options not found in PHPUnit task');
        }

        if (isset($options[0]->path)) {
            $exec = $options[0]->path.' ';
            unset($options[0]->path);
        }

        // attach the options to the path
        foreach ($options[0] as $opt => $value) {
            $exec.=$opt.'="'.$value.'" ';
        }

        try {
            \Usher\Lib\Console\Execute::run($exec);
        }catch(\Exception $e){
            throw new \Exception('Error on command: '.$e->getMessage());
        }
    }
}

