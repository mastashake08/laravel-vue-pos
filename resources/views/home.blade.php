@extends('layouts.app')

@section('content')
<charge-component balance="{{$balance}}"></charge-component>
<invoice-component></invoice-component>
<customers-component></customers-component>
<plans-component></plans-component>
@endsection
