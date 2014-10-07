@extends('cms::layouts.base')

@section('metatitle')
    @parent @lang('cms::sites.metatitle_edit')
@stop

@section('content')
    <div class="clearfix">
        <h3 class="font-thin">
        @if(!isset($site))
            @lang('cms::sites.maintitle_create')
        @else
            @lang('cms::sites.maintitle_cedit')
        @endif
        </h3>
    </div>

    <div class="row">
        @include('cms::sites.includes.breadcrumbs')
        <div class="col-sm-6">
            <section class="panel">
                <header class="panel-heading">
                    @lang('cms::sites.general')
                    <ul class="nav nav-pills pull-right">
                        <li>
                            <a class="panel-toggle text-muted" href="#"><i class="icon-caret-down icon-large text-active"></i><i class="icon-caret-up icon-large text"></i></a>
                        </li>
                    </ul>
                </header>
                @if(!isset($site))
                    <div class="panel-body with-slugit">
                        {{Form::open(array('action' => 'Bagel\Cms\Controllers\SiteController@store', 'class' => 'form-horizontal', 'data-validate' => 'parsley'))}}
                        {{Form::hidden('parent_site', 1)}}
                        {{Form::hidden('type', 'bagel_site')}}
                @else
                    <div class="panel-body collapse">
                        {{Form::model($site, array('action' => array('Bagel\Cms\Controllers\SiteController@update', $site->id), 'class' => 'form-horizontal', 'data-validate' => 'parsley'))}}
                @endif
                        @if(!isset($site) OR Input::old('template_id') != null)
                            {{Form::bagelDropdown('template_id', 'Template', Input::old('template_id'), $templates)}}
                        @else
                            {{Form::bagelDropdown('template_id', 'Template', $site->template_id, $templates)}}
                        @endif
                        {{Form::bagelInput('name', 'Name', null, true)}}
                        {{Form::bagelInput('slug', 'Slug', null, true)}}
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Startseite</label>
                            <div class="col-lg-9 scrollbar scroll-y" style="max-height: 260px">
                                <div class="checkbox">
                                    <label>
                                        {{Form::checkbox('is_home')}} @lang('cms::sites.set_start'): <b>{{$parent_site}}</b>.<br>
                                        @if($parent_site !== null)
                                            <small>@lang('cms::sites.current_start'): {{$parent_site}}</small>
                                        @else
                                            <small>@lang('cms::sites.current_start'): @lang('cms::sites.none')</small>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{Form::bagelSubmit('Bagel\Cms\Controllers\SiteController@index', array('site' => $parent_site))}}
                    {{Form::close()}}
                </div>
            </section>
        </div>
        <div class="col-sm-6">
            <section class="panel">
                <header class="panel-heading">
                    @lang('cms::sites.options')
                    <ul class="nav nav-pills pull-right">
                        <li>
                            <a class="panel-toggle text-muted" href="#"><i class="icon-caret-down icon-large text-active"></i><i class="icon-caret-up icon-large text"></i></a>
                        </li>
                    </ul>
                </header>
                <div class="panel-body">
                    @if(isset($site))
                        <p><a href="" target="_blank">@lang('cms::sites.open_in_frontend')</a></p>
                    @endif
                </div>
            </section>
        </div>
    </div>
@stop