@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Hasil Sidang Proposal</h1>
        @if($jadwal->isEmpty())
        <div class="alert alert-info mt-2">
            Belum ada hasil penilaian
        </div>
        @else
        <div class="mt-2">
            <div class="table-container overflow-scroll" style="overflow-x: auto;">
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
                        <th style="white-space: nowrap;">Status Sidang</th>
                        <th style="white-space: nowrap;">Nilai Akhir</th>
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
                
                        <td>
                            @if($d->jadwalSidang->done === 0)
                            <span class="badge text-bg-warning">Belum Sidang</span>
                            @elseif ($d->jadwalSidang->done === 1)
                            <span class="badge text-bg-success">Selesai</span>
                            @endif
                        </td>
                        <td>
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
                        </td>
                    </tr>
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