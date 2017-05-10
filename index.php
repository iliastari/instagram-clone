<?php
require 'config.php';

require LIBS.'functions/functions.php';

function __autoload($class) {
    require LIBS . $class .".php";
}

$app = new Bootstrap();



