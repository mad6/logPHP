<?php
/**
 * Example of using the FileLogger class.
 */

use codemonster\logphp;

// set include path and register spl_autoload function
$path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
        DIRECTORY_SEPARATOR . 'lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
spl_autoload_register();

// create FileLogger
try
{
    $dir = sys_get_temp_dir();
    $filename = $dir . DIRECTORY_SEPARATOR . 'test.log';
    $config = new logphp\config\FileLoggerConfig($filename, logphp\Priority::DEBUG);
    $logger = new logphp\FileLogger($config);
}
catch (Exception $exc)
{
    echo $exc->getMessage() . PHP_EOL;
    exit(1);
}

// log messages
$logger->info('Info message');
$logger->err('Err message');
$logger->debug('Debug message');
