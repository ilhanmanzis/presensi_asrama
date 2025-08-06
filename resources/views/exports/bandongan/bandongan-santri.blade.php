@if (empty($data['santris']) || count($data['santris']) === 0)
    <div class="header">
        <h2>Laporan Presensi Bandongan Santri</h2>
        <h2>MA Nurul Ummah</h2>
        <p>Periode: {{ $data['periode'] ?? '-' }}</p>
        <h3>Data tidak ada</h3>
    </div>
@else
    <div class="header">
        <h2>Laporan Presensi Bandongan Santri</h2>
        <h2>MA Nurul Ummah</h2>
        <p>Periode: {{ $data['periode'] }}</p>
    </div>

    <tr></tr>
    <table class="bordered-table">
        <thead>
            <tr>
                <th valign="center" align="center"><strong>No</strong></th>
                <th valign="center" align="center"><strong>NIS</strong></th>
                <th valign="center" align="center"><strong>Nama</strong></th>
                <th valign="center" align="center"><strong>H</strong></th>
                <th valign="center" align="center"><strong>S</strong></th>
                <th valign="center" align="center"><strong>I</strong></th>
                <th valign="center" align="center"><strong>A</strong></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data['santris'] as $index => $santri)
                <tr>
                    <td valign="center" align="center">{{ $index + 1 }}</td>
                    <td valign="center" align="left">{{ $santri['nis'] }}</td>
                    <td valign="center" align="left">{{ $santri['nama'] }}</td>
                    <td valign="center" align="center">{{ $santri['hadir'] }}</td>
                    <td valign="center" align="center">{{ $santri['sakit'] }}</td>
                    <td valign="center" align="center">{{ $santri['izin'] }}</td>
                    <td valign="center" align="center">{{ $santri['alpha'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <table style="width: 300px;">
        <thead>
            <tr>
                <th valign="center" align="center" colspan="4"><strong>Total</strong></th>
            </tr>
            <tr>
                <th valign="center" align="center"><strong>Hadir</strong></th>
                <th valign="center" align="center"><strong>Sakit</strong></th>
                <th valign="center" align="center"><strong>Izin</strong></th>
                <th valign="center" align="center"><strong>Alpha</strong></th>
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

    <br>

    <table>
        <tr>
            <td colspan="4"><strong>Keterangan:</strong></td>
        </tr>
        <tr>
            <td colspan="4">H = Hadir, S = Sakit, I = Izin, A = Alpha</td>
        </tr>
    </table>
@endif
