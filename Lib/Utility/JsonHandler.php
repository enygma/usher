<?php
/**
 * Utility to handle JSON correctly
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
 * Class JsonHandler
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */
class JsonHandler
{
    /**
     * Build the JsonHandler object
     */
    public function __construct()
    {
        //TODO        
    }

    /**
     * Output the JSON, minus any extra slashes
     *
     * @param string $jsonString Input JSON string
     *
     * @return string $jsonString JSON string, minus slashes
     */
    public static function output($jsonString)
    {
        return stripslashes($jsonString);
    }
}

?>