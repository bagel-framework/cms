<?php namespace Bagel\Cms\Sites\Events;

use Bagel\Cms\Sites\SiteModel;

class SiteWasCreated {

    /**
     * @var SiteModel
     */
    private $site;

    public function __construct(SiteModel $site)
    {
        $this->site = $site;
    }

} 