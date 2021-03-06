<?php

namespace codemonster\logphp\config;

use codemonster\logphp\Priority;

/**
 * Test class for LoggerConfig.
 * Generated by PHPUnit on 2011-12-09 at 21:47:30.
 */
class LoggerConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var LoggerConfig
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new LoggerConfig();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    public function testSetLogLevel()
    {
        for ($p = Priority::EMERG; $p <= Priority::DEBUG; ++$p)
        {
            $this->object->setLogLevel($p);
            self::assertEquals($p, $this->object->getLogLevel());
        }

        $this->setExpectedException(
                '\\codemonster\\logphp\\config\\LoggerConfigException');
        $this->object->setLogLevel('invalid log level');
    }

    public function testGetLogLevel()
    {
        for ($p = Priority::EMERG; $p <= Priority::DEBUG; ++$p)
        {
            $this->object->setLogLevel($p);
            self::assertEquals($p, $this->object->getLogLevel());
        }
    }

    public function testSetTimeFormat()
    {
        $format = '%Y-%m-%d %H:%i:%s';
        $this->object->setTimeFormat($format);
        self::assertEquals($format, $this->object->getTimeFormat());

        $format = '';
        $this->setExpectedException(
                '\\codemonster\\logphp\\config\\LoggerConfigException');
        $this->object->setTimeFormat($format);
    }

    public function testGetTimeFormat()
    {
        $format = '%Y-%m-%d %H:%i:%s';
        $this->object->setTimeFormat($format);
        self::assertEquals($format, $this->object->getTimeFormat());
    }

}