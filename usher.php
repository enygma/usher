#!/usr/bin/php
<?php
/**
 * Usher.php
 *
 * PHP Version 5
 *
 * Main runner - loads configuration, finds and executes tasks
 *
 * @category Build
 * @package  User
 * @author   Chris Cornutt <ccornutt@phpdeveloper.org>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     http://github.com/enygma/usher
 */

namespace Usher;

require_once 'Lib/Loader.php';

try {
    Lib\Loader::init();
    Lib\Config::load();
    Lib\Console::init();
}catch(\Exception $e){
    Lib\Console\Output::msg('Error on setup: '.$e->getMessage());
    die();
}

$projectName = Lib\Config::getOption('project.name');
Lib\Console\Output::msg('Executing project "'.$projectName.'"');

// get and execute our tasks
try {
    $app = new Lib\Application();
    $app->execute();
}catch(\Exception $e){
    Lib\Console\Output::error('Error on build! ('.$e->getMessage().')');
}

?>
