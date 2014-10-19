<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>
        @section('metatitle')
            Bagel -
        @show
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <link href="{{asset('packages/bagel/cms/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('packages/bagel/cms/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('packages/bagel/cms/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('packages/bagel/cms/js/select2/select2.css')}}">
    <link rel="stylesheet" href="{{asset('packages/bagel/cms/css/plugin.css')}}">
    <link rel="stylesheet" href="{{asset('packages/bagel/cms/css/butter.css')}}">

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <!--[if lt IE 9]>
        <script src="js/ie/respond.min.js"></script>
        <script src="js/ie/html5.js"></script>
    <![endif]-->
</head>

<body>

    <header class="navbar" id="header">
        <ul class="nav navbar-nav navbar-avatar pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="">User</span><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="">Logout</a></li>
                </ul>
            </li>
        </ul>
        <a class="navbar-brand" href=""><img src="{{asset('packages/bagel/cms/images/bagel-logo.png')}}"></a>
        <button type="button" class="btn btn-link pull-left nav-toggle visible-xs" data-toggle="class:slide-nav slide-nav-left" data-target="body">
            <i class="icon-reorder icon-xlarge text-default"></i>
        </button>
    </header>

    <nav class="nav-primary hidden-xs" id="nav">
        <ul class="nav" data-offset-top="50" data-spy="affix">
            <li class=""><a href=""><span>Dummy</span></a></li>
        </ul>
    </nav>

    <section id="content">
        <section class="main padder">
            @yield('content')
        </section>
    </section>

    <script type="text/javascript">

        $('.action-update').on('click', {action: 'update'}, changeActionUrl);
        $('.action-save').on('click', {action: 'save'}, changeActionUrl);

    	function changeActionUrl(e) {
    		// get the form which belongs to this button
    		var form = $(this).parents('form:first'),
    			action_url = form.attr('action');

    		// add the store action (save or update) to the form action url
    		form.attr('action', action_url + '?store_action=' + e.data.action);
    	}

    </script>

</body>
</html>