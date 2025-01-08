@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Pendaftaran Sidang Proposal {{$prodi}}</h1>
        <div class="row mb-2 mt-4">
            <div class="col-md-6">
                <a href="{{ route('berkas-proposal.export', ['prodi' => $prodi]) }}" id="exportButton" class="btn btn-outline-secondary">Export</a>
            </div>

            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('berkas-proposal.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama mahasiswa/nim..." name="search" value="{{ $search ?? '' }}">
                        <input type="hidden" name="prodi" value="{{$prodi}}" />
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                        <a href="{{ route('berkas-proposal.index', ['prodi'=>$prodi]) }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
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
                        <th style="white-space: nowrap;">Tahun Ajaran</th>
                        <th style="white-space: nowrap;">Dosen Pembimbing 1</th>
                        <th style="white-space: nowrap;">Dosen Pembimbing 2</th>
                        <th style="white-space: nowrap;">Judul</th>
                        <th>Buku Bimbingan</th>
                        <th>KHS</th>
                        <th>KST</th>
                        <th>Video Presentasi</th>
                        <th>File Proposal</th>
                        <th style="white-space: nowrap;">Status</th>
                        <th>Keterangan</th>
                    </tr>

                    @foreach($berkas as $d)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">{{ $d->pengajuanDospem->mahasiswa->nama_mahasiswa }}</td>
                        <td style="white-space: nowrap;"> {{ $d->pengajuanDospem->mahasiswa->nim }}</td>
                        <td style="white-space: nowrap;">{{ $d->pengajuanDospem->mahasiswa->prodi }}</td>
                        <td style="white-space: nowrap;">{{ $d->tahun_ajaran }}</td>
                        <td style="white-space: nowrap;">{{ $d->pengajuanDospem->dospem1->nama_dosen }}</td>
                        <td style="white-space: nowrap;">{{ $d->pengajuanDospem->dospem2->nama_dosen ?? '-' }}</td>
                        <td style="white-space: nowrap;">{{ $d->pengajuanDospem->judul }}</td>
                        <td>
                            <a href="{{ Storage::url($d->buku_bimbingan) }}" target="_blank" style="text-decoration: none;">View</a>
                        </td>
                        <td>
                            <a href="{{ Storage::url($d->khs) }}" target="_blank" style="text-decoration: none;">View</a>
                        </td>
                        <td>
                            <a href="{{ Storage::url($d->kst) }}" target="_blank" style="text-decoration: none;">View</a>
                        </td>
                        <td>
                            <a href="{{ Storage::url($d->video) }}" target="_blank" style="text-decoration: none;">View</a>
                        </td>
                        <td>
                            <a href="{{ Storage::url($d->file_dokumen) }}" target="_blank" style="text-decoration: none;">View</a>
                        </td>
                        <td>
                            @if($d->status === 'Pending')
                            <span class="badge text-bg-warning">Pending</span>
                            @elseif ($d->status === 'Disetujui')
                            <span class="badge text-bg-success">Disetujui</span>
                            @elseif ($d->status === 'Ditolak')
                            <span class="badge text-bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>{{ $d->keterangan }}</td>
                    </tr>
                    @endforeach
                </table>

                @if ($berkas->isNotEmpty())
                <div class="pagination">
                    {{ $berkas->links('custom_pagination') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Approval Pendaftaran Sidang Proposal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('berkas-proposal.update-status') }}" method="POST">
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
                            <option value="Disetujui">Disetujui</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="keterangan">Keterangan</label>
                        <input class="form-control" id="keterangan" name="keterangan" type="text">
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