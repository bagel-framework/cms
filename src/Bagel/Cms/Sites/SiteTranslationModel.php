<?php namespace Bagel\Cms\Sites;

use Illuminate\Database\Eloquent\Model;

class SiteTranslationModel extends Model {

    protected $table = 'sites_translations';

    protected $fillable = [
        'name',
        'slug',
        'is_online',
        'is_visible'
    ];

}