<!DOCTYPE html>
<html>

<head>
    <title>Hasil Proposal {{$d->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .bold {
            font-weight: bold;
        }

        .rekap-table {
            margin-top: 20px;
        }

        .rekapitulasi-title {
            margin-top: 20px;
            font-weight: bold;
        }

        .page {
            height: 100%;
            margin: 0 auto;
            padding: 10mm;
        }

        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }

            body {
                margin: 0;
                padding: 5px;
            }

            .page {
                padding: 0;
            }
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="page">
        <div class="container">
            <!-- Mahasiswa Information -->
            <table>
                <tr>
                    <td class="bold">Nama Mahasiswa</td>
                    <td>:</td>
                    <td>{{$d->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa}}</td>
                </tr>
                <tr>
                    <td class="bold">NIM</td>
                    <td>:</td>
                    <td>{{$d->berkasProposal->pengajuanDospem->mahasiswa->nim}}</td>
                </tr>
                <tr>
                    <td class="bold">Prodi</td>
                    <td>:</td>
                    <td>{{ $d->berkasProposal->pengajuanDospem->mahasiswa->prodi }}</td>
                </tr>
            </table>

            <hr />

            @php

            $sorted = collect([]);

            foreach($d->hasilProposal as $p){
            if($p->dosen->id == $d->jadwalSidang->id_penguji_1){
            $sorted[0] = $p;
            }elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2){
            $sorted[1] = $p;
            }elseif($p->dosen->id == $d->jadwalSidang->id_pembimbing){
            $sorted[2] = $p;
            }
            }

            $sorted = $sorted->sortKeys();
            @endphp

            @foreach($sorted as $p)
            <!-- Dosen and Status -->
            <table>
                <tr>
                    <td class="bold">Nama Dosen</td>
                    <td>:</td>
                    <td>{{$p->dosen->nama_dosen}}</td>
                </tr>
                <tr>
                    <td class="bold">Status</td>
                    <td>:</td>
                    <td>
                        @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                        Pembimbing
                        @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                        Penguji 1
                        @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                        Penguji 2
                        @endif
                    </td>
                </tr>
            </table>

            <!-- Penilaian -->
            <table>
                <thead>
                    <tr>
                        <th>Variabel Penilaian</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>I. Kesesuaian Judul Dengan Isi</td>
                        <td>{{ $p->kesesuaian }}</td>
                    </tr>
                    <tr>
                        <td>II. Kedalaman dan Keluasan Materi Sesuai Level Tugas Akhir</td>
                        <td>{{ $p->kedalaman }}</td>
                    </tr>
                    <tr>
                        <td>III. Rumusan Masalah Didefinisikan Dengan Jelas</td>
                        <td>{{ $p->rumusan }}</td>
                    </tr>
                    <tr>
                        <td>IV. Penguasaan Terhadap Studi Terkait Dan Teori Pendukung</td>
                        <td>{{ $p->penguasaan }}</td>
                    </tr>
                    <tr>
                        <td>V. Kesesuaian Metode Yang Digunakan Untuk Menyelesaikan Masalah</td>
                        <td>{{ $p->metode }}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>Saran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$p->saran ?? 'Tidak Ada'}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="page-break"></div>
            @endforeach

            <!-- Rekapitulasi -->
            <p class="rekapitulasi-title">Rekapitulasi Nilai</p>
            <table class="rekap-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penguji</th>
                        <th>Jabatan Penguji</th>
                        <th>Nilai (N)</th>
                        <th>Bobot (B)</th>
                        <th>Nilai Akhir (N x B)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sorted as $p)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$p->dosen->nama_dosen}}</td>
                        <td>
                            @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                            Pembimbing
                            @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                            Penguji 1
                            @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                            Penguji 2
                            @endif
                        </td>
                        <td>{{ $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode }}</td>
                        <td>
                            @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                            50%
                            @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                            25%
                            @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                            25%
                            @endif
                        </td>
                        <td>
                            @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                            {{ ($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode) * 0.5 }}
                            @else
                            {{ ($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode) * 0.25 }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="bold">Jumlah :</td>
                        <td class="bold">
                            @php
                            $total = 0;
                            foreach($d->hasilProposal as $p){
                            if($p->dosen->id == $d->jadwalSidang->id_pembimbing){
                            $total += ($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode) * 0.5;
                            }else{
                            $total += ($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode) * 0.25;
                            }
                            }
                            echo $total;
                            @endphp
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>