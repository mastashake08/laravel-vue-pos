@extends('layouts.app')

@section('content')
<invoice-pay-component invoice-object="{{$invoice}}"></invoice-pay-component>
@endsection
