<div class="col-lg-12">
	<div class="breadcrumb_wrapper">
		<ul class="breadcrumb">
            <li><a href="">Dummy</a></li>
            <li><a href="">Dummy</a></li>
            <li><a href="">Dummy</a></li>
		</ul>
		{{--<div class="btn-group">--}}
			{{--@if(count($languages) > 1)--}}
				{{--@foreach($languages as $key => $language)--}}
					{{--<label class="btn btn-sm btn-white {{ Bagel::language()->getCurrentId() == $language->id ? 'active' : '' }}">--}}
						{{--<a href="{{action('Bagel\Core\Controllers\LanguageController@setActive', array('language' => $language->id))}}">{{$language->name}}</a>--}}
					{{--</label>--}}
				{{--@endforeach--}}
			{{--@endif--}}
		{{--</div>--}}
	</div>
</div>
