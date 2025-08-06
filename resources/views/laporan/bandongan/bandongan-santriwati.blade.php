<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Presensi Bandongan Santriwati</title>
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
        <h2>Laporan Presensi Bandongan Santriwati</h2>
        <h2>MA Nurul Ummah</h2>
        <p>Periode: {{ $data['periode'] ?? '-' }}</p>
    </div>

    @if (empty($data['santriwatis']) || count($data['santriwatis']) === 0)
        <p>Data tidak tersedia.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Hadir</th>
                    <th>Sakit</th>
                    <th>Izin</th>
                    <th>Alpha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['santriwatis'] as $index => $santriwati)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $santriwati['nis'] }}</td>
                        <td class="nama-col">{{ $santriwati['nama'] }}</td>
                        <td>{{ $santriwati['hadir'] }}</td>
                        <td>{{ $santriwati['sakit'] }}</td>
                        <td>{{ $santriwati['izin'] }}</td>
                        <td>{{ $santriwati['alpha'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
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
                        <td>{{ $data['total_hadir'] }}</td>
                        <td>{{ $data['total_sakit'] }}</td>
                        <td>{{ $data['total_izin'] }}</td>
                        <td>{{ $data['total_alpha'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="legend">
            <strong>Keterangan:</strong>
            H = Hadir, S = Sakit, I = Izin, A = Alpha
        </div>
    @endif

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
