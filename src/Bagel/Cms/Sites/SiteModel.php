<?php namespace Bagel\Cms\Sites;

use Baum\Node;
use Bagel\Cms\Translator\Translatable;

class SiteModel extends Node {

    use Translatable;

    protected $table = 'sites';

    protected $translatedModel = 'Bagel\Cms\Sites\SiteTranslationModel';

    protected $translatedModelForeignKey = 'site_id';

    protected $translatedAttributes = ['name', 'slug', 'is_online', 'is_visible'];

    protected $with = ['currentTranslation'];

    protected $fillable = [
        'type',
        'template_id',
        'name',
        'slug',
        'is_home',
        'is_online',
        'is_vislibe',
    ];

}