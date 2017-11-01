@extends('layout.layout_dashboard')
@section('content')
    <style type="text/css">

        .report-output {
            background: white;
            border: 1px solid #ccc;
            height: 700px;
        }
    </style>
    <div class="report-output"></div>
    <script src="{{ asset('lib/highlight.pack.js')}}" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.11.0.min.js" integrity="sha256-spTpc4lvj4dOkKjrGokIrHkJgNA0xMS98Pw9N7ir9oI=" crossorigin="anonymous"></script>
    <script src="{{ asset('lib/jsreports/jsreports-all.min.js?1.4.106')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

            // Set up variables that apply to all reports
            var report_instance,
                data_sources = [{
                "id": "Laporan",
                "name": "Laporan",
                "url": "{{url('api/report/getAllData')}}",
                "schema_url": "{{url('api/report/getSchema')}}"
            }];
            jsreports.libraryPath = "{{ asset('lib/jsreports')}}";
            $.getJSON("{{url('api/report/getReport/1')}}", function(report_def) {
                report_instance = jsreports.render({
                    report_def: report_def,
                    target: $(".report-output"),
                    datasets: data_sources
                });
            });
            // Sample code highlighting (not part of jsreports)
            hljs.initHighlightingOnLoad();
        });
    </script>
@endsection
