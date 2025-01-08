<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Sidang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            table-layout: auto; /* Allows dynamic wrapping */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            word-wrap: break-word;
            white-space: normal;
        }

        th {
            background-color: #f2f2f2;
        }

        .badge {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 10px;
            color: #fff;
            text-align: center;
        }

        .text-bg-warning {
            background-color: #ffc107;
        }

        .text-bg-success {
            background-color: #28a745;
        }

        .text-bg-danger {
            background-color: #dc3545;
        }

        .alert {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Jadwal Skripsi</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Tahun Ajaran</th>
                <th>Dosen Pembimbing 1</th>
                <th>Dosen Pembimbing 2</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Ruangan</th>
                <th>Link Daring</th>
                <th>Dosen Penguji 1</th>
                <th>Dosen Penguji 2</th>
                <th>Status Jadwal</th>
                <th>Status Sidang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nim }}</td>
                <td>{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->prodi }}</td>
                <td>{{ $d->berkasSkripsi->tahun_ajaran }}</td>
                <td>{{ $d->berkasSkripsi->pengajuanDospem->dospem1->nama_dosen }}</td>
                <td>{{ $d->berkasSkripsi->pengajuanDospem->dospem2->nama_dosen ?? '-' }}</td>
                <td>{{ $d->berkasSkripsi->pengajuanDospem->judul }}</td>
                <td>{{ formatTanggalIndo($d->jadwalSidang->plotJadwal->tanggal) }}</td>
                <td>{{ $d->jadwalSidang->plotJadwal->waktu }} WIB</td>
                <td>{{ $d->jadwalSidang->plotJadwal->ruangan->nama_ruangan }}</td>
                <td>{{ $d->jadwalSidang->plotJadwal->ruangan->link }}</td>
                <td>{{ $d->jadwalSidang->penguji1->nama_dosen }}</td>
                <td>{{ $d->jadwalSidang->penguji2->nama_dosen ?? '' }}</td>
                <td>
                    @if($d->jadwalSidang->status === 'Pending')
                    <span class="badge text-bg-warning">Pending</span>
                    @elseif ($d->jadwalSidang->status === 'Disetujui')
                    <span class="badge text-bg-success">Disetujui</span>
                    @elseif ($d->jadwalSidang->status === 'Ditolak')
                    <span class="badge text-bg-danger">Ditolak</span>
                    @endif
                </td>
                <td>
                    @if($d->jadwalSidang->done === 0)
                    <span class="badge text-bg-warning">Belum Sidang</span>
                    @elseif ($d->jadwalSidang->done === 1)
                    <span class="badge text-bg-success">Selesai</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
