@extends('layout.layout_dashboard')
@section('content')
    {{--<a href="{{route('jsReportInvoicexls')}}">IMPORT XLS</a>--}}
    <iframe width="100%" height="600px" frameborder="none" src="{{url('jsReportView/'.$id)}}" allowfullscreen> </iframe>
@endsection