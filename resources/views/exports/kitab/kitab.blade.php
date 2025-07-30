@if (empty($data['dates']) || count($data['dates']) === 0)
    <div class="header">
        <h2>Laporan Presensi Sorogan Kitab {{ $data['title'] }}</h2>
        <h2>MA Nurul Ummah</h2>
        <p>Periode: {{ $data['periode'] ?? '-' }}</p>
        <h3>Data tidak ada</h3>
    </div>
@else
    <div class="header">
        <h2>Laporan Presensi Sorogan Kitab {{ $data['title'] }}</h2>
        <h2>MA Nurul Ummah</h2>
        <p>Periode: {{ $data['periode'] }}</p>
    </div>
    <h2>Kelompok : {{ $data['name'] }}</h2>

    <table class="bordered-table">

        <thead>
            <tr>
                <th valign="center" align="center" rowspan="3"><strong>No</strong></th>
                <th width="20" valign="center" align="center" rowspan="3"><strong>Nis </strong></th>
                <th width="35" valign="center" align="center" rowspan="3"><strong>Nama </strong></th>
                <th valign="center" align="center" colspan="{{ count($data['dates']) }}"><strong>
                        {{ \Carbon\Carbon::parse($data['dates'][0])->format('Y') }}
                    </strong>
                </th>
                <th valign="center" align="center" rowspan="2" colspan="4"><strong>Jumlah </strong></th>

            </tr>
            <tr>
                @php
                    $monthCounts = [];
                    foreach ($data['dates'] as $date) {
                        $month = $date->format('F');
                        if (!isset($monthCounts[$month])) {
                            $monthCounts[$month] = 0;
                        }
                        $monthCounts[$month]++;
                    }
                @endphp

                @foreach ($monthCounts as $month => $count)
                    <th valign="center" align="center" colspan="{{ $count }}"><strong>{{ $month }}
                        </strong></th>
                @endforeach

            </tr>
            <tr>
                @foreach ($data['dates'] as $date)
                    <th valign="center" align="center"><strong>{{ $date->format('j') }} </strong></th>
                @endforeach
                <th valign="center" align="center"><strong>H </strong></th>
                <th valign="center" align="center"><strong>S </strong></th>
                <th valign="center" align="center"><strong>I </strong></th>
                <th valign="center" align="center"><strong>A </strong></th>
            </tr>
        </thead>
        <tbody>
            @if (empty($data['santris']))
                @foreach ($data['santriwatis'] as $index => $santriwati)
                    <tr>
                        <td valign="center" align="center">{{ $index + 1 }}</td>
                        <td valign="center" align="left">{{ $santriwati['nis'] }}</td>
                        <td valign="center" align="left" class="nama-col">{{ $santriwati['nama'] }}</td>
                        @php
                            $mapStatus = [
                                'hadir' => 'H',
                                'sakit' => 'S',
                                'izin' => 'I',
                                'alpha' => 'A',
                            ];
                        @endphp

                        @foreach ($data['dates'] as $date)
                            @php
                                $formattedDate = $date->format('Y-m-d');
                                $status = $santriwati['presensi'][$formattedDate] ?? 'alpha';
                            @endphp
                            <td valign="center" align="center">{{ $mapStatus[$status] ?? 'A' }}</td>
                        @endforeach
                        <td valign="center" align="center" class="total-col">
                            <div>{{ $santriwati['hadir'] }}</div>
                        </td>
                        <td valign="center" align="center">
                            <div>{{ $santriwati['sakit'] }}</div>
                        </td>
                        <td valign="center" align="center">

                            <div>{{ $santriwati['izin'] }}</div>
                        </td>
                        <td valign="center" align="center">
                            <div>{{ $santriwati['alpha'] }}</div>

                        </td>
                    </tr>
                @endforeach
            @else
                @foreach ($data['santris'] as $index => $santri)
                    <tr>
                        <td valign="center" align="center">{{ $index + 1 }}</td>
                        <td valign="center" align="left">{{ $santri['nis'] }}</td>
                        <td valign="center" align="left" class="nama-col">{{ $santri['nama'] }}</td>
                        @php
                            $mapStatus = [
                                'hadir' => 'H',
                                'sakit' => 'S',
                                'izin' => 'I',
                                'alpha' => 'A',
                            ];
                        @endphp

                        @foreach ($data['dates'] as $date)
                            @php
                                $formattedDate = $date->format('Y-m-d');
                                $status = $santri['presensi'][$formattedDate] ?? 'alpha';
                            @endphp
                            <td valign="center" align="center">{{ $mapStatus[$status] ?? 'A' }}</td>
                        @endforeach
                        <td valign="center" align="center" class="total-col">
                            <div>{{ $santri['hadir'] }}</div>
                        </td>
                        <td valign="center" align="center">
                            <div>{{ $santri['sakit'] }}</div>
                        </td>
                        <td valign="center" align="center">

                            <div>{{ $santri['izin'] }}</div>
                        </td>
                        <td valign="center" align="center">
                            <div>{{ $santri['alpha'] }}</div>

                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <table style="width: 300px;">
            <thead>
                <tr>
                    <th valign="center" align="center" colspan="4"><strong>Total </strong></th>
                </tr>
                <tr>
                    <th valign="center" align="center"><strong>Hadir </strong></th>
                    <th valign="center" align="center"><strong>Sakit </strong></th>
                    <th valign="center" align="center"><strong>Izin </strong></th>
                    <th valign="center" align="center"><strong>Alpha </strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td valign="center" align="center">{{ $data['total_hadir'] }}</td>
                    <td valign="center" align="center">{{ $data['total_sakit'] }}</td>
                    <td valign="center" align="center">{{ $data['total_izin'] }}</td>
                    <td valign="center" align="center">{{ $data['total_alpha'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <table>
        <tr>
            <td colspan="4">
                <strong>Keterangan:</strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                H = Hadir, S = Sakit, I = Izin, A = Alpha
            </td>
        </tr>
    </table>


@endif
