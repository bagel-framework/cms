@extends('cms::layouts.base')

@section('metatitle')
    @parent @lang('cms::sites.metatitle')
@stop

@section('content')
    <div class="clearfix">
        <h3 class="font-thin">@lang('cms::sites.maintitle')</h3>
    </div>

    <div class="row">
        @include('cms::sites.includes.breadcrumbs')
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading"><i class="icon-sitemap"></i> @lang('cms::sites.structure_panel_heading')</header>
                <div class="panel-body">
                    <div class="row text-small">
                        <div class="col-sm-12 m-b-mini">
                            <a class="btn btn-sm btn-white" href=""><i class="icon-file-alt"></i> @lang('cms::sites.create_site')</a>
                            <a class="btn btn-sm btn-white" href=""><i class="icon-book"></i> @lang('cms::sites.create_category')</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t text-small">
                        <thead>
                            <tr>
                                <th width="40"></th>
                                <th width="50">@lang('cms::sites.table.id')</th>
                                <th>@lang('cms::sites.table.name')</th>
                                <th>@lang('cms::sites.table.slug')</th>
                                <th>@lang('cms::sites.table.template')</th>
                                <th width="70">@lang('cms::sites.table.status')</th>
                                <th width="70">@lang('cms::sites.table.visibility')</th>
                                <th width="110">@lang('cms::sites.table.actions')</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                <!-- <div class="panel-body b-t">
                    <p>Die Kategorie enhätlt noch keine Strukturelemente.
                    Wie wäre es zum Beispiel mit einer <a href="">ersten Unterseite?</a></p>
                </div> -->
                </div>
            </section>
        </div>
    </div>
@stop