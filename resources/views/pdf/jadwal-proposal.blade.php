<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Proposal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            max-width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            table-layout: fixed; /* Ensure the table does not exceed its container */
            word-wrap: break-word; /* Handle long text */
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            overflow: hidden; /* Prevent overflow of content */
            text-overflow: ellipsis; /* Add ellipsis for overflow text */
            white-space: normal; /* Allow wrapping for long text */
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
            word-wrap: normal; /* Ensure badges are not affected by wrapping */
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

        h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Jadwal Proposal</h1>

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
                <td>{{ $d->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $d->berkasProposal->pengajuanDospem->mahasiswa->nim }}</td>
                <td>{{ $d->berkasProposal->pengajuanDospem->mahasiswa->prodi }}</td>
                <td>{{ $d->berkasProposal->tahun_ajaran }}</td>
                <td>{{ $d->berkasProposal->pengajuanDospem->dospem1->nama_dosen }}</td>
                <td>{{ $d->berkasProposal->pengajuanDospem->dospem2->nama_dosen ?? '-' }}</td>
                <td>{{ $d->berkasProposal->pengajuanDospem->judul }}</td>
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
