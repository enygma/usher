<?php
# boostrap.php

namespace Usher;

require_once '../Lib/Loader.php';

$baseDir = str_replace('/tests', '', __DIR__);
Lib\Loader::init($baseDir);
?>