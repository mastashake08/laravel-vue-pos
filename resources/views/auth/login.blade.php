@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    	<a href="{{url('/login/stripe')}}"><img src="{{url('/images/blue-on-light.png')}}"></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
