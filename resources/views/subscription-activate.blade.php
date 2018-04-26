@extends('layouts.app')

@section('content')
<subscription-pay-component customer="{{$customer_id}}" plan="{{$plan_id}}" amount="{{$amount}}"></subscription-pay-component>
@endsection
