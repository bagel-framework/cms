<?php namespace Bagel\Cms\Commander;

use InvalidArgumentException;
use Input, App;

trait CommanderTrait {

    /**
     * Execute the command
     *
     * @param  string $command
     * @param  array  $input
     * @param  array  $decorators
     * @return mixed
     */
    public function execute($command, array $input = null, $decorators = [])
    {
        $input = $input ?: Input::all();

        $command = new $command($input);
        $bus = $this->getCommandBus();

        // If any decorators are passed, we'll
        // filter through and register them
        // with the CommandBus, so that they
        // are executed first.
        foreach ($decorators as $decorator)
        {
            $bus->decorate($decorator);
        }

        return $bus->execute($command);
    }

    /**
     * Fetch the command bus
     *
     * @return mixed
     */
    public function getCommandBus()
    {
        return App::make('Laracasts\Commander\CommandBus');
    }

}