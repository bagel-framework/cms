<div class="col-lg-12">
    @if(Session::has('errors'))
        <div class="alert alert-danger">
            <button class="close" data-dismiss="alert" type="button"><i class="icon-remove"></i></button>
            <i class="icon-ban-circle icon-large"></i>
            <ul>
        @foreach(Session::get('errors') as $error)
            <li>{{$error}}</li>
        @endforeach
            </ul>
        </div>
    @endif
    @if(Session::has('messages'))
        <div class="alert alert-success">
            <button class="close" data-dismiss="alert" type="button"><i class="icon-remove"></i></button>
            <i class="icon-ban-circle icon-large"></i>
            <ul>
        @foreach(Session::get('messages') as $message)
            <li>{{$message}}</li>
        @endforeach
            </ul>
        </div>
    @endif
</div>