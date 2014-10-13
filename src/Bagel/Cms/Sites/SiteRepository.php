<?php namespace Bagel\Cms\Sites;

use Bagel\Cms\Sites\Events\SiteWasCreated;
use Laracasts\Commander\Events\EventGenerator;
use Bagel\Cms\Sites\Commands\StoreSiteCommand;

class SiteRepository {

    use EventGenerator;

    /**
     * @var SiteModel
     */
    protected $model;

    public function __construct(SiteModel $site)
    {
        $this->model = $site;
    }

    /**
     * Store a new Site in the DB
     *
     * @param SiteModel        $parent
     * @param StoreSiteCommand $command
     * @return \Bagel\Cms\Sites\SiteModel
     */
    public function store(SiteModel $parent, StoreSiteCommand $command)
    {
        $site = $parent->children()->create($command->toArray());

        $this->raise(new SiteWasCreated($site));

        return $site;
    }

    /**
     * Find a Site by its id and throw an exception
     * if not found
     *
     * @param  integer $id
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @return SiteModel
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

}