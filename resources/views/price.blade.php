@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Parker POS Pricing</div>

                <div class="panel-body">
                  <h2>Cloud Version</h2>
                  Parker POS is free to sign up and use. There is an application fee of 0.5% of every successful charge and 1% for every successful subscription. All application fees go
                  towards maintenance of the server.

                  <h2>Self Hosted Version</h2>
                  Parker POS is an open source application feel free to download and host your own version by cloning the repository <a href="https://github.com/mastashake08/laravel-vue-pos">here</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
