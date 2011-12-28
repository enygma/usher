<?php
/**
 * Generic repository for storage in current execution
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
namespace Usher\Lib\Utility;

/**
 * Class SessionManage
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class SessionManage
{
    /**
     * Internal repository storage
     */
    private static $_repository;
    
    /**
     * Set a value into the registry
     *
     * @param string $keyname   Key name
     * @param mixed  $value     Value for the key
     * @param string $namespace Namespace (defaults to general)
     *
     * @return void
     */
    public static function set($keyname,$value,$namespace='general')
    {
        self::$_repository[$namespace][$keyname] = $value;
    }

    /**
     * Get a keyname's value from the repository
     *
     * @param string $keyname   Key name
     * @param string $namespace Namespace (defaults to general)
     *
     * @return mixed Value
     */
    public static function get($keyname,$namespace='general')
    {
        return (isset(self::$_repository[$namespace][$keyname])) 
            ? self::$_repository[$namespace][$keyname] : null;
    }
}

?>