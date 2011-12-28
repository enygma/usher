<?php
/**
 * Loader for automatic class loading
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
namespace Usher\Lib;

/**
 * Class Loader
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class Loader
{
    /**
     * Initialize the loader, set up the autoloader
     *
     * @return void
     */
    public static function init()
    {
        self::registerAutoload(array('Usher\Lib\Loader', 'autoload'));
        self::registerAutoload(array('Usher\Lib\Loader', 'autoloadFail'), false);
    }

    /**
     * Register an autoloader with the autoload details given
     *
     * @param array $autoloadDetail Autoload details (class/method)
     * @param bool  $prepend        Prepend the autoloader to the stack
     *
     * @return void
     */
    public static function registerAutoload($autoloadDetail,$prepend=true)
    {
        spl_autoload_register($autoloadDetail, true, $prepend);
    }

    /**
     * Autoloader method, handles conversion of namespace paths
     *
     * @param string $className Name of the class requested
     * @param string $directory Custom directory to add to the autoloader
     *
     * @return void
     * @throws Exception
     */
    public static function autoload($className,$directory=null)
    {
        $className = str_replace('Usher\\', '', $className);

        // Strip off "Task" from the end to find our task files
        $pos       = strrpos($className, 'Task');
        $className = ($pos && $className != 'Lib\Task') 
            ? substr($className, 0, $pos) : $className;

        $classPaths = array();
        $found      = false;

        $classPaths[] = implode('/', explode('\\', $className)).'.php';
        if ($directory !== null) {
            $nameParts      = explode('\\', $className);
            $classPaths[]   = $directory.'/'.$nameParts[count($nameParts)-1].'.php';
        }

        foreach ($classPaths as $classPath) {
            if (is_file($classPath)) {
                include_once $classPath;
            }
        }
    }

    /**
     * Failover autoloader...if it hits this, it can't find it anywhere else
     *
     * @param string $className Class name to load
     *
     * @throws Exception
     * @return void
     */
    public static function autoloadFail($className)
    {
        throw new \Exception('Class "'.$className.'" not found');
    }
}

?>