@extends('layout.layout_dashboard')
@section('content')
    <style type="text/css">
        body {
            padding: 20px;
            margin: 0;
            font: 16px/22px "Source Sans Pro", Helvetica, sans-serif;
            font-size-adjust: none;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            background: #f4f6ec;
            color: #333;
        }
        .nav-category {
            color: #777;
            font-weight: normal;
            margin-bottom: 0.75em;
        }
        h1, h2, h3 {
            margin: 0;
            padding: 0;
        }

        .report-output {
            background: white;
            border: 1px solid #ccc;
            height: 400px;
        }

        .edit-link {
            font-size: 120%;
            margin-bottom: 10px;
        }

        code.hljs.javascript {
            border-radius: 5px;
            padding: 0.5em 0.85em;
        }
        pre {
            margin: 0;
        }

        .report-designer-container {
            height: 600px;
            border: 1px solid #aaa;
        }
    </style>
<div class="report-designer-container"></div>
<script src="{{ asset('lib/highlight.pack.js')}}" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-1.11.0.min.js" integrity="sha256-spTpc4lvj4dOkKjrGokIrHkJgNA0xMS98Pw9N7ir9oI=" crossorigin="anonymous"></script>
<script src="{{ asset('lib/jsreports/jsreports-all.min.js?1.4.106')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        // Set up variables that apply to all reports
        var data_sources = [{
            "id": "Laporan",
            "name": "Laporan",
            "url": "{{url('api/report/getAllData')}}",
            "schema_url": "{{url('api/report/getSchema')}}"
        },{"id": "Product",
            "name": "Product",
            "url": "{{asset('data/time-data.json')}}",
            "schema_url": "{{asset('data/time-data-schema.json')}}"}];
        jsreports.libraryPath = "{{ asset('lib/jsreports')}}";
        $.getJSON("{{url('api/report/getReport/1')}}", function(report_def) {
            var designer = new jsreports.Designer({
                embedded: true,
                container: $(".report-designer-container"),
                data_sources: data_sources,
                report_def: report_def,
                images: [{
                    name: "ACME logo",
                    url: "images/acme-logo.png"
                }]
            });
            designer.on("save", function(def) {
                $.post("{{url('api/report/updateReport/')}}",{id:1,json:def},function(data){
                    swal({
                            title: "Report",
                            text: data.msg,
                            type: data.type,
                            confirmButtonClass: 'btn btn-success'
                        }, (function () {
                            if (data.status = true) {
                                location.href = '{{url('jsDesign')}}'
                            }
                        })
                    )
                })
            });
        });

        // Sample code highlighting (not part of jsreports)
        hljs.initHighlightingOnLoad();
    });
</script>
@endsection
