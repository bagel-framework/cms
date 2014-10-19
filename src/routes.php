<?php

Route::group(array('prefix' => 'bagel'), function ()
{
    Route::group(array('prefix' => 'sites'), function ()
    {
        Route::get('/', array('uses' => 'Bagel\Cms\Controllers\SiteController@index'));
        Route::get('category/{site}', array('uses' => 'Bagel\Cms\Controllers\SiteController@category'));
        Route::get('site/create', array('uses' => 'Bagel\Cms\Controllers\SiteController@create'));
        Route::post('site', array('uses' => 'Bagel\Cms\Controllers\SiteController@store'));
        Route::get('site/{site}/edit', array('uses' => 'Bagel\Cms\Controllers\SiteController@edit'));
        Route::post('site/{site}', array('uses' => 'Bagel\Cms\Controllers\SiteController@update'));
        Route::get('site/{site}/delete', array('uses' => 'Bagel\Cms\Controllers\SiteController@delete'));
        Route::get('site/{site}/togglestatus',  array('uses' => 'Bagel\Cms\Controllers\SiteController@toggleStatus'));
        Route::get('site/{site}/togglevisibility',  array('uses' => 'Bagel\Cms\Controllers\SiteController@toggleVisibility'));
        Route::get('site/{site}/move',  array('uses' => 'Bagel\Cms\Controllers\SiteController@move'));
        // Route::get('site/clearcache', array('uses' => 'Bagel\Cms\Controllers\SiteController@clearCache'));
    });

});