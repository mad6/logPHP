<?php

namespace codemonster\logphp;

/**
 * Test class for Exception.
 * Generated by PHPUnit on 2011-12-09 at 21:45:27.
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    public function testConstruct()
    {
        $this->setExpectedException('\\codemonster\\logphp\\Exception',
                'Test exception', 99);
        throw new Exception('Test exception', 99);
    }

}