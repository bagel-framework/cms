<?php namespace Commander;

use Bagel\Cms\Commander\CommanderTrait;
use Illuminate\Support\Facades\App;
use Input;
use Mockery;

class CommanderTraitTest extends \Codeception\TestCase\Test {

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected $traitObject;

    protected $input;

    protected function _before()
    {
        $this->traitObject = new Foo();
        $this->input = array('foo' => 'bar');
    }

    public function _after()
    {
        Mockery::close();
    }

    public function testCommandGetsExecuted()
    {
        $commandBusMock = Mockery::mock('CommandBusStub')
            ->shouldReceive('execute')
            ->with(Mockery::type('Commander\CommandStub'))
            ->andReturn(true)
            ->getMock();

        $this->mockAppMake($commandBusMock);

        $result = $this->traitObject->execute(
            'Commander\CommandStub',
            $this->input
        );

        $this->assertTrue($result);
    }

    public function testDecoratorsGetApplied()
    {
        $commandBusMock = Mockery::mock('CommandBusStub')
            ->shouldReceive('decorate', 'execute')
            ->getMock();

        $this->mockAppMake($commandBusMock);

        $this->traitObject->execute(
            'Commander\CommandStub',
            $this->input,
            ['Commander\DecoratorStub']
        );
    }

    private function mockAppMake($commandBusMock)
    {
        App::shouldReceive('make')->once()
            ->with('Laracasts\Commander\CommandBus')
            ->andReturn($commandBusMock);
    }

}

// Stubs n Stuff
class Foo {
    use CommanderTrait;
}

class CommandStub {
    public function __construct($data)
    {
        $this->data = $data;
    }
}

class DecoratorStub {}