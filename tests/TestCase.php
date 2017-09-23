<?php

namespace Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
	protected function mock($class)
    {
        return $this->getMockBuilder($class)->disableOriginalConstructor()->getMock();
    }
}
