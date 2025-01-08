@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Pengajuan Topik Skripsi/Tugas Akhir</h1>
		@if(isset($messageDataDiri))
    	<button class="btn btn-primary" disabled>Tambah Pengajuan Topik</button>
			<div class="alert alert-danger mt-4">
				{{ $messageDataDiri }}
			</div>	
		@else
			<a href="{{ route('tambahtopik') }}" class="btn btn-primary">Tambah Pengajuan Topik</a>
			<div class="mt-5">
				<table class="table table-bordered table-hover">

					@if(isset($message))
						<div class="alert alert-info">
							{{ $message }}
						</div>	
					@else
						@if(session('success'))
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						@endif
						<!-- Display form submissions here -->
							
						@php
							$counter = 1
						@endphp
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>NIM</th>
							<th>Jurusan</th>
							<th>Peminatan</th>
							<th>Topik</th>
							<th>Judul</th>
							<th>Deskripsi Judul</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
						@foreach($topik as $p)

						<tr>
							<td>{{ $counter++ }}</td>
							<td>{{ $nama_mahasiswa}}</td>
							<td>{{ $nim }}</td>
							<td>{{ $jurusan }}</td>
							<td>{{ $peminatan }}</td>
							<td>{{ $p->topik }}</td>
							<td>{{ $p->judul }}</td>
							<td>{{ $p->desc_judul }}</td>
							<td>{{ $p->status }}</td>
							<td>
								@if($p->status === 'Pending')
									<button type="button" class="btn btn-primary btn-sm open-modal"
										data-id="{{ $p->id }}"
										data-nama_mahasiswa="{{ $nama_mahasiswa }}"
										data-nim="{{ $nim }}"
										data-jurusan="{{ $jurusan }}"
										data-peminatan="{{ $peminatan }}"
										data-topik="{{ $p->topik }}"
										data-judul="{{ $p->judul }}"
										data-desc_judul="{{ $p->desc_judul }}"
										data-status="{{ $p->status }}">
										Edit Status
									</button>
								@else
									<button type="button" class="btn btn-secondary btn-sm open-modal" disabled>
										Edit Status
									</button>
								@endif	
							</td>
						</tr>
						@endforeach
					@endif
				</table>
			</div>
		@endif	
	</div>
</div>	
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Approval Pengajuan Topik </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
			<form action="{{ route('updateStatus') }}" method="POST">
				@csrf
				@method('PUT')
				<input type="hidden" name="id" id="recordId">
				<div class="modal-body">
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="nama_mahasiswa">Nama Lengkap</label>
						<input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" type="text" readonly>
					</div>
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="nim">NIM</label>
						<input class="form-control" id="nim" name="nim" type="string" readonly>
					</div>
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="jurusan">Jurusan</label>
						<input class="form-control" id="jurusan" name="jurusan" type="string" readonly>
					</div>
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="peminatan">Peminatan</label>
						<input class="form-control" id="peminatan" name="peminatan" type="string" readonly>
					</div>
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="topik">Topik</label>
						<input class="form-control" id="topik" name="topik" type="string" readonly>
					</div>
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="judul">Judul </label>
						<input class="form-control" id="judul" name="judul" type="string" readonly>
					</div>
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="desc_judul">Deskripsi Judul </label>
						<textarea class="form-control" id="desc_judul" name="desc_judul" readonly></textarea>
					</div>
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="status">Status</label>
						<select class="form-select" id="status" name="status" required>
							<option value="Pending">Pending</option>
							<option value="Disetujui">Disetujui</option>
							<option value="Ditolak">Ditolak</option>
						</select>
					</div>
					<div class="mb-3 col-md-10 mx-auto">
						<label class="small mb-1" for="desc_status">Alasan </label>
						<textarea class="form-control" id="desc_status" name="desc_status"></textarea>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="saveChanges">Save changes</button>
				</div>
			</form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".open-modal").click(function () {
            // Get the data from the button's data attributes
            var nama_mahasiswa = $(this).data("nama_mahasiswa");
            var nim = $(this).data("nim");
            var jurusan = $(this).data("jurusan");
            var peminatan = $(this).data("peminatan");
            var topik = $(this).data("topik");
			var judul = $(this).data("judul");
            var desc_judul = $(this).data("desc_judul");
            var status = $(this).data("status");
            var recordId = $(this).data("id"); // Get the record ID

            // Populate the modal inputs with the retrieved data
            $("#nama_mahasiswa").val(nama_mahasiswa);
            $("#nim").val(nim);
            $("#jurusan").val(jurusan);
            $("#peminatan").val(peminatan);
            $("#topik").val(topik);
			$("#judul").val(judul);
            $("#desc_judul").val(desc_judul);

            $("#status").val(status);
            
            // Set the record ID in the hidden input field
            $("#recordId").val(recordId);

            // Open the modal
            $("#exampleModal").modal("show");
        });
    });

	console.log("recordId: " + recordId);
	console.log("status: " + $("#status").val());
</script>


@endsection