<?php namespace Bagel\Cms\Sites\Handlers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\CommandHandler;
use Bagel\Cms\Sites\SiteRepository;

class StoreSiteCommandHandler implements CommandHandler {

    use DispatchableTrait;

    /**
     * @var SiteRepository
     */
    protected $sites;

    public function __construct(SiteRepository $sites)
    {
        $this->sites = $sites;
    }

    /**
     * Handle the creation of a new site in
     * the DB.
     *
     * @param  object  $command  Bagel\Cms\Sites\Commands\StoreSiteCommand
     * @return void
     */
    public function handle($command)
    {
        $parent = $this->getParent($command->parent_site);

        $site = $this->sites->store($parent, $command);

        $this->dispatchEventsFor($site);
    }

    /**
     * Get the SiteModel of the parent site so we know
     * where we have to store the site currently in question
     *
     * @param  integer  $siteId
     * @return SiteModel
     */
    protected function getParent($siteId)
    {
        return $this->sites->findOrFail($siteId);
    }

}