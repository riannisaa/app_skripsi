<!DOCTYPE html>
<html>

<head>
    <title>Hasil Skripsi {{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa }}</title>
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
    <div class="mb-3">
        <table class="table border">
            <tbody>
                <tr>
                    <td><b>Nama Mahasiswa</b></td>
                    <td><b>:</b></td>
                    <td><b>{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa }}</b></td>
                </tr>
                <tr>
                    <td><b>NIM</b></td>
                    <td><b>:</b></td>
                    <td><b>{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nim }}</b></td>
                </tr>
                <tr>
                    <td><b>Prodi</b></td>
                    <td><b>:</b></td>
                    <td><b>{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->prodi }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>


    <hr />

    @php
    $sortedPenguji = collect([]);

    foreach($d->hasilSkripsiPenguji as $p){
    if($p->dosen->id == $d->jadwalSidang->id_penguji_1){
    $sortedPenguji[0] = $p;
    }elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2){
    $sortedPenguji[1] = $p;
    }
    }

    $sortedPenguji = $sortedPenguji->sortKeys();
    @endphp

    @foreach($sortedPenguji as $p)
    <div class="mb-3">
        <table class="table border">
            <tbody>
                <tr>
                    <td><b>Nama Dosen</b></td>
                    <td><b>:</b></td>
                    <td><b>{{ $p->dosen->nama_dosen }}</b></td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td><b>:</b></td>
                    <td>
                        <b>
                            @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                            Pembimbing
                            @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                            Penguji 1
                            @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                            Penguji 2
                            @endif
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table border">
            <thead>
                <tr>
                    <th>Variabel Penilaian</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>I. Penggunaan sarana & efisiensi alokasi waktu yang digunakan</td>
                    <td>{{ $p->sarana }}</td>
                </tr>
                <tr>
                    <td>II. Tingkat kemampuan menjelaskan</td>
                    <td>{{ $p->menjelaskan }}</td>
                </tr>
                <tr>
                    <td>III. Penggunaan standarisasi format penulisan sesuai panduan</td>
                    <td>{{ $p->standarisasi }}</td>
                </tr>
                <tr>
                    <td>IV. Keutuhan dan kelengkapan</td>
                    <td>{{ $p->keutuhan }}</td>
                </tr>
                <tr>
                    <td>V. Kerapihan</td>
                    <td>{{ $p->kerapihan }}</td>
                </tr>
                <tr>
                    <td>VI. Tingkat pemahaman terhadap pokok permasalahan</td>
                    <td>{{ $p->pemahaman }}</td>
                </tr>
                <tr>
                    <td>VII. Tingkat pendekatan penyelesaian masalah</td>
                    <td>{{ $p->pendekatan }}</td>
                </tr>
                <tr>
                    <td>VIII. Kemampuan menjelaskan/menjawab pertanyaan dengan benar sesuai prinsip</td>
                    <td>{{ $p->menjawab }}</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Pertanyaan Pokok</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$p->pertanyaan_pokok ?? 'Tidak Ada'}}</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Kesimpulan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$p->kesimpulan ?? 'Tidak Ada'}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>
    @endforeach

    @foreach($d->hasilSkripsiPembimbing as $p)
    <div class="mb-3">
        <table class="table border">
            <tbody>
                <tr>
                    <td><b>Nama Dosen</b></td>
                    <td><b>:</b></td>
                    <td><b>{{ $p->dosen->nama_dosen }}</b></td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td><b>:</b></td>
                    <td>
                        <b>
                            @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                            Pembimbing
                            @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                            Penguji 1
                            @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                            Penguji 2
                            @endif
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table border">
            <thead>
                <tr>
                    <th>Variabel Penilaian</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>I. Kedisiplinan selama pembimbingan</td>
                    <td>{{ $p->kedisiplinan }}</td>
                </tr>
                <tr>
                    <td>II. Kemauan berusaha</td>
                    <td>{{ $p->kemauan }}</td>
                </tr>
                <tr>
                    <td>III. Kemandirian</td>
                    <td>{{ $p->kemandirian }}</td>
                </tr>
                <tr>
                    <td>IV. Penggunaan standarisasi format penulisan sesuai panduan</td>
                    <td>{{ $p->standarisasi }}</td>
                </tr>
                <tr>
                    <td>V. Keutuhan dan kelengkapan</td>
                    <td>{{ $p->keutuhan }}</td>
                </tr>
                <tr>
                    <td>VI. Kerapihan</td>
                    <td>{{ $p->kerapihan }}</td>
                </tr>
                <tr>
                    <td>VII. Kemampuan melakukan analisis pemasalahan</td>
                    <td>{{ $p->analisis }}</td>
                </tr>
                <tr>
                    <td>VIII. Kemampuan memberikan solusi</td>
                    <td>{{ $p->solusi }}</td>
                </tr>
                <tr>
                    <td>IX. Kemampuan melakukan kajian teoritis dan studi relevan</td>
                    <td>{{ $p->kajian }}</td>
                </tr>
                <tr>
                    <td>X. Penguasaan pengetahuan pada bidang ilmunya</td>
                    <td>{{ $p->penguasaan }}</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Pertanyaan Pokok</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$p->pertanyaan_pokok ?? 'Tidak Ada'}}</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Kesimpulan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$p->kesimpulan ?? 'Tidak Ada'}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>
    @endforeach


    <p><b>Rekapitulasi Nilai</b></p>

    <table class="table border">
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
            @foreach($sortedPenguji as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->dosen->nama_dosen }}</td>
                <td>
                    @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                    Pembimbing
                    @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                    Penguji 1
                    @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                    Penguji 2
                    @endif
                </td>
                <td>
                    {{ $p->sarana + $p->menjelaskan + $p->standarisasi + $p->keutuhan + $p->kerapihan + $p->pemahaman + $p->pendekatan + $p->menjawab }}
                </td>
                <td>25%</td>
                <td>
                    {{ ($p->sarana + $p->menjelaskan + $p->standarisasi + $p->keutuhan + $p->kerapihan + $p->pemahaman + $p->pendekatan + $p->menjawab) * 0.25 }}
                </td>
            </tr>
            @endforeach

            @foreach($d->hasilSkripsiPembimbing as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->dosen->nama_dosen }}</td>
                <td>Pembimbing</td>
                <td>
                    {{ $p->kedisiplinan + $p->kemauan + $p->kemandirian + $p->standarisasi + $p->keutuhan + $p->kerapihan + $p->analisis + $p->solusi + $p->kajian + $p->penguasaan }}
                </td>
                <td>50%</td>
                <td>
                    {{ ($p->kedisiplinan + $p->kemauan + $p->kemandirian + $p->standarisasi + $p->keutuhan + $p->kerapihan + $p->analisis + $p->solusi + $p->kajian + $p->penguasaan) * 0.5 }}
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"></td>
                <td><b>Jumlah :</b></td>
                <td>
                    @php
                    $total = 0;
                    foreach($d->hasilSkripsiPenguji as $p){
                    $total += ($p->sarana + $p->menjelaskan + $p->standarisasi + $p->keutuhan + $p->kerapihan + $p->pemahaman + $p->pendekatan + $p->menjawab)*0.25;
                    }
                    foreach($d->hasilSkripsiPembimbing as $p){
                    $total += ($p->kedisiplinan + $p->kemauan + $p->kemandirian + $p->standarisasi + $p->keutuhan + $p->kerapihan + $p->analisis + $p->solusi + $p->kajian + $p->penguasaan)*0.5;
                    }
                    echo $total;
                    @endphp
                </td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
                <td>
                    <b>Nilai Mutu :</b>
                </td>
                <td>
                    @php
                    $hasilPembimbing = $d->hasilSkripsiPembimbing;
                    $hasilPenguji = $d->hasilSkripsiPenguji;

                    if(count($hasilPembimbing) > 0 && count($hasilPenguji) > 1){
                    $nilai_pembimbing = 0;
                    foreach($hasilPembimbing as $p){
                    $nilai_pembimbing = $nilai_pembimbing +
                    $p->kedisiplinan +
                    $p->kemauan +
                    $p->kemandirian +
                    $p->standarisasi +
                    $p->keutuhan +
                    $p->kerapihan +
                    $p->analisis +
                    $p->solusi +
                    $p->kajian +
                    $p->penguasaan;
                    }

                    $nilai_pembimbing = $nilai_pembimbing * 0.5;

                    $nilai_penguji = 0;
                    foreach($hasilPenguji as $p){
                    $nilai = 0;
                    $nilai = $nilai +
                    $p->sarana +
                    $p->menjelaskan +
                    $p->standarisasi +
                    $p->keutuhan +
                    $p->kerapihan +
                    $p->pemahaman +
                    $p->pendekatan +
                    $p->menjawab;

                    $nilai = $nilai * 0.25;
                    $nilai_penguji = $nilai_penguji + $nilai;
                    }

                    $nilai_akhir = $nilai_pembimbing + $nilai_penguji;

                    switch($nilai_akhir){
                    case $nilai_akhir >= 85:
                    echo("A");
                    break;
                    case $nilai_akhir >= 80:
                    echo("A-");
                    break;
                    case $nilai_akhir >= 75:
                    echo("B+");
                    break;
                    case $nilai_akhir >= 70:
                    echo("B");
                    break;
                    case $nilai_akhir >= 65:
                    echo("B-");
                    break;
                    case $nilai_akhir >= 60:
                    echo("C+");
                    break;
                    case $nilai_akhir >= 55:
                    echo("C");
                    break;
                    case $nilai_akhir >= 40:
                    echo("D");
                    break;
                    case $nilai_akhir >= 1:
                    echo("E");
                    break;
                    }
                    }
                    @endphp
                </td>
            </tr>

        </tbody>
    </table>

</body>

</html>