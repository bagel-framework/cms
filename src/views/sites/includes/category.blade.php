<tr>
    <td><i class="icon-book"></i></td>
    <td>{{$site->id}}</td>
    <td>
        <a href="{{action('Bagel\Cms\Controllers\SiteController@category', array('site' => $site->id))}}">{{$site->name}}</a>
    </td>
    <td>{{$site->slug}}</td>
    <td></td>
    <td>
        {{HTML::buildSiteStatusLink($site->id, $site->is_online, $site->type)}}
    </td>
    <td>
        {{HTML::buildSiteVisibilityLink($site->id, $site->is_visible, $site->type)}}
    </td>
    <td class="text-center">
        <a class="icon-pencil" href="{{action('Bagel\Cms\Controllers\SiteController@edit', array('site' => $site->id))}}"></a>
        <a class="icon-chevron-down" href="{{action('Bagel\Cms\Controllers\SiteController@move', array('site' => $site->id))}}?direction=down"></a>
        <a class="icon-chevron-up" href="{{action('Bagel\Cms\Controllers\SiteController@move', array('site' => $site->id))}}?direction=up"></a>
        <div class="btn-group">
            <a class="dropdown-toggle icon-trash" data-toggle="dropdown" href="#"></a>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="{{action('Bagel\Cms\Controllers\SiteController@delete', array('site' => $site->id))}}"><i class="icon-warning-sign"></i> löschen bestätigen</a>
                </li>
            </ul>
        </div>
    </td>
</tr>