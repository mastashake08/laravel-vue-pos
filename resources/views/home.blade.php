@extends('layouts.app')

@section('content')
<h2>Balance: ${{$balance->available['amount']/100}}</h2>
<charge-component></charge-component>
<invoice-component></invoice-component>
<customers-component></customers-component>
<plans-component></plans-component>
@endsection
