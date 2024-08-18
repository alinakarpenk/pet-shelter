<?php
function autoload($className)
{
    $path = str_replace('\\', '/', $className . '.php');
    if (file_exists($path)) {
        include_once($path);
    }
}
spl_autoload_register('autoload');
$page = isset($_GET['page']) ? $_GET['page'] : '';
$core = \core\Core::getInstance();
$core->splitURL($page);
$core->done();



