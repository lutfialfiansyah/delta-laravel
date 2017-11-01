<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Neraca (Standar)</title>
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
                <h2 style="color: darkred"><b>Naraca (Standar)</b></h2>
                <h5>Per Tgl. {{ Carbon\Carbon::now()->format('d M Y') }}</h5>
            </div>
            <br>
            <table class='table table-no-bordered border-top-after-blue'>
                <tr style="color: cornflowerblue; ">
                    <th>Deskripsi</th>
                    <th>Nilai</th>
                </tr>
                <tr>
                    <th>ASET</th>
                    <td></td>
                </tr>
                <tr>
                    <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;ASET LANCAR</th>
                    <td style="border-top-width: 0px;"></td>
                </tr>
                @php($total_aset_lancar = 0)
                    @php($total_aset_tidak_lancar = 0)
                        @foreach($aset_lancar->groupBy('type') as $types)
                            <tr>
                                <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $types[0]->type }}</th>
                                <td style="border-top-width: 0px;"></td>
                            </tr>
                            @foreach($types as $item)
                                <tr>
                                    <td style="border-top-width: 0px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</td>
                                    <td style="border-top-width: 0px;">{{ $item->credit - $item->debit }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th style="border-top-width: 0px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah {{ $types[0]->type }} </th>
                                    <th>{{ $types->sum('credit') - $types->sum('debit') }}</th>
                                    @php($total_aset_lancar += $types->sum('credit') - $types->sum('debit') )
                                </tr>
                            @endforeach
                            <tr>
                                <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Aset Lancar</th>
                                <td>{{$total_aset_lancar}}</td>
                            </tr>

                            <tr>
                                <td style="border-top-width: 0px;"></td>
                                <td style="border-top-width: 0px;"></td>
                            </tr>

                            <tr>
                                <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;ASET TIDAK LANCAR</th>
                                <td style="border-top-width: 0px;"></td>
                            </tr>
                            @foreach($aset_tidak_lancar->groupBy("type") as $types)
                                <tr>
                                    <th style="border-top-width: 0px;">{{ $types[0]->type }}</th>
                                    <td style="border-top-width: 0px;"></td>
                                </tr>
                                @foreach($types as $item)
                                    <tr style="border-top-width: 0px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</td>
                                        <td  style="border-top-width: 0px;">{{ $item->credit - $item->debit }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th style="border-top-width: 0px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah {{ $types[0]->type }} </th>
                                    <th>{{ $types->sum('credit') - $types->sum('debit') }}</th>
                                    @php($total_aset_tidak_lancar += $types->sum('credit') - $types->sum('debit') )
                                </tr>
                            @endforeach
                            <tr>
                                <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Aset Tidak Lancar</th>
                                <th>{{$total_aset_tidak_lancar}}</th>
                            </tr>
                    <tr>
                        <th style="border-top-width: 0px;">JUMLAH ASET</th>
                        <th>{{ $total_aset_lancar + $total_aset_tidak_lancar }}</th>
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
                        <th style="border-top-width: 0px;">KEWAJIBAN DAN EKUITAS</th>
                        <td style="border-top-width: 0px;"></td>
                    </tr>
                    <tr>
                        <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;KEWAJIBAN</th>
                        <td style="border-top-width: 0px;"></td>
                    </tr>
                    @php($total_kewajiban = 0)
                    @php($total_ekuitas = 0)
                    @foreach($kewajiban->groupBy('type') as $types)
                         <tr>
                             <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $types[0]->type }}</th>
                             <td style="border-top-width: 0px;"></td>
                         </tr>
                         @foreach($types as $item)
                              <tr>
                                  <td style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</td>
                                  <td  style="border-top-width: 0px;">{{ $item->credit - $item->debit }}</td>
                              </tr>
                         @endforeach
                         <tr>
                             <th style="border-top-width: 0px;">
                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah {{ $types[0]->type }} </th>
                                 <th>{{ $types->sum('credit') - $types->sum('debit') }}</th>
                                 @php($total_kewajiban += $types->sum('credit') - $types->sum('debit') )
                         </tr>
                    @endforeach
                    <tr>
                        <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Kewajiban</th>
                        <th>{{$total_kewajiban}}</th>
                    </tr>
                    <tr>
                        <td style="border-top-width: 0px;"></td>
                        <td style="border-top-width: 0px;"></td>
                    </tr>

                    <tr>
                        <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;EKUITAS</th>
                        <td style="border-top-width: 0px;"></td>
                    </tr>
                    @foreach($ekuitas->groupBy('type') as $types)
                         <tr>
                             <th  style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $types[0]->type }}</th>
                             <td style="border-top-width: 0px;"></td>
                         </tr>
                            @foreach($types as $item)
                                <tr>
                                    <td style="border-top-width: 0px;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $item->name }}</td>
                                    <td  style="border-top-width: 0px;">{{ $item->credit - $item->debit }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th style="border-top-width: 0px;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah {{ $types[0]->type }} </th>
                                <th>{{ $types->sum('credit') - $types->sum('debit') }}</th>
                                @php($total_ekuitas += $types->sum('credit') - $types->sum('debit') )
                            </tr>
                        @endforeach
                        <tr>
                            <th style="border-top-width: 0px;">&nbsp;&nbsp;&nbsp;&nbsp;Jumlah Ekuitas</th>
                            <th>{{$total_ekuitas}}</th>
                        </tr>
                        <tr>
                            <th style="border-top-width: 0px;">JUMLAH KEWAJIBAN DAN EKUITAS</th>
                            <th>{{ $total_kewajiban + $total_ekuitas }}</th>
                        </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>