<?php namespace Bagel\Cms\Commander;

use Laracasts\Commander\HandlerNotRegisteredException;
use Laracasts\Commander\CommandTranslator;

class BagelCommandTranslator implements CommandTranslator {

    /**
     * Translate a command to its handler counterpart
     *
     * @param $command
     * @return mixed
     * @throws HandlerNotRegisteredException
     */
    public function toCommandHandler($command)
    {
        $commandClass = get_class($command);

        $handler = substr_replace($commandClass, 'CommandHandler', strrpos($commandClass, 'Command'));
        $handler = str_replace('Commands', 'Handlers', $handler);

        if (!class_exists($handler))
        {
            $message = "Command handler [$handler] does not exist.";

            throw new HandlerNotRegisteredException($message);
        }

        return $handler;
    }


    /**
     * Translate a command to its validator counterpart
     *
     * @param $command
     * @return mixed
     */
    public function toValidator($command)
    {
        // not used anymore, keep until we update the package
    }
}