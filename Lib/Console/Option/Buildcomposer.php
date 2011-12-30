<?php
/**
 * "Build Composer file" ption
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
 * Class Buildcomposer
 *
 * @category Build
 * @package  Usher
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 * @description Help option (display this info)
 */
class Buildcomposer extends \Usher\Lib\Console\Option
{
    /**
     * Execute the Help option
     *
     * @param array $argumentData Argument data
     *
     * @return bool Stop/Don't stop execution
     */
    public function execute($argumentData)
    {
        echo 'build a composer.json file';
        return true;
    }
}

?>
