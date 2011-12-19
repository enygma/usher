<?php
/**
 * Generic repository for storage in current execution
 * 
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
namespace Usher\Lib\Utility;

/**
 * Class SessionManage
 *
 * @category Build
 * @package  User
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
     * @param string $keyname Key name
     * @param mixed  $value   Value for the key
     *
     * @return void
     */
    public static function set($keyname,$value)
    {
        self::$_repository[$keyname] = $value;
    }

    /**
     * Get a keyname's value from the repository
     *
     * @param string $keyname Key name
     *
     * @return mixed Value
     */
    public static function get($keyname)
    {
        return (isset(self::$_repository[$keyname])) 
            ? self::$_repository[$keyname] : null;
    }
}

?>