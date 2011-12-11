<?php

namespace codemonster\logphp;

use codemonster\logphp\Priority;

/**
 * Test class for FileLogger.
 * Generated by PHPUnit on 2011-12-09 at 21:40:17.
 */
class FileLoggerTest extends LoggerTest
{

    /**
     * @var config\FileLoggerConfig
     */
    protected $config;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'testdir';
        $filename = $dir . DIRECTORY_SEPARATOR . 'log_test.log';

        if (file_exists($filename))
        {
            unlink($filename);
        }

        $this->config = new config\FileLoggerConfig($filename);
        $this->object = new FileLogger($this->config);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        // remove created temporary log file
        unlink($this->config->getFilename());
        // remove created temporary log directory
        rmdir(dirname($this->config->getFilename()));
    }

    public function testConstructInvalidFile()
    {
        $dir = sys_get_temp_dir();
        $config = new config\FileLoggerConfig($dir . DIRECTORY_SEPARATOR . '');
        $this->setExpectedException('\\codemonster\\logphp\\Exception');
        $logger = new FileLogger($config);
    }

    public function testOpenFile()
    {
        self::assertFileExists($this->config->getFilename());
        $mode = fileperms($this->config->getFilename());
        self::assertEquals($this->config->getFileMode(), $mode & 0777);

        $mode = fileperms(dirname($this->config->getFilename()));
        self::assertEquals($this->config->getDirMode(), $mode & 0777);
    }

    public function testCloseFile()
    {
        unset($this->object);

        $fh = fopen($this->config->getFilename(), 'r');
        self::assertTrue(is_resource($fh), 'Can\'t open log file.');
        self::assertTrue(flock($fh, LOCK_EX), 'Can\'t lock log file.');
        flock($fh, LOCK_UN);
        fclose($fh);
    }

    public function testDoLog()
    {
        parent::testLog();
        self::assertNotEmpty(file_get_contents($this->config->getFilename()),
                'Log file is empty');
    }

    public function testEmerg()
    {
        parent::testEmerg();
        $this->checkFileContent('emergency message');
    }

    public function testAlert()
    {
        parent::testAlert();
        $this->checkFileContent('alert message');
    }

    public function testCrit()
    {
        parent::testCrit();
        $this->checkFileContent('critical message');
    }

    public function testErr()
    {
        parent::testErr();
        $this->checkFileContent('error message');
    }

    public function testNotice()
    {
        parent::testNotice();
        $this->checkFileContent('notice message');
    }

    public function testInfo()
    {
        parent::testInfo();
        $this->checkFileContent('info message');
    }

    public function testDebug()
    {
        parent::testDebug();
        $this->checkFileContent('debug message');
    }

    private function checkFileContent($msg)
    {
        self::assertRegExp('/' . $msg . '/',
                file_get_contents($this->config->getFilename()));
    }

}