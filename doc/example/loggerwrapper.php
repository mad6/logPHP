<?php
/**
 * Example of using the LoggerWrapper class.
 */

use codemonster\logphp;

// set include path and register spl_autoload function
$path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' .
        DIRECTORY_SEPARATOR . 'lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
spl_autoload_register();

class TestLogger implements logphp\ILogger
{

    public function log($message, $priority)
    {
        printf("%s [%s]\t%s%s", strftime('%Y-%m-%d %H:%M:%S'),
                logphp\Priority::getPriorityName($priority), $message, PHP_EOL);
        return true;
    }

}

// create LoggerWrapper
try
{
    $config = new logphp\config\LoggerConfig(logphp\Priority::DEBUG);
    $testlogger = new TestLogger();
    $logger = new logphp\LoggerWrapper($testlogger, $config);
}
catch (LoggerException $exc)
{
    echo $exc->getMessage() . PHP_EOL;
    exit(1);
}

// log messages
$logger->info('Info message');
$logger->err('Err message');
$logger->debug('Debug message');