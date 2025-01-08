@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Daftar Dosen Pembimbing Skripsi/Tugas Akhir</h1>
		{{-- <a href="" class="btn btn-primary">Tambah Dosen Pembimbing</a> --}}

        <div class="row mb-2 mt-4">
            <div class="col-md-6">
                <a href="{{ route('exportListDospem') }}" id="exportButton" class="btn btn-outline-secondary">Export</a>             
            </div>
            
            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('listDosen.search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama dosen..." name="search" value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                            <a href="{{ route('listDosen.kaprodi') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

			<div class="mt-3">
				<table class="table table-bordered table-hover">
					@if(session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif
						@php
                            $counter = $data->firstItem();	
                            // $counter = 1;						
					
                        @endphp
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>NIP</th>
							{{-- <th>Bidang Keahlian</th> --}}
                            <th>Topik</th>
							<th style="white-space: nowrap;">Kap. 1</th>
							<th style="white-space: nowrap;">Peserta 1</th>
                            <th style="white-space: nowrap;">Kap. 2</th>
							<th style="white-space: nowrap;">Peserta 2</th>
							<th>Action</th>
						</tr>
						@foreach($data as $p)

						<tr>
							<td>{{ $counter++ }}</td>
							<td>{{ $p->nama_dosen }}</td>
							<td>{{ $p->nip }}</td>
							{{-- <td>{{ $p->keahlian }}</td> --}}
                            <td style="white-space: nowrap;">
                                @foreach($p->topik as $topik)
                                    {{ $loop->iteration }}. {{ $topik->topik }} <br>
                                @endforeach
                            </td>
                            <td>{{ $p->kapasitas_dp1 }}</td>
							<td >{{ $p->peserta_dp1}}</td>
                            <td>{{ $p->kapasitas_dp2 }}</td>
							<td>{{ $p->peserta_dp2}}</td>
							<td style="white-space: nowrap;">
								<button class="btn btn-sm btn-primary open-modal"
								data-id="{{ $p->id }}"
								data-nama_dosen="{{ $p->nama_dosen }}"
								data-nip="{{ $p ->nip }}"
								data-keahlian="{{ $p->keahlian }}"
								data-kapasitas_dp1="{{ $p ->kapasitas_dp1 }}"
								data-peserta_dp1="{{ $p->peserta_dp1 }}"
								data-kapasitas_dp2="{{ $p ->kapasitas_dp2 }}"
								data-peserta_dp2="{{ $p->peserta_dp2 }}">
								Edit</button>
							{{-- <button class="btn btn-sm btn-danger">Delete</button> --}}
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

{{-- modal  --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Topik </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateDospem') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="recordId">
                <div class="modal-body">
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Nama Dosen </label>
                        <input class="form-control" id="nama_dosen" name="nama_dosen" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="kapasitas_dp1">Kapasitas Pembimbing 1 </label>
                        <input class="form-control" id="kapasitas_dp1" name="kapasitas_dp1" type="number" required>
                    </div>
					<div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="kapasitas_dp2">Kapasitas Pembimbing 2</label>
                        <input class="form-control" id="kapasitas_dp2" name="kapasitas_dp2" type="number" required>
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
            // Get the data from the button's data attributes
            var nama_dosen = $(this).data("nama_dosen");
            var nip = $(this).data("nip");
            var keahlian = $(this).data("keahlian");
            var kapasitas_dp1 = $(this).data("kapasitas_dp1");
            var peserta_dp1 = $(this).data("peserta_dp1");
			var kapasitas_dp2 = $(this).data("kapasitas_dp2");
            var peserta_dp2 = $(this).data("peserta_dp2");
            var recordId = $(this).data("id"); // Get the record ID

            // Populate the modal inputs with the retrieved data
            $("#nama_dosen").val(nama_dosen);
            $("#nip").val(nip);
            $("#keahlian").val(keahlian);
            $("#kapasitas_dp1").val(kapasitas_dp1);
            $("#peserta_dp1").val(peserta_dp1);
			$("#kapasitas_dp2").val(kapasitas_dp2);
            $("#peserta_dp2").val(peserta_dp2);
            
            // Set the record ID in the hidden input field
            $("#recordId").val(recordId);

            // Open the modal
            $("#exampleModal").modal("show");
        });
    });

    console.log("recordId: " + recordId);
    console.log("status: " + $("#status").val());

    document.getElementById('exportButton').addEventListener('click', function (event) {
        var confirmed = confirm('Apakah Anda yakin ingin mengekspor data?');

        if (!confirmed) {
            event.preventDefault();
        }
    });
</script>


@endsection