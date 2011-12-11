<?php

/**
 * This function is necessary for autloading classes in PHPUnit tests.
 * @param string $class Class name
 */
function phpunitAutoload($class)
{
    $filename = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR .
            'lib' . DIRECTORY_SEPARATOR .
            str_replace('\\', '/', strtolower($class)) . '.php';

    if (file_exists($filename))
    {
        require_once $filename;
    }
    else if (strpos($class, 'Test') !== false)
    {
        $testfile = __DIR__ . DIRECTORY_SEPARATOR .
                'lib' . DIRECTORY_SEPARATOR .
                str_replace('\\', '/', strtolower($class)) . '.php';

        if (file_exists($testfile))
        {
            require_once $testfile;
        }
    }
}

spl_autoload_register('phpunitAutoload');