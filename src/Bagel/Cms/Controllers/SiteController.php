<?php namespace Bagel\Cms\Controllers;

use Bagel\Cms\Sites\Commands\StoreSiteCommand;
use Bagel\Cms\Exceptions\BagelException;
use Laracasts\Commander\CommanderTrait;
use Controller;
use View;

class SiteController extends Controller {

    use CommanderTrait;

    /**
     * Display the tree of the type bagel_root
     */
    public function index()
    {
        return View::make('cms::sites.index');
    }

    /**
     * Display the view to create a new site
     *
     * @todo fetch $templates from TemplateRepository
     */
    public function create()
    {
        $templates = array(1 => 'foo', 2 => 'bar');
        $parent_site = 1;

        return View::make('cms::sites.editsite', compact('templates', 'parent_site'));
    }

    /**
     * Save a new site in the database
     */
    public function store()
    {
        try
        {
            $this->execute(StoreSiteCommand::class, null, ['Bagel\Cms\Sites\Forms\ValidateStoreSiteForm']);
        }
        catch (BagelException $e)
        {
            dd($e->getErrors());
        }
    }

    /**
     * Update an existing site
     */
    public function update()
    {

    }

}