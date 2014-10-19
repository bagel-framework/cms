<?php namespace Bagel\Cms\Controllers;

use Bagel\Cms\Exceptions\BagelException;
use Bagel\Cms\Commander\CommanderTrait;
use Bagel\Cms\Sites\SiteModel;
use Bagel\Cms\Sites\SiteRepository;
use Controller;
use Illuminate\Support\Facades\Redirect;
use Input;
use View;

class SiteController extends Controller {

    use CommanderTrait;
    /**
     * @var SiteRepository
     */
    private $sites;

    public function __construct(SiteRepository $sites)
    {

        $this->sites = $sites;
    }

    /**
     * Redirect to root category
     * The root category always has id 1
     */
    public function index()
    {
        return Redirect::action('Bagel\Cms\Controllers\SiteController@category', array('site' => 1));
    }

    /**
     * Show the structure of the current category
     *
     * @param integer $siteId
     */
    public function category($siteId = 1)
    {
        $structure = $this->sites->getChildrenByParentId($siteId);

        return View::make('cms::sites.index')->with(compact('structure'));
    }

    /**
     * Display the view to create a new site
     *
     * @todo fetch $templates from TemplateRepository
     */
    public function create()
    {
        $templates = [1 => 'foo', 2 => 'bar'];
        $parentSite = 1;

        return View::make('cms::sites.editsite', compact('templates', 'parentSite'));
    }

    /**
     * Save a new site in the database
     */
    public function store()
    {
        $data = [
            'parent_site' => Input::get('parent_site'),
            'type'        => Input::get('type'),
            'template_id' => Input::get('template_id'),
            'name'        => Input::get('name'),
            'slug'        => Input::get('slug'),
            'is_home'     => Input::get('is_home', 0),
        ];

        try
        {
            $this->execute(
                'Bagel\Cms\Sites\Commands\StoreSiteCommand',
                $data,
                ['Bagel\Cms\Sites\Validators\ValidateSiteToStore']
            );
        }
        catch(BagelException $e)
        {
            return Redirect::back()->withInput()->with(['errors' => $e->getErrors()->all()]);
        }

        return Redirect::action('Bagel\Cms\Controllers\SiteController@index', array('site' => Input::get('current', 1)))
            ->with(['messages' => [trans('sites.created_successful')]]);
    }

    /**
     * Display the view to edit an existing Site
     */
    public function edit()
    {

    }

    /**
     * Update an existing Site in the DB
     */
    public function update()
    {

    }

    public function toggleVisibility($siteId)
    {

    }

    public function toggleStatus($siteId)
    {

    }

    public function move($siteId)
    {

    }

    public function delete($siteId)
    {

    }

}