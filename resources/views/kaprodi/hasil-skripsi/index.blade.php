@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Hasil Sidang Skripsi {{$prodi}}</h1>
        <div class="d-flex justify-content-between">

            <div class="d-flex gap-2">
                <div class="">
                    <a href="{{ route('hasil-skripsi.export', ['prodi' => $prodi]) }}" id="exportButton" class="btn btn-outline-secondary">Export</a>
                </div>
                <div class="">
                    <a href="{{ route('hasil-skripsi.mass-export', ['prodi' => $prodi]) }}" id="exportButton" class="btn btn-outline-secondary">Export Detail Penilaian</a>
                </div>
            </div>

            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('hasil-skripsi.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama mahasiswa/nim..." name="search" value="{{ $search ?? '' }}">
                        <input type="hidden" name="prodi" value="{{$prodi}}" />
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                        <a href="{{ route('hasil-skripsi.index', ['prodi'=>$prodi]) }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @if($jadwal->isEmpty())
        <div class="alert alert-info mt-2">
            Belum ada hasil penilaian
        </div>
        @else
        <div class="mt-2">
            <div class="table-container" style="overflow-x: auto;">
                <table class="table table-bordered table-hover">

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <tr>
                        <th>No</th>
                        <th style="white-space: nowrap;">Nama Mahasiswa</th>
                        <th style="white-space: nowrap;">NIM</th>
                        <th style="white-space: nowrap;">Program Studi</th>
                        <th style="white-space: nowrap;">Dosen Pembimbing 1</th>
                        <th style="white-space: nowrap;">Dosen Pembimbing 2</th>
                        <th style="white-space: nowrap;">Judul</th>
                        <th style="white-space: nowrap;">Tanggal</th>
                        <th style="white-space: nowrap;">Waktu</th>
                        <th style="white-space: nowrap;">Ruangan</th>
                        <th style="white-space: nowrap;">Dosen Penguji 1</th>
                        <th style="white-space: nowrap;">Dosen Penguji 2</th>
                        <th style="white-space: nowrap;">Berkas</th>
                        <th style="white-space: nowrap;">Status Sidang</th>
                        <th style="white-space: nowrap;">Keterangan</th>
                        <th style="white-space: nowrap;">File Skripsi Akhir</th>
                        <th style="white-space: nowrap;">File Lembar Revisi</th>
                        <th style="white-space: nowrap;">File Pengesahan</th>
                        <th style="white-space: nowrap;">ACC Pembimbing 1</th>
                        <th style="white-space: nowrap;">ACC Pembimbing 2</th>
                        <th style="white-space: nowrap;">ACC Penguji 1</th>
                        <th style="white-space: nowrap;">ACC Penguji 2</th>
                        <th style="white-space: nowrap;">ACC Kaprodi</th>
                        <th style="white-space: nowrap;">Bebas Pustaka</th>
                        <th style="white-space: nowrap;">Action</th>
                        <th style="white-space: nowrap;">Nilai Akhir</th>
                        <th style="white-space: nowrap;">Aksi</th>
                    </tr>

                    @foreach($jadwal as $d)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa }}</td>
                        <td style="white-space: nowrap;"> {{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nim }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->prodi }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasSkripsi->pengajuanDospem->dospem1->nama_dosen }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasSkripsi->pengajuanDospem->dospem2->nama_dosen ?? '-' }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasSkripsi->pengajuanDospem->judul }}</td>
                        <td style="white-space: nowrap;">{{ formatTanggalIndo($d->jadwalSidang->plotJadwal->tanggal) }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->plotJadwal->waktu }} WIB</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->plotJadwal->ruangan->nama_ruangan }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->penguji1->nama_dosen }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->penguji2->nama_dosen ?? '' }}</td>
                        <td style="white-space: nowrap;">
                            <a class="btn btn-sm btn-danger" href="{{route('berkas-skripsi.index', ['prodi'=>$prodi])}}">Lihat Berkas</a>
                        </td>
                        <td>
                            @if($d->jadwalSidang->done === 0)
                            <span class="badge text-bg-warning">Belum Sidang</span>
                            @elseif ($d->jadwalSidang->done === 1)
                            <span class="badge text-bg-success">Selesai</span>
                            @endif
                        </td>
                        <td>
                            @if($d->status_revisi === "Revisi")
                            <span class="badge text-bg-warning">Revisi</span>
                            @elseif ($d->status_revisi === "Tidak Revisi")
                            <span class="badge text-bg-success">Tidak Revisi</span>
                            @else
                            <span class="badge text-bg-info">Belum Ditentukan</span>
                            @endif
                        </td>
                        <td>
                            @if($d->file_skripsi)
                            <a href="{{ Storage::url($d->file_skripsi) }}" target="_blank" style="text-decoration: none;">View</a>
                            @endif
                        </td>
                        <td>
                            @if($d->file_revisi)
                            <a href="{{ Storage::url($d->file_revisi) }}" target="_blank" style="text-decoration: none;">View</a>
                            @endif
                        </td>
                        <td>
                            @if($d->file_pengesahan)
                            <a href="{{ Storage::url($d->file_pengesahan) }}" target="_blank" style="text-decoration: none;">View</a>
                            @endif
                        </td>
                        <td>
                            @if($d->acc_pembimbing_1)
                            <span class="badge text-bg-success">Disetujui</span>
                            @else
                            <span class="badge text-bg-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($d->berkasSkripsi->pengajuanDospem->mahasiswa->prodi != 'D3 Sistem Informasi')
                                @if($d->acc_pembimbing_2)
                                <span class="badge text-bg-success">Disetujui</span>
                                @else
                                <span class="badge text-bg-warning">Pending</span>
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($d->acc_penguji_1)
                            <span class="badge text-bg-success">Disetujui</span>
                            @else
                            <span class="badge text-bg-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($d->acc_penguji_2)
                            <span class="badge text-bg-success">Disetujui</span>
                            @else
                            <span class="badge text-bg-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($d->acc_kaprodi)
                            <span class="badge text-bg-success">Disetujui</span>
                            @else
                            <span class="badge text-bg-warning">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($d->bebas_pustaka)
                            <span class="badge text-bg-success">Disetujui</span>
                            @else
                            <span class="badge text-bg-warning">Pending</span>
                            @endif
                        </td>
                        <td style="white-space: nowrap;">
                            @if($d->berkasSkripsi->pengajuanDospem->mahasiswa->prodi != 'D3 Sistem Informasi')
                                @if($d->acc_kaprodi)
                                <button disabled class="btn btn-sm btn-primary">
                                    Sudah ACC
                                </button>
                                @elseif(!$d->acc_pembimbing_1 || !$d->acc_pembimbing_2 || !$d->acc_penguji_1 || !$d->acc_penguji_2) 
                                <button disabled class="btn btn-sm btn-primary">
                                    ACC Belum Lengkap
                                </button>
                                @else
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('jadwal-skripsi.acc-dosen', ['acc_kaprodi' => true, 'id'=>$d->id]) }}">ACC
                                </a>
                                @endif
                            @else
                                @if($d->acc_kaprodi)
                                <button disabled class="btn btn-sm btn-primary">
                                    Sudah ACC
                                </button>
                                @elseif(!$d->acc_pembimbing_1 || !$d->acc_penguji_1 || !$d->acc_penguji_2) 
                                <button disabled class="btn btn-sm btn-primary">
                                    ACC Belum Lengkap
                                </button>
                                @else
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('jadwal-skripsi.acc-dosen', ['acc_kaprodi' => true, 'id'=>$d->id]) }}">ACC
                                </a>
                                @endif
                            @endif
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
                                        }
                                }
                            @endphp
                        </td>
                        <td style="white-space: nowrap;">
                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal-{{$d->id}}">Lihat Nilai</button>
                        </td>
                    </tr>

                    
                    <div class="modal fade modal-lg" id="detailModal-{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Nilai Sidang</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div>
                                        <div class="px-2 mb-3">
                                            <div class="row">
                                                <div class="col-md-8 border p-2">
                                                    <b>Nama Mahasiswa</b>
                                                </div>
                                                <div class="col-md-1 border p-2">
                                                    <b>:</b>
                                                </div>
                                                <div class="col-md-3 border p-2">
                                                    <b>
                                                        {{$d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa}}
                                                    </b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8 border p-2">
                                                    <b>NIM</b>
                                                </div>
                                                <div class="col-md-1 border p-2">
                                                    <b>:</b>
                                                </div>
                                                <div class="col-md-3 border p-2">
                                                    <b>
                                                        {{$d->berkasSkripsi->pengajuanDospem->mahasiswa->nim}}
                                                    </b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8 border p-2">
                                                    <b>Prodi</b>
                                                </div>
                                                <div class="col-md-1 border p-2">
                                                    <b>:</b>
                                                </div>
                                                <div class="col-md-3 border p-2">
                                                    <b>
                                                        {{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->prodi }}
                                                    </b>
                                                </div>
                                            </div>

                                        </div>
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
                                    <div>
                                        <div class="px-2 mb-3">
                                            <div class="row">
                                                <div class="col-md-8 border p-2">
                                                    <b>Nama Dosen</b>
                                                </div>
                                                <div class="col-md-1 border p-2">
                                                    <b>:</b>
                                                </div>
                                                <div class="col-md-3 border p-2">
                                                    <b>
                                                        {{$p->dosen->nama_dosen}}
                                                    </b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8 border p-2">
                                                    <b>Status</b>
                                                </div>
                                                <div class="col-md-1 border p-2">
                                                    <b>:</b>
                                                </div>
                                                <div class="col-md-3 border p-2">
                                                    <b>
                                                        @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                                                        Pembimbing
                                                        @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                                                        Penguji 1
                                                        @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                                                        Penguji 2
                                                        @endif
                                                    </b>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="mb-3 px-2">
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    <b>Variabel Penilaian</b>
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    <b>Nilai</b>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    I. Penggunaan sarana & efisiensi alokasi waktu yang digunakan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->sarana }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    II. Tingkat kemampuan menjelaskan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->menjelaskan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    III. Penggunaan standarisasi format penulisan sesuai panduan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->standarisasi }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    IV. Keutuhan dan kelengkapan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->keutuhan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    V. Kerapihan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->kerapihan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    VI. Tingkat pemahaman terhadap pokok permasalahan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->pemahaman }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    VII. Tingkat pendekatan penyelesaian masalah
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->pendekatan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    VIII. Kemampuan menjelaskan/menjawab pertanyaan dengan benar sesuai prinsip
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->menjawab }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 px-2">
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <b>Pertanyaan Pokok</b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <p>{{$p->pertanyaan_pokok ?? 'Tidak Ada'}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 px-2">
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <b>Kesimpulan</b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <p>{{$p->kesimpulan ?? 'Tidak Ada'}}</p>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <hr class="mb-3" />
                                    @endforeach

                                    @foreach($d->hasilSkripsiPembimbing as $p)
                                    <div>
                                        <div class="px-2 mb-3">
                                            <div class="row">
                                                <div class="col-md-8 border p-2">
                                                    <b>Nama Dosen</b>
                                                </div>
                                                <div class="col-md-1 border p-2">
                                                    <b>:</b>
                                                </div>
                                                <div class="col-md-3 border p-2">
                                                    <b>
                                                        {{$p->dosen->nama_dosen}}
                                                    </b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8 border p-2">
                                                    <b>Status</b>
                                                </div>
                                                <div class="col-md-1 border p-2">
                                                    <b>:</b>
                                                </div>
                                                <div class="col-md-3 border p-2">
                                                    <b>
                                                        @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                                                        Pembimbing
                                                        @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                                                        Penguji 1
                                                        @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                                                        Penguji 2
                                                        @endif
                                                    </b>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mb-3 px-2">
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    <b>Variabel Penilaian</b>
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    <b>Nilai</b>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    I. Kedisiplinan selama pembimbingan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->kedisiplinan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    II. Kemauan berusaha
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->kemauan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    III. Kemandirian
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->kemandirian }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    IV. Penggunaan standarisasi format penulisan sesuai panduan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->standarisasi }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    V. Keutuhan dan kelengkapan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->keutuhan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    VI. Kerapihan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->kerapihan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    VII. Kemampuan melakukan analisis pemasalahan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->analisis }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    VIII. Kemampuan memberikansolusi
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->solusi }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    IX. Kemampuan melakukan kajian teoritis dan studi relevan
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->kajian }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    X. Penguasaan pengetahuan pada bidang ilmunya
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->penguasaan }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 px-2">
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <b>Pertanyaan Pokok</b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <p>{{$p->pertanyaan_pokok ?? 'Tidak Ada'}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 px-2">
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <b>Kesimpulan</b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <p>{{$p->kesimpulan ?? 'Tidak Ada'}}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr class="mb-3" />
                                    @endforeach

                                    <p>
                                        <b>Rekapitulasi Nilai</b>
                                    </p>

                                    <div class="mb-3 px-2">
                                        <div class="row">
                                            <div class="col-md-1 border p-2">
                                                <b>No</b>
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                <b>Nama Penguji</b>
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                <b>Jabatan Penguji</b>
                                            </div>
                                            <div class="col-md-1 border p-2">
                                                <b>Nilai (N)</b>
                                            </div>
                                            <div class="col-md-1 border p-2">
                                                <b>Bobot (B)</b>
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                <b>Nilai Akhir (N x B)</b>
                                            </div>
                                        </div>
                                        @foreach($sortedPenguji as $p)
                                        <div class="row">
                                            <div class="col-md-1 border p-2">
                                                {{$loop->iteration}}
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                {{$p->dosen->nama_dosen}}
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                                                Pembimbing
                                                @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                                                Penguji 1
                                                @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                                                Penguji 2
                                                @endif
                                            </div>
                                            <div class="col-md-1 border p-2">
                                                {{$p->sarana +
                                                $p->menjelaskan +
                                                $p->standarisasi +
                                                $p->keutuhan +
                                                $p->kerapihan +
                                                $p->pemahaman +
                                                $p->pendekatan +
                                                $p->menjawab}}
                                            </div>
                                            <div class="col-md-1 border p-2">
                                                @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                                                50%
                                                @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                                                25%
                                                @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                                                25%
                                                @endif
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                {{($p->sarana +
                                                $p->menjelaskan +
                                                $p->standarisasi +
                                                $p->keutuhan +
                                                $p->kerapihan +
                                                $p->pemahaman +
                                                $p->pendekatan +
                                                $p->menjawab)*0.25}}
                                            </div>
                                        </div>
                                        @endforeach
                                        @foreach($d->hasilSkripsiPembimbing as $p)
                                        <div class="row">
                                            <div class="col-md-1 border p-2">
                                                {{$loop->iteration}}
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                {{$p->dosen->nama_dosen}}
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                                                Pembimbing
                                                @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                                                Penguji 1
                                                @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                                                Penguji 2
                                                @endif
                                            </div>
                                            <div class="col-md-1 border p-2">
                                                {{$p->kedisiplinan +
                                                $p->kemauan +
                                                $p->kemandirian +
                                                $p->standarisasi +
                                                $p->keutuhan +
                                                $p->kerapihan +
                                                $p->analisis +
                                                $p->solusi +
                                                $p->kajian +
                                                $p->penguasaan}}
                                            </div>
                                            <div class="col-md-1 border p-2">
                                                @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                                                50%
                                                @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1)
                                                25%
                                                @elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2)
                                                25%
                                                @endif
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                {{($p->kedisiplinan +
                                                $p->kemauan +
                                                $p->kemandirian +
                                                $p->standarisasi +
                                                $p->keutuhan +
                                                $p->kerapihan +
                                                $p->analisis +
                                                $p->solusi +
                                                $p->kajian +
                                                $p->penguasaan)*0.5}}
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-7 border p-2">

                                            </div>
                                            <div class="col-md-2 border p-2">
                                                <b>Jumlah :</b>
                                            </div>
                                            <div class="col-md-3 border p-2">
                                                @php
                                                $total = 0;
                                                foreach($d->hasilSkripsiPenguji as $p){
                                                $total += ($p->sarana +
                                                $p->menjelaskan +
                                                $p->standarisasi +
                                                $p->keutuhan +
                                                $p->kerapihan +
                                                $p->pemahaman +
                                                $p->pendekatan +
                                                $p->menjawab)*0.25;
                                                }
                                                foreach($d->hasilSkripsiPembimbing as $p){
                                                $total += ($p->kedisiplinan +
                                                $p->kemauan +
                                                $p->kemandirian +
                                                $p->standarisasi +
                                                $p->keutuhan +
                                                $p->kerapihan +
                                                $p->analisis +
                                                $p->solusi +
                                                $p->kajian +
                                                $p->penguasaan)*0.5;
                                                }

                                                echo $total;
                                                @endphp
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7 border p-2">

                                            </div>
                                            <div class="col-md-2 border p-2">
                                                <b>Nilai Mutu :</b>
                                            </div>
                                            <div class="col-md-3 border p-2">
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
                                                }

                                                }
                                                @endphp
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </table>

                @if ($jadwal->isNotEmpty())
                <div class="pagination">
                    {{ $jadwal->links('custom_pagination') }}
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Keterangan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('jadwal-sidang.revisi') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="recordId">
                <div class="modal-body">
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_mahasiswa">Nama Mahasiswa</label>
                        <input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" type="text" disabled>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nim">NIM</label>
                        <input class="form-control" id="nim" name="nim" type="string" disabled>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option disabled selected>Pilih Opsi...</option>
                            <option value="Revisi">Revisi</option>
                            <option value="Tidak Revisi">Tidak Revisi</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".open-modal").click(function() {
            // Get the data from the button's data attributes
            var nama_mahasiswa = $(this).data("nama_mahasiswa");
            var nim = $(this).data("nim");


            var recordId = $(this).data("id");

            $("#nama_mahasiswa").val(nama_mahasiswa);
            $("#nim").val(nim);

            $("#recordId").val(recordId);

            $("#exampleModal").modal("show");
        });
    });

    console.log("recordId: " + recordId);
    console.log("status: " + $("#status").val());

    document.getElementById('exportButton').addEventListener('click', function(event) {
        var confirmed = confirm('Apakah Anda yakin ingin mengekspor data?');

        if (!confirmed) {
            event.preventDefault();
        }
    });
</script>
@endsection