<?php
 /**
 * Build a PHAR archive based on the given path
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Task\Package;

/**
 * Class PharTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class PharTask extends \Usher\Lib\Task
{
    /**
     * Execute the task
     *
     * @throws Exception
     * @return void
     */
    public function execute()
    {
        $target          = $this->getOption('target');
        $sourceDirectory = $this->getOption('sourceDirectory');
        $stubFile        = $this->getOption('stubFile');

        if (!extension_loaded('phar')) {
            throw new \Exception('Phar extension not loaded');
        }
        if (!is_dir($sourceDirectory)) {
            throw new \Exception('Source directory not found: '.$sourceDirectory);
        }

        // check to see if we can create phar files
        $readOnly = ini_get('phar.readonly');

        if ($readOnly != 1) {
            
            $phar = new \Phar($target, 0, basename($target));
            $phar->startBuffering();
            $phar->buildFromDirectory($sourceDirectory);

            $stub = $phar->createDefaultStub();
            $phar->setStub($stub);

            $phar->stopBuffering();
            //$phar->compress(Phar::GZ);

        } else {
            throw new \Exception('Cannot create phar! (read-only enabled)');
        }

    }
}

?>