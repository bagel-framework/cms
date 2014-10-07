<?php namespace Bagel\Cms\Sites\Commands;

class StoreSiteCommand {

    public $parent_site;

    public $type;

    public $template_id;

    public $name;

    public $slug;

    public $is_home;

    public function __construct($parent_site, $type, $template_id, $name, $slug, $is_home = 0)
    {
        $this->parent_site = $parent_site;
        $this->type        = $type;
        $this->template_id = $template_id;
        $this->name        = $name;
        $this->slug        = $slug;
        $this->is_home     = $is_home;
    }

}