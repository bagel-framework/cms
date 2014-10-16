<?php namespace Commander;

use Bagel\Cms\Commander\BagelCommandTranslator;
use Foo\Bar\Commands\BarCommand;
use Foo\Bar\Commands\FooCommand;

class CommandTranslatorTest extends \Codeception\TestCase\Test {

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $bagelCommandTranslator;

    protected function _before()
    {
        $this->bagelCommandTranslator = new BagelCommandTranslator();
    }

    public function testTranslatorTranslatesClassnameAndNamespace()
    {
        $command = new FooCommand();
        $expectedHandler = 'Foo\Bar\Handlers\FooCommandHandler';

        $handler = $this->bagelCommandTranslator->toCommandHandler($command);

        $this->tester->assertEquals($handler, $expectedHandler);
    }

    /**
     * @expectedException Laracasts\Commander\HandlerNotRegisteredException
     */
    public function testTranslatorThrowsExceptionIfHandlerDoesNotExist()
    {
        $command = new BarCommand();

        $this->bagelCommandTranslator->toCommandHandler($command);
    }

}

// Stubs n Stuff
namespace Foo\Bar\Commands;
class FooCommand {}
class BarCommand {}

namespace Foo\Bar\Handlers;
class FooCommandHandler {}

