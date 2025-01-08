@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Pengajuan Topik Skripsi/Tugas Akhir</h1>
		<a href="{{ route('listTopik') }}" class="btn btn-outline-secondary">Lihat Daftar Topik</a>

		@if(isset($messageDataDiri))
    		<button	button class="btn btn-primary" disabled>Tambah Pengajuan Topik</button>
			{{-- belum mengisi data diri --}}
			<div class="alert alert-danger mt-4">
				{{ $messageDataDiri }}
			</div>	
		@else
			@if($isButtonDisabled)
				<button class="btn btn-primary" disabled>Tambah Pengajuan Topik</button>
			@elseif($isRekomendasiApproved)
				<a href="{{ route('addTopik') }}" class="btn btn-primary">Tambah Pengajuan Topik</a>
			@endif	

			{{-- @if($isButtonDisabled && !$isRekomendasiApproved)
				<button class="btn btn-primary" disabled>Tambah Pengajuan Topik</button>
			@else
				<a href="{{ route('addTopik') }}" class="btn btn-primary">Tambah Pengajuan Topik</a>
			@endif --}}

				@if(isset($message))
					<div class="alert alert-warning mt-4">
						{{ $message }}
					</div>
				@elseif($topik->isEmpty())
					<div class="alert alert-info mt-4">
						Anda belum melakukan pengajuan
					</div>
				@else 
					<div class="mt-5 overflow-scroll">
						<table class="table table-bordered table-hover">

								@if(session('success'))
									<div class="alert alert-success">
										{{ session('success') }}
									</div>
								@endif
									
								@php
									$counter = 1
								@endphp
								<tr>
									{{-- <th>No</th> --}}
									<th>Topik</th>
									<th>Judul</th>
									<th>Deskripsi Judul</th>
									<th>Status</th>
									<th>Keterangan</th>
								</tr>

								@if ($topik)
									@foreach($topik as $p)

									<tr>
										{{-- <td>{{ $counter++ }}</td> --}}
										<td>{{ $p->topik }}</td>
										<td>{{ $p->judul }}</td>
										<td>{{ $p->desc_judul }}</td>
										<td>

											@if($p->status === "Pending")
												<span class="badge text-bg-warning">Pending</span>
											@elseif($p->status ==="Disetujui")
												<span class="badge text-bg-success">Disetujui</span>
											@elseif($p->status === "Ditolak")
												<span class="badge text-bg-danger">Ditolak</span>
											@endif
										</td>
										<td>{{ $p->desc_status ?? '-' }}</td>
									</tr>
									@endforeach
								@else
									<tr>
										<td colspan="4">Belum ada pengajuan</td>
									</tr>
								@endif 	
						</table>		
					</div>
				@endif	
		@endif	
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