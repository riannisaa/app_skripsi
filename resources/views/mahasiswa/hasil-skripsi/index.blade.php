@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Hasil Sidang Skripsi</h1>
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
                        <th style="white-space: nowrap;">Nilai Akhir</th>
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
                            @if($d->status_revisi === 'Revisi' && $d->file_skripsi === null)
                            <button class="btn btn-sm btn-primary open-modal"
                                data-nama_mahasiswa="{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa }}"
                                data-nim="{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nim }}"
                                data-id="{{$d->id}}"
                                data-form="file_skripsi">Upload
                            </button>
                            @elseif($d->status_revisi === 'Tidak Revisi')
                            <button class="btn btn-sm btn-primary" disabled>Upload</button>
                            @else
                            @if($d->file_skripsi)
                            <a href="{{ Storage::url($d->file_skripsi) }}" target="_blank" style="text-decoration: none;">View</a>
                            @endif
                            @endif
                        </td>
                        <td>
                            @if($d->status_revisi === 'Revisi' && $d->file_revisi === null)
                            <button class="btn btn-sm btn-primary open-modal"
                                data-nama_mahasiswa="{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa }}"
                                data-nim="{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nim }}"
                                data-id="{{$d->id}}"
                                data-form="file_revisi">Upload
                            </button>
                            @elseif($d->status_revisi === 'Tidak Revisi')
                            <button class="btn btn-sm btn-primary" disabled>Upload</button>
                            @else
                            @if($d->file_revisi)
                            <a href="{{ Storage::url($d->file_revisi) }}" target="_blank" style="text-decoration: none;">View</a>
                            @endif
                            @endif
                        </td>
                        <td>
                            @if($d->file_pengesahan === null)
                            <button class="btn btn-sm btn-primary open-modal"
                                data-nama_mahasiswa="{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nama_mahasiswa }}"
                                data-nim="{{ $d->berkasSkripsi->pengajuanDospem->mahasiswa->nim }}"
                                data-id="{{$d->id}}"
                                data-form="file_pengesahan">Upload
                            </button>
                            @elseif($d->file_pengesahan)
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
                        <td>
                        @if($d->acc_penguji_1 && $d->acc_penguji_2 && $d->acc_pembimbing_1 && ($d->berkasSkripsi->pengajuanDospem->mahasiswa->prodi != 'D3 Sistem Informasi' ? $d->acc_pembimbing_2 : true) && $d->acc_kaprodi && $d->bebas_pustaka)

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
                        @else
                        <span class="badge text-bg-warning">Pending</span>
                        @endif
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('jadwal-skripsi.upload-file') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="recordId">
                <input type="hidden" name="berkas" id="formName">
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
                        <label class="small mb-1" for="status">Upload File</label>
                        <input class="form-control" accept="application/pdf" name="file" type="file">
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
            var formName = $(this).data("form");

            $("#nama_mahasiswa").val(nama_mahasiswa);
            $("#nim").val(nim);
            $("#formName").val(formName);

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