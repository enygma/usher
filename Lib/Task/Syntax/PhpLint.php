<?php
 /**
 * Check the project directory for PHP syntax errors
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Lib\Task\Syntax;

/**
 * Class PhpLintTask
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class PhpLintTask extends \Lib\Task
{
    /**
     * Execute the task
     *
     * @throws Exception
     * @return void
     */
    public function execute()
    {
        // get the project basedir
        $projectDir = $this->getProjectOption('projectBase');

        if ($projectDir != null && is_dir($projectDir)) {
            $exec = 'php -l '.$projectDir;
            \Lib\Console\Execute::run($exec);
        } else {
            throw new \Exception(
                'Could not determine project directory (projectBase)'
            );
        }
        
    }

}

?>
