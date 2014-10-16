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
     * @param  \Bagel\Cms\Sites\Commands\StoreSiteCommand $command
     * @return void
     */
    public function handle($command)
    {
        $parent = $this->getParent($command->parent_site);

        $this->sites->store($parent, $command);

        $this->dispatchEventsFor($this->sites);
    }

    /**
     * Get the SiteModel of the parent site so we know
     * where we have to store the site currently in question
     *
     * @param  int $siteId
     * @return \Bagel\Cms\Sites\SiteModel
     */
    protected function getParent($siteId)
    {
        return $this->sites->findOrFail($siteId);
    }

}