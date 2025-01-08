@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Hasil Sidang Proposal {{$prodi}}</h1>
        <div class="d-flex justify-content-between">

            <div class="d-flex gap-2">
                <div class="">
                    <a href="{{ route('hasil-proposal.export', ['prodi' => $prodi]) }}" id="exportButton" class="btn btn-outline-secondary">Export</a>
                </div>
                <div class="">
                    <a href="{{ route('hasil-proposal.mass-export', ['prodi' => $prodi]) }}" id="exportButton" class="btn btn-outline-secondary">Export Detail Penilaian</a>
                </div>
            </div>

            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('hasil-proposal.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama mahasiswa/nim..." name="search" value="{{ $search ?? '' }}">
                        <input type="hidden" name="prodi" value="{{$prodi}}" />
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                        <a href="{{ route('hasil-proposal.index', ['prodi'=>$prodi]) }}" class="btn btn-outline-secondary">Clear</a>
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
                        <th style="white-space: nowrap;">Nilai Akhir</th>
                        <th style="white-space: nowrap;">Aksi</th>
                    </tr>

                    @foreach($jadwal as $d)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa }}</td>
                        <td style="white-space: nowrap;"> {{ $d->berkasProposal->pengajuanDospem->mahasiswa->nim }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->mahasiswa->prodi }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->dospem1->nama_dosen }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->dospem2->nama_dosen ?? '-' }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->judul }}</td>
                        <td style="white-space: nowrap;">{{ formatTanggalIndo($d->jadwalSidang->plotJadwal->tanggal) }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->plotJadwal->waktu }} WIB</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->plotJadwal->ruangan->nama_ruangan }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->penguji1->nama_dosen }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->penguji2->nama_dosen ?? '' }}</td>
                        <td style="white-space: nowrap;">
                            <a class="btn btn-sm btn-danger" href="{{route('berkas-proposal.index', ['prodi'=>$prodi])}}">Lihat Berkas</a>
                        </td>
                        <td>
                            @if($d->jadwalSidang->done === 0)
                            <span class="badge text-bg-warning">Belum Sidang</span>
                            @elseif ($d->jadwalSidang->done === 1)
                            <span class="badge text-bg-success">Selesai</span>
                            @endif
                        </td>
                        <td>
                            @php
                            if($d->hasilProposal->count(3)){
                            $pembimbingId = $d->jadwalSidang->id_pembimbing;
                            $penguji1Id = $d->jadwalSidang->id_penguji_1;
                            $penguji2Id = $d->jadwalSidang->id_penguji_2;

                            $pembimbingScore = 0;
                            $penguji1Score = 0;
                            $penguji2Score = 0;

                            foreach($d->hasilProposal as $p){
                            if($p->id_dosen == $pembimbingId){
                            $pembimbingScore = $pembimbingScore + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
                            }elseif($p->id_dosen == $penguji1Id){
                            $penguji1Score = $penguji1Score + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
                            }elseif($p->id_dosen == $penguji2Id){
                            $penguji2Score = $penguji2Score + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
                            }
                            }

                            $nilai_akhir = ($pembimbingScore*0.5) + ($penguji1Score*0.25) + ($penguji2Score*0.25);

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

                            }else{
                            echo 'Belum Lengkap';
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
                                                        {{$d->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa}}
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
                                                        {{$d->berkasProposal->pengajuanDospem->mahasiswa->nim}}
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
                                                        {{ $d->berkasProposal->pengajuanDospem->mahasiswa->prodi }}
                                                    </b>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
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
                                                    I. Kesesuaian Judul Dengan Isi
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->kesesuaian }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    II. Kedalaman dan Keluasan Materi Sesuai Level Tugas Akhir
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->kedalaman }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    III. Rumusan Masalah Didefinisikan Dengan Jelas
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->rumusan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    IV. Penguasaan Terhadap Studi Terkait Dan Teori Pendukung
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->penguasaan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 border p-2">
                                                    V. Kesesuaian Metode Yang Digunakan Untuk Menyelesaikan Masalah
                                                </div>
                                                <div class="col-md-2 border p-2">
                                                    {{ $p->metode }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 px-2">
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <b>Saran</b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 border p-2">
                                                    <p>{{$p->saran ?? 'Tidak Ada'}}</p>
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
                                        @foreach($sorted as $p)
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
                                                {{$p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode}}
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
                                                @if($p->dosen->id == $d->jadwalSidang->id_pembimbing)
                                                {{($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode)*0.5}}
                                                @else
                                                {{($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode)*0.25}}
                                                @endif
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
                                                foreach($sorted as $p){
                                                if($p->dosen->id == $d->jadwalSidang->id_pembimbing){
                                                $total += ($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode)*0.5;
                                                }elseif($p->dosen->id == $d->jadwalSidang->id_penguji_1){
                                                $total += ($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode)*0.25;
                                                }elseif($p->dosen->id == $d->jadwalSidang->id_penguji_2){
                                                $total += ($p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode)*0.25;
                                                }
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
                                                if(count($d->hasilProposal) == 3){
                                                $pembimbingId = $d->jadwalSidang->id_pembimbing;
                                                $penguji1Id = $d->jadwalSidang->id_penguji_1;
                                                $penguji2Id = $d->jadwalSidang->id_penguji_2;

                                                $pembimbingScore = 0;
                                                $penguji1Score = 0;
                                                $penguji2Score = 0;

                                                foreach($d->hasilProposal as $p){
                                                if($p->id_dosen == $pembimbingId){
                                                $pembimbingScore = $pembimbingScore + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
                                                }elseif($p->id_dosen == $penguji1Id){
                                                $penguji1Score = $penguji1Score + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
                                                }elseif($p->id_dosen == $penguji2Id){
                                                $penguji2Score = $penguji2Score + $p->kesesuaian + $p->kedalaman + $p->rumusan + $p->penguasaan + $p->metode;
                                                }
                                                }

                                                $nilai_akhir = ($pembimbingScore*0.5) + ($penguji1Score*0.25) + ($penguji2Score*0.25);

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

                                                }else{
                                                echo 'Belum Lengkap';
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Status Sidang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('jadwal-sidang.update-done') }}" method="POST">
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
                        <select class="form-select" id="status" name="done">
                            <option disabled selected>Pilih Opsi...</option>
                            <option value="1">Selesai</option>
                            <option value="0">Belum Sidang</option>
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