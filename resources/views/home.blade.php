@extends('layouts.app')

@section('content')
<charge-component balance="${{$balance->available[0]['amount']/100}}"></charge-component>
<invoice-component></invoice-component>
<customers-component></customers-component>
<plans-component></plans-component>
@endsection
