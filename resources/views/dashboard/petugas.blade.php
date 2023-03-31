<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/css/data.css')}}" rel="stylesheet">
    <title>Dashboard Admin</title>
</head>
<body>

     <div class="halaman">
    <p style="text-align:center; font-weight: bold; font-size:25px;">Laporan Keluhan</p>
</div>
<div class="menu" style="text-align:center">
                    <a href="{{route('index')}}">Home</a> |
                    <a href="{{route('logout')}}">Log-Out</a>
            </div>
            <div style="display: flex; justify-content: flex-end; align-items: center;">
        <form action="" method="GET">
            @csrf
            {{--menggunakan method GET karna route unutk masuk ke halaman data ini menggunakan ::get--}}
            <input type="text" name="search" placeholder="Cari berdasarkan nama...">
            <button type="submit" class="btn-login" style="margin-top: -1px;border-radius:70px; background-color:orange; color: black; width:80px;height:20px;">Cari</button>
        </form>
        {{-- refresh balik lagi ke route data karna nanti pas di kluk refresh mau bersihin riwayat pencarian 
             sebelumnya dan balikin lagi nya ke halaman data lagi--}}
        <a href="{{route('data')}}" style="margin-left: 10px; margin-top: -2px">Refresh</a>
        <a href="/exportpdf" style="margin-left: 10px; margin-top:-2px;">Cetak PDF</a>

    </div>
    </div>
    <div style="padding: 0 30px">
    <table class="styled-table">
    <thead>
        <tr>
             <th>No</th>
            <th>NIK</th>
            <th>Name</th>
            <th>Telp</th>
            <th>Pengaduan</th>
            <th>foto</th>
            <th>Status Response</th>
            <th>Pesan Response</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @php
            $no = 1;
        @endphp
        @foreach ($reports as $item)
        <tr>
             <td>{{ $no++ }}</td>
            <td>{{ $item['nik'] }}</td>
            <td>{{$item['nama']}}</td>
            <td>{{$item['no_tlp']}}</td>
            <td>{{$item['pengaduan']}}</td>
            <td>
            <a href="../assets/image/{{$item->foto}}"
                target="_blank">
                <img src="{{asset('assets/image/' . $item->foto)}}" style="height:100px; width:200px"></td>
                <td>
                @if ($item->response)
                {{$item->response['status']}}
                @else
                -
                @endif
        </td>
        <td>
        @if ($item->response)
                {{$item->response['pesan']}}
                @else
                -
                @endif
        </td>

                <td style="">
                <a href="{{route('response.edit', $item->id)}}">Send Response</a>
            </td>
        </tr>
        @endforeach
        <!-- and so on... -->
    </tbody>
</table>
</body>
</html>

