<?php
# boostrap.php

namespace Usher;

require_once __DIR__.'/../Lib/Loader.php';

$baseDir = str_replace('/tests', '', __DIR__);
define('APPLICATION_PATH',$baseDir);

Lib\Loader::init($baseDir);
?>