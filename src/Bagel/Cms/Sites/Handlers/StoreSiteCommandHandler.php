<?php namespace Bagel\Cms\Sites\Handlers;

use Laracasts\Commander\CommandHandler;

class StoreSiteCommandHandler implements CommandHandler {

    /**
     * Handle the creation of a new site in
     * the DB. This is mostly delegated to the
     * SiteRepository
     *
     * @param  object  $command  Bagel\Cms\Sites\Commands\StoreSiteCommand
     * @return void
     */
    public function handle($command)
    {
        var_dump('arrived!');
        dd($command);
    }

}