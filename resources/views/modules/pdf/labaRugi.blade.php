<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laba/Rugi (Standar)</title>
    <meta name="description"
          content="Neraca (Standar)">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <h4>PT Megatrend</h4>
                <h2 style="color: darkred"><b>Laba/Rugi (Standar)</b></h2>
                <h5>Per Tgl. </h5>
            </div>
            <br>
            <table class='table table-no-bordered border-top-after-blue'>
                <tr style="color: cornflowerblue; ">
                    <th>Deskripsi</th>
                    <th>Nilai</th>
                </tr>
                <tr>
                    <th>PENDAPATAN</th>
                    <td></td>
                </tr>
                @php($total_pendapatan = 0)
                @php($total_bpp = 0)
                @foreach($pendapatan->groupBy('type') as $types)
                    <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $types[0]->type }}</th>
                        <td></td>
                    </tr>
                        {{--@foreach($types as $item)--}}
                            {{--<tr>--}}
                                {{--<td style="border-top-width: 0px;">--}}
                                    {{--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</td>--}}
                                {{--<td style="border-top-width: 0px;">{{ $item->credit - $item->debit }}</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        <tr>
                            <th>Jumlah {{ $types[0]->type }}</th>
                            <th>{{ $types->sum('credit') - $types->sum('debit') }}</th>
                            @php($total_pendapatan += $types->sum('credit') - $types->sum('debit') )
                        </tr>
                @endforeach
                <tr>
                    <th style="border-top-width: 0px;">Jumlah Pendapatan</th>
                    <th>{{ $total_pendapatan }}</th>
                </tr>
                <tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">BEBAN POKOK PENJUALAN</th>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                @foreach($bpp as $item)
                        <tr>
                            <td style="border-top-width: 0px;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</td>
                            <td style="border-top-width: 0px;">{{ $item->credit - $item->debit }}</td>
                        </tr>
                        @php($total_bpp += $types->sum('credit') - $types->sum('debit') )
                    @endforeach
                <tr>
                    <th style="border-top-width: 0px;">Jumlah Beban Pokok Penjualan</th>
                    <th>{{ $total_bpp }}</th>
                </tr>
                <tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">LABA KOTOR</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">BEBAN OPERASIONAL</th>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                //
                <tr>
                    <th style="border-top-width: 0px;">Jumlah Beban Operasional</th>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">PENDAPATAN OPERASIONAL</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr><tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">PENDAPATAN DAN BEBAN NON OPERASIONAL</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;Pendapatan Non Operasional</th>
                    <th></th>
                </tr>
                //
                <tr>
                    <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Pendapatan Non Operasional</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;Beban Non Operasional</th>
                    <th></th>
                </tr>
                //
                <tr>
                    <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Beban Non Operasional</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">Jumlah Pendapatan dan Beban Operasional</th>
                    <th></th>
                </tr>
                <tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr><tr>
                    <td style="border-top-width: 0px;"></td>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">LABA BERSIH (Sebelum Pajak)</th>
                    <th></th>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">LABA BERSIH (Setelah Pajak)</th>
                    <th></th>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>