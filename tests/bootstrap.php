<?php
# boostrap.php

namespace Usher;

require_once __DIR__.'/../Lib/Loader.php';

$baseDir = str_replace('/tests', '', __DIR__);
Lib\Loader::init($baseDir);
?>