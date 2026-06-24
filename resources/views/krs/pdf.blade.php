<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KRS - {{ $mahasiswa->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2, h4 { text-align: center; margin: 4px 0; }
        p { text-align: center; margin: 2px 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #222; color: #fff; padding: 8px; }
        td { padding: 7px 8px; border-bottom: 1px solid #ddd; }
        .total { text-align: right; font-weight: bold; margin-top: 10px; }
        .footer { margin-top: 40px; text-align: right; font-size: 11px; }
    </style>
</head>
<body>
    <h2>KARTU RENCANA STUDI (KRS)</h2>
    <h4>Sistem Informasi Akademik Sederhana</h4>
    <p>Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</p>

    <hr>

    <table>
        <tr>
            <td width="120"><strong>Nama</strong></td>
            <td>: {{ $mahasiswa->nama }}</td>
            <td width="120"><strong>NPM</strong></td>
            <td>: {{ $mahasiswa->npm }}</td>
        </tr>
        <tr>
            <td><strong>Dosen Wali</strong></td>
            <td>: {{ $mahasiswa->dosenWali->nama ?? '-' }}</td>
            <td><strong>Total SKS</strong></td>
            <td>: {{ $totalSks }} SKS</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($krs as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->kode_matakuliah }}</td>
                <td>{{ $item->mataKuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $item->mataKuliah->sks ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center; color:#888;">
                    Belum ada mata kuliah yang diambil.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <p class="total">Total SKS: {{ $totalSks }}</p>

    <div class="footer">
        Bandung, {{ now()->format('d F Y') }}<br><br><br>
        <strong>{{ $mahasiswa->nama }}</strong><br>
        NPM: {{ $mahasiswa->npm }}
    </div>
</body>
</html>