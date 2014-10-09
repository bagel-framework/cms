<?php namespace Bagel\Cms\Controllers;

use Bagel\Cms\Sites\Commands\StoreSiteCommand;
use Bagel\Cms\Exceptions\BagelException;
use Bagel\Cms\Commander\CommanderTrait;
use Controller;
use Input;
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
        $parentSite = 1;

        return View::make('cms::sites.editsite', compact('templates', 'parentSite'));
    }

    /**
     * Save a new site in the database
     */
    public function store()
    {
        try
        {
            $this->execute(StoreSiteCommand::class, Input::except('_token'), ['Bagel\Cms\Sites\Validators\ValidateSiteToStore']);
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