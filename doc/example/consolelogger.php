<?php
/**
 * Example of using the ConsoleLogger class.
 */

use codemonster\logphp;

// set include path and register spl_autoload function
$path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
        DIRECTORY_SEPARATOR . 'lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
spl_autoload_register();

// create ConsoleLogger
try
{
	$config = new logphp\config\LoggerConfig(logphp\Priority::DEBUG);
	$logger = new logphp\ConsoleLogger($config);
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