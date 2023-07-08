<?php

namespace Phetit\PackageTemplate\Tests;

use Phetit\PackageTemplate\Example;
use PHPUnit\Framework\TestCase;

/**
 * ExampleTest
 * @group group
 */
class ExampleTest extends TestCase
{
    public function testFoo()
    {
        $example = new Example();

        $this->assertEquals('bar', $example->foo());
    }
}
