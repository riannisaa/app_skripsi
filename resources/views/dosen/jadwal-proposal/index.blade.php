@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Jadwal Sidang Proposal {{$prodi}}</h1>
        <div class="d-flex justify-content-between">
            <div class="d-flex gap-2">
                <div class="">
                    <a href="{{ route('jadwal-proposal.export', ['prodi' => $prodi, 'id' => auth()->user()->dosen->id]) }}" id="exportButton" class="btn btn-outline-secondary">Export</a>
                </div>
            </div>
            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('jadwal-proposal.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama mahasiswa/nim..." name="search" value="{{ $search ?? '' }}">
                        <input type="hidden" name="prodi" value="{{$prodi}}" />
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                        <a href="{{ route('jadwal-proposal.index', ['prodi'=>$prodi]) }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        @if($jadwal->isEmpty())
        <div class="alert alert-info mt-2">
            Belum ada jadwal
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
                        <th style="white-space: nowrap;">Action</th>
                        <th style="white-space: nowrap;">Nama Mahasiswa</th>
                        <th style="white-space: nowrap;">NIM</th>
                        <th style="white-space: nowrap;">Program Studi</th>
                        <th style="white-space: nowrap;">Tahun Ajaran</th>
                        <th style="white-space: nowrap;">Dosen Pembimbing 1</th>
                        <th style="white-space: nowrap;">Dosen Pembimbing 2</th>
                        <th style="white-space: nowrap;">Judul</th>
                        <th style="white-space: nowrap;">Tanggal</th>
                        <th style="white-space: nowrap;">Waktu</th>
                        <th style="white-space: nowrap;">Ruangan</th>
                        <th style="white-space: nowrap;">Link Daring</th>
                        <th style="white-space: nowrap;">Dosen Penguji 1</th>
                        <th style="white-space: nowrap;">Dosen Penguji 2</th>
                        <th style="white-space: nowrap;">Status Jadwal</th>
                        <th style="white-space: nowrap;">Berkas</th>
                        <th style="white-space: nowrap;">Status Sidang</th>
                    </tr>

                    @foreach($jadwal as $d)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">
                            <button class="btn btn-sm btn-primary open-modal"
                                data-nama_mahasiswa="{{ $d->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa }}"
                                data-nim="{{ $d->berkasProposal->pengajuanDospem->mahasiswa->nim }}"
                                data-id="{{$d->jadwalSidang->id}}"
                                {{!$d->jadwalSidang->done && $d->jadwalSidang->id_penguji_1 == auth()->user()->dosen->id  ? '' : 'disabled'}}>Edit Status
                            </button>
                        </td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa }}</td>
                        <td style="white-space: nowrap;"> {{ $d->berkasProposal->pengajuanDospem->mahasiswa->nim }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->mahasiswa->prodi }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->tahun_ajaran }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->dospem1->nama_dosen }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->dospem2->nama_dosen ?? '-' }}</td>
                        <td style="white-space: nowrap;">{{ $d->berkasProposal->pengajuanDospem->judul }}</td>
                        <td style="white-space: nowrap;">{{ formatTanggalIndo($d->jadwalSidang->plotJadwal->tanggal) }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->plotJadwal->waktu }} WIB</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->plotJadwal->ruangan->nama_ruangan }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->plotJadwal->ruangan->link }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->penguji1->nama_dosen }}</td>
                        <td style="white-space: nowrap;">{{ $d->jadwalSidang->penguji2->nama_dosen ?? '' }}</td>
                        <td>
                            @if($d->jadwalSidang->status === 'Pending')
                            <span class="badge text-bg-warning">Pending</span>
                            @elseif ($d->jadwalSidang->status === 'Disetujui')
                            <span class="badge text-bg-success">Disetujui</span>
                            @elseif ($d->jadwalSidang->status === 'Ditolak')
                            <span class="badge text-bg-danger">Ditolak</span>
                            @endif
                        </td>
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