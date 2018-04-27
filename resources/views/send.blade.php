@extends('layouts.app')
@section('description')
Send money to {{$user->name}} from more than 140 accepted currencies! Sign up for
your Parker POS account TODAY!
@endsection
@section('content')
<send-pay-component user-object="{{$user}}"></send-pay-component>
@endsection
