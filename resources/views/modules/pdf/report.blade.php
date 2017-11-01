@extends('layout.layout_dashboard')
@section('content')
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title"> Report
        {{--<small>statistics, charts, recent events and reports</small>--}}
    </h1>
    <!-- END PAGE TITLE-->
    <ul>
        <li><a href="{{ route('neraca') }}">Neraca</a></li>
        <li>Laba / Rugi</li>
        <form action="{{ route('labaRugi','date') }}">
                <input type="text" readonly="readonly" name="date" id="datepicker" >
            <button type="submit">Laba Rugi</button>
        </form>
    </ul>


    <script>
        $("#datepicker").datepicker(
            {
                format: "yyyy-m",
                startView: "months",
                minViewMode: "months"
            });
    </script>

@endsection