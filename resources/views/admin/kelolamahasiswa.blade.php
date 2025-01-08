@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="row mt-2">
            <h1 class="mt-4 mb-4">Data Mahasiswa Fakultas Ilmu Komputer</h1>
            <div class="row mb-2 mt-1">
                <div class="row mb-2 mt-4">
                    <div class="col-md-5">
                     
                    </div>
                    
                    <div class="col-md-4 offset-md-3 text-md-end">
                        <form action="{{ route('searchMahasiswa') }}" method="GET">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari nama mahasiswa..." name="search" value="{{ $search ?? '' }}">
                                <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                                @if ($search)
                                    <a href="{{ route('showMahasiswa') }}" class="btn btn-outline-secondary">Clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

			<div class="mt-20">
				<table class="table table-bordered table-hover">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

						@php
							$counter = $data->firstItem();
						@endphp
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>NIM</th>
							<th>Angkatan</th>
                            <th>Prodi</th>
                            <th>Status</th>
                            <th>Action</th>
						</tr>
						@foreach($data as $p)

						<tr>
							<td>{{ $counter++ }}</td>
							<td>{{ $p->nama_mahasiswa }}</td>
							<td>{{ $p->nim }}</td>
							<td>{{ $p->angkatan }}</td>
                            <td>{{ $p->prodi }}</td>
                            <td>
                                @if($p->status_mhs === 0)
                                    Belum Lulus
                                @elseif($p->status_mhs === 1)
                                    Lulus
                                @endif        
                            </td>
                         	
                            <td style="white-space: nowrap;">
                                <button class="btn btn-sm btn-primary open-modal" 
                                        data-nama="{{ $p->nama_mahasiswa }}"
                                        data-nim="{{ $p->nim }}"
                                        data-angkatan="{{ $p->angkatan }}"
                                        data-prodi="{{ $p->prodi }}"
                                        data-status="{{ $p->status_mhs }}"
                                        data-id="{{ $p->id }}">Edit Status
                                </button>
                            </td>				
						</tr>

						@endforeach
				</table>

                @if ($data)
                    <div class="pagination">
                        {{ $data->links('custom_pagination') }}
                    </div>
                @endif
                           
			</div>
	</div>
</div>	

{{-- modal edit  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Status Mahasiswa </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateMahasiswa') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="recordId">
                <div class="modal-body">
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama">Nama</label>
                        <input class="form-control" id="nama" name="nama" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nim">NIM</label>
                        <input class="form-control" id="nim" name="nim" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="angkatan">Angkatan</label>
                        <input class="form-control" id="angkatan" name="angkatan">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="prodi">Prodi</label>
                        <input class="form-control" id="prodi" name="prodi">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="0">Belum Lulus</option>
                            <option value="1">Lulus</option>
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
    $(document).ready(function () {
        $(".open-modal").click(function () {
            var nama = $(this).data("nama");
            var nim = $(this).data("nim");
            var angkatan = $(this).data("angkatan");
            var prodi = $(this).data("prodi");
            var status = $(this).data("status");
            var recordId = $(this).data("id");

            // Populate the modal inputs with the retrieved data
            $("#nama").val(nama);
            $("#nim").val(nim);
            $("#angkatan").val(angkatan);
            $("#prodi").val(prodi);
            $("#status").val(status);
            $("#recordId").val(recordId);

            // Open the modal
            $("#exampleModal").modal("show");
        });
    });
</script>

@endsection