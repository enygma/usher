<?php

namespace Usher\Lib;

/**
 * Loader class (sets up autoloader)
 *
 * @package Usher
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
        spl_autoload_register(array('Usher\Lib\Loader','autoload'));    
    }

    /**
     * Autoloader method, handles conversion of namespace paths
     *
     * @param string $className Name of the class requested
     * @return void
     * @throws Exception
     */
    public static function autoload($className)
    {
        $className = str_replace('Usher\\','',$className);

        // Strip off "Task" from the end to find our task files
        $pos       = strrpos($className,'Task');
        $className = ($pos && $className != 'Lib\Task') ? substr($className,0,$pos) : $className;
        $classPath = implode('/',explode('\\',$className)).'.php';

        if(is_file($classPath)){
            include_once $classPath;
        }else{
            throw new \Exception('Class "'.$className.'" not found');
        }
    }
}

?>