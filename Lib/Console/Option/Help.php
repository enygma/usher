<?php
/**
 * Help option
 *
 * PHP Version 5
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher\Lib\Console\Option;

/**
 * Class Help
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 * @description Help option (display this info)
 */
class Help extends \Usher\Lib\Console\Option
{
    /**
     * Execute the Help option
     *
     * @return bool Stop/Don't stop execution
     */
    public function execute()
    {
        \Usher\Lib\Console\Output::msg('Help Information:');

        /**
         * look through all of our option and find the 
         * docblock comments with their description
         */
        $iterator           = new \DirectoryIterator(__DIR__);
        $optionMaxLength    = 0;
        $options            = array();

        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isFile()) {                
                // include the file so we can get it's class
                $fileName   = str_replace('.php', '', $fileinfo->getFilename());
                $className  = '\\Usher\\Lib\\Console\\Option\\'.$fileName;

                include_once $fileinfo->getPathname();

                $ref        = new \ReflectionClass($className);
                $comment    = $ref->getDocComment();

                //see if we have a 
                if (preg_match('/@description(.+)/', $comment, $matches) !== false) {
                    $options[strtolower($fileName)] = trim($matches[1]);

                    if (strlen($fileName)>$optionMaxLength) {
                        $optionMaxLength = strlen($fileName);
                    }
                }
            }
        }

        // now echo out our options
        if (!empty($options)) {
            // pad out the value to our max length
            foreach ($options as $keyName => $option) {
                echo ' --'.str_pad($keyName, $optionMaxLength+1, " ", STR_PAD_RIGHT).
                    ' : '.$option."\n";
            }
        }

        //and one last line for good luck
        echo "\n";

        return false;
    }
}

?>