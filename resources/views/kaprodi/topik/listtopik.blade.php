@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        <div class="row mt-2">
            <h1 class="mt-4 mb-4">Daftar Topik Skripsi/Tugas Akhir</h1>

            <div class="row mb-2 mt-1">
                <div class="col-md-5">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTopicModal">Tambah Topik</button>      
                    <a href="{{ route('export') }}" id="exportButton" class="btn btn-outline-secondary">Export</a>
                </div>
                
                <div class="col-md-4 offset-md-3 text-md-end">
                    <form action="{{ route('listTopik.search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari prodi/peminatan/topik..." name="search" value="{{ $search ?? '' }}">
                            <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                            @if ($search)
                                <a href="{{ route('listTopik.admin') }}" class="btn btn-outline-secondary">Clear</a>
                            @endif
                        </div>
                    </form>
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
							$counter = $data->firstItem(); // Start the counter with the first item number

						@endphp
						<tr>
							<th>No</th>
							<th>Prodi</th>
							<th>Peminatan</th>
							<th>Topik</th>
                            <th>Keterangan</th>
                            <th>Dosen</th>
							<th>Kapasitas</th>
							<th>Peserta</th>
                            <th>Action</th>
						</tr>
						@foreach($data as $p)

						<tr>
							<td>{{ $counter++ }}</td>
							<td>{{ $p->jurusan }}</td>
							<td>{{ $p->peminatan }}</td>
							<td>{{ $p->topik }}</td>
                            <td>{{ $p->ket }}</td>
                            <td style="white-space: nowrap;">
                                @foreach($p->dosen as $supervisor)
                                    {{ $loop->iteration }}. {{ $supervisor->nama_dosen }} <br>
                                @endforeach
                            </td>

							<td>{{ $p->kapasitas}}</td>
							<td>{{ $p->peserta }}</td>		
                            <td style="white-space: nowrap;">
                                {{-- <button class="btn btn-sm btn-primary open-modal"
                                    data-id="{{ $p->id }}"
                                    data-jurusan="{{ $p->jurusan }}"
                                    data-peminatan="{{ $p ->peminatan }}"
                                    data-topik="{{ $p->topik }}"
                                    data-dosen="{{ $p->dosen }}"
                                    data-ket="{{ $p ->ket }}"
                                    data-kapasitas="{{ $p->kapasitas }}"
                                    data-peserta="{{ $p ->peserta }}">                
                                    Edit</button> --}}
                                    <a href="{{ route('editTopik', ['id' => $p->id]) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>                                
                                    <button class="btn btn-sm btn-danger open-delete-modal"
                                    data-id="{{ $p->id }}"
                                    data-topik="{{ $p->topik }}">
                                    Delete</button>
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
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Topik </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateTopik') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="recordId">
                <div class="modal-body">
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="jurusan">Program Studi </label>
                        <input class="form-control" id="jurusan" name="jurusan" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="topik">Topik </label>
                        <input class="form-control" id="topik" name="topik" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="dosen">Dosen</label>
                        <input class="form-control" id="dosen" name="dosen">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="kapasitas">Kapasitas </label>
                        <input class="form-control" id="kapasitas" name="kapasitas" type="number" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

{{-- modal delete --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data Topik</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('deleteTopik') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteRecordId">
                <div class="modal-body">
                    <p>Apakah Anda yakin untuk menghapus topik <br> "<span id="deleteTopikName"></span>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal add  --}}
<div class="modal fade" id="addTopicModal" tabindex="-1" aria-labelledby="addTopicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTopicModalLabel">Tambah Data Topik</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('addDataTopik') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Add form fields for adding a new topic here -->
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="jurusan">Program Studi</label>
                        <select class="form-select" id="jurusan" name="jurusan" required>
                            <option value="" disabled selected>Pilih Program Studi</option>
                            <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                            <option value="S1 Informatika">S1 Informatika</option>
                            <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="peminatan">Peminatan</label>
                        <select class="form-select" id="peminatan" name="peminatan" required>
                            <option value="" disabled selected>Pilih Peminatan</option>
                        

                            <optgroup label="S1 Sistem Informasi">
                                <option value="Software Developer">Software Developer</option>
                                <option value="Data Analyst">Data Analyst</option>
                                <option value="IT Auditor">IT Auditor</option>
                            </optgroup>
                    
                            <!-- Options for S1 Informatika -->
                            <optgroup label="S1 Informatika">
                                <option value="Software Engineer">Software Engineer</option>
                                <option value="Cloud Fullstack Operator">Cloud Fullstack Operator</option>
                                <option value="AI Engineering">AI Engineering</option>
                            </optgroup>
                    
                            <!-- Options for D3 Sistem Informasi -->
                            <optgroup label="D3 Sistem Informasi">
                                <option value="Web Developer">Web Developer</option>
                                <option value="Mobile Developer">Mobile Developer</option>
                                <option value="BI Developer">BI Developer</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="topik">Topik</label>
                        <input class="form-control" id="topik" name="topik" type="text" required>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="ket">Keterangan</label>
                        <textarea class="form-control" id="ket" name="ket" required></textarea>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="dosen">Dosen <br>
                            
                        </label>
                        {{-- <select class="form-select" id="dosen" name="dosen" multiple> --}}
                        <select class="form-select" id="dosen" name="dosen[]" multiple required data-placeholder="Pilih dosen">
                            @foreach ($allDosen as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                            @endforeach
                        </select>                      
                    </div>          
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="kapasitas">Kapasitas</label>
                        <input class="form-control" id="kapasitas" name="kapasitas" type="number" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>    

    $(document).ready(function () {
        $(".open-modal").click(function () {
            // Get the data from the button's data attributes
            var jurusan = $(this).data("jurusan");
            var peminatan = $(this).data("peminatan");
            var topik = $(this).data("topik");
            var dosen = $(this).data("dosen");
            var kapasitas = $(this).data("kapasitas");
            var peserta = $(this).data("peserta");
            var recordId = $(this).data("id"); // Get the record ID

            // Populate the modal inputs with the retrieved data
            $("#jurusan").val(jurusan);
            $("#peminatan").val(peminatan);
            $("#topik").val(topik);
            $("#dosen").val(dosen);
            $("#kapasitas").val(kapasitas);
            $("#peserta").val(peserta);

            // Set the record ID in the hidden input field
            $("#recordId").val(recordId);

            // Open the modal
            $("#exampleModal").modal("show");
        });

        $(".open-delete-modal").click(function () {
            var topikName = $(this).data("topik");
            var recordId = $(this).data("id");

            // Populate the delete modal with the retrieved data
            $("#deleteTopikName").text(topikName);
            $("#deleteRecordId").val(recordId);

            // Open the delete modal
            $("#deleteModal").modal("show");
        });
    });

    document.getElementById('exportButton').addEventListener('click', function (event) {
        var confirmed = confirm('Apakah Anda yakin ingin mengekspor data?');

        if (!confirmed) {
            event.preventDefault();
        }
    });

    $( '#dosen' ).select2( {
        theme: 'bootstrap-5'
    } );

    
</script>

@endsection