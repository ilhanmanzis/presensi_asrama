<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Presensi Jamaah Santriwati</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 16px;
        }

        .header p {
            margin: 2px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            font-size: 10px;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .nama-col {
            text-align: left;
            min-width: 120px;
        }

        .legend {
            margin-top: 10px;
            font-size: 10px;
        }

        .total-col {
            font-size: 9px;
            line-height: 1.3;
        }

        .total-col div {
            margin: 1px 0;
        }

        h3 {
            margin-top: 40px;
            margin-bottom: 10px;
        }

        hr {
            margin: 30px 0;
            border: none;
            border-top: 1px dashed #888;
        }

        @media print {
            body {
                margin: 10px;
            }

            table {
                font-size: 9px;
            }

            th,
            td {
                padding: 2px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Presensi Jamaah Santriwati</h2>
        <h2>MA Nurul Ummah</h2>
        <p>Periode: {{ $filters['tanggal_mulai'] }} s/d {{ $filters['tanggal_selesai'] }}</p>
    </div>

    @php
        $waktus = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
        $mapStatus = ['hadir' => 'H', 'sakit' => 'S', 'izin' => 'I', 'alpha' => 'A'];
    @endphp

    @foreach ($waktus as $waktu)
        <h3>Waktu: {{ ucfirst($waktu) }}</h3>

        @if (!empty($data[$waktu]) && count($data[$waktu]['dates'] ?? []) > 0)
            <table>
                <thead>
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">Nis</th>
                        <th rowspan="3">Nama</th>
                        <th colspan="{{ count($data[$waktu]['dates']) }}">
                            {{ \Carbon\Carbon::parse($data[$waktu]['dates'][0])->format('Y') }}
                        </th>
                        <th rowspan="2" colspan="4">Jumlah</th>
                    </tr>
                    <tr>
                        @php
                            $monthCounts = [];
                            foreach ($data[$waktu]['dates'] as $date) {
                                $month = $date->format('F');
                                if (!isset($monthCounts[$month])) {
                                    $monthCounts[$month] = 0;
                                }
                                $monthCounts[$month]++;
                            }
                        @endphp
                        @foreach ($monthCounts as $month => $count)
                            <th colspan="{{ $count }}">{{ $month }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($data[$waktu]['dates'] as $date)
                            <th>{{ $date->format('j') }}</th>
                        @endforeach
                        <th>H</th>
                        <th>S</th>
                        <th>I</th>
                        <th>A</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data[$waktu]['santriwatis'] as $index => $santriwati)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $santriwati['nis'] }}</td>
                            <td class="nama-col">{{ $santriwati['nama'] }}</td>
                            @foreach ($data[$waktu]['dates'] as $date)
                                @php
                                    $formattedDate = $date->format('Y-m-d');
                                    $status = $santriwati['presensi'][$formattedDate] ?? 'alpha';
                                @endphp
                                <td>{{ $mapStatus[$status] ?? 'A' }}</td>
                            @endforeach
                            <td>{{ $santriwati['hadir'] }}</td>
                            <td>{{ $santriwati['sakit'] }}</td>
                            <td>{{ $santriwati['izin'] }}</td>
                            <td>{{ $santriwati['alpha'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 10px;">
                <table style="width: 300px;">
                    <thead>
                        <tr>
                            <th colspan="4">Total</th>
                        </tr>
                        <tr>
                            <th>Hadir</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Alpha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data[$waktu]['total_hadir'] }}</td>
                            <td>{{ $data[$waktu]['total_sakit'] }}</td>
                            <td>{{ $data[$waktu]['total_izin'] }}</td>
                            <td>{{ $data[$waktu]['total_alpha'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p>Data tidak ada.</p>
        @endif

        <hr>
    @endforeach

    <div class="legend">
        <strong>Keterangan:</strong>
        H = Hadir, S = Sakit, I = Izin, A = Alpha
    </div>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Presensi Jamaah Santriwati</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 16px;
        }

        .header p {
            margin: 2px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            font-size: 10px;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .nama-col {
            text-align: left;
            min-width: 120px;
        }

        .legend {
            margin-top: 10px;
            font-size: 10px;
        }

        .total-col {
            font-size: 9px;
            line-height: 1.3;
        }

        .total-col div {
            margin: 1px 0;
        }

        h3 {
            margin-top: 40px;
            margin-bottom: 10px;
        }

        hr {
            margin: 30px 0;
            border: none;
            border-top: 1px dashed #888;
        }

        @media print {
            body {
                margin: 10px;
            }

            table {
                font-size: 9px;
            }

            th,
            td {
                padding: 2px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Presensi Jamaah Santriwati</h2>
        <h2>MA Nurul Ummah</h2>
        <p>Periode: {{ $filters['tanggal_mulai'] }} s/d {{ $filters['tanggal_selesai'] }}</p>
    </div>

    @php
        $waktus = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];
        $mapStatus = ['hadir' => 'H', 'sakit' => 'S', 'izin' => 'I', 'alpha' => 'A'];
    @endphp

    @foreach ($waktus as $waktu)
        <h3>Waktu: {{ ucfirst($waktu) }}</h3>

        @if (!empty($data[$waktu]) && count($data[$waktu]['dates'] ?? []) > 0)
            <table>
                <thead>
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">Nis</th>
                        <th rowspan="3">Nama</th>
                        <th colspan="{{ count($data[$waktu]['dates']) }}">
                            {{ \Carbon\Carbon::parse($data[$waktu]['dates'][0])->format('Y') }}
                        </th>
                        <th rowspan="2" colspan="4">Jumlah</th>
                    </tr>
                    <tr>
                        @php
                            $monthCounts = [];
                            foreach ($data[$waktu]['dates'] as $date) {
                                $month = $date->format('F');
                                if (!isset($monthCounts[$month])) {
                                    $monthCounts[$month] = 0;
                                }
                                $monthCounts[$month]++;
                            }
                        @endphp
                        @foreach ($monthCounts as $month => $count)
                            <th colspan="{{ $count }}">{{ $month }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($data[$waktu]['dates'] as $date)
                            <th>{{ $date->format('j') }}</th>
                        @endforeach
                        <th>H</th>
                        <th>S</th>
                        <th>I</th>
                        <th>A</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data[$waktu]['santriwatis'] as $index => $santriwati)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $santriwati['nis'] }}</td>
                            <td class="nama-col">{{ $santriwati['nama'] }}</td>
                            @foreach ($data[$waktu]['dates'] as $date)
                                @php
                                    $formattedDate = $date->format('Y-m-d');
                                    $status = $santriwati['presensi'][$formattedDate] ?? 'alpha';
                                @endphp
                                <td>{{ $mapStatus[$status] ?? 'A' }}</td>
                            @endforeach
                            <td>{{ $santriwati['hadir'] }}</td>
                            <td>{{ $santriwati['sakit'] }}</td>
                            <td>{{ $santriwati['izin'] }}</td>
                            <td>{{ $santriwati['alpha'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 10px;">
                <table style="width: 300px;">
                    <thead>
                        <tr>
                            <th colspan="4">Total</th>
                        </tr>
                        <tr>
                            <th>Hadir</th>
                            <th>Sakit</th>
                            <th>Izin</th>
                            <th>Alpha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $data[$waktu]['total_hadir'] }}</td>
                            <td>{{ $data[$waktu]['total_sakit'] }}</td>
                            <td>{{ $data[$waktu]['total_izin'] }}</td>
                            <td>{{ $data[$waktu]['total_alpha'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p>Data tidak ada.</p>
        @endif

        <hr>
    @endforeach

    <div class="legend">
        <strong>Keterangan:</strong>
        H = Hadir, S = Sakit, I = Izin, A = Alpha
    </div>
</body>

</html>
