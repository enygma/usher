<?php
/**
 * Definiton of a custom tasks directory
 *   Allows a source for additional tasks to be autloaded (single dir level)
 *
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console\Option;

/**
 * Class Customdir
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 * @description Define a custom tasks directory
 */
class Customdir extends \Usher\Lib\Console\Option
{
    /**
     * Execute the TaskDir option
     *
     * @param array $argumentData Argument data
     *
     * @return bool Stop/Don't stop execution
     */
    public function execute($argumentData)
    {
        $directory = $argumentData[1];
        if (!is_dir($directory)) {
            throw new \RuntimeException(
                'Tasks directory "'.$directory.'" could not be accessed.'
            );
        }
        \Usher\Lib\Console::setOption('customTaskDir', $directory);

        \Usher\Lib\Loader::registerAutoload(
            array(__CLASS__,'autoload')
        );

        return true;
    }

    /**
     * Set up the autoloader with our new directory
     *
     * @param string $className Name of class to load
     *
     * @return void
     */
    public static function autoload($className)
    {
        $directory = \Usher\Lib\Console::getOption('customTaskDir');
        \Usher\Lib\Loader::autoload($className, $directory);
    }
}

?>
