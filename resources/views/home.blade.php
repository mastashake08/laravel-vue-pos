@extends('layouts.app')

@section('content')
<charge-component balance="{{$balance}}" pending="{{$pending}}"></charge-component>
<invoice-component></invoice-component>
<customers-component></customers-component>
<plans-component></plans-component>
@endsection
