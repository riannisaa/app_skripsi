@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Pengajuan Dosen Pembimbing Skripsi/Tugas Akhir</h1>
        <div class="row mb-2 mt-4">
            <div class="col-md-6">
                <a href="{{ route('exportDospem') }}" id="exportButton" class="btn btn-outline-secondary">Export</a>             
            </div>
            
            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('dospem.search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama dosen..." name="search" value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                            <a href="{{ route('dospem.admin') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- <a href="{{ route('listDosen') }}" class="btn btn-outline-secondary">Lihat Daftar Dosen Pembimbing</a> --}}
				<div class="mt-2">
                    <div class="table-container" style="overflow-x: auto;">
					    <table class="table table-bordered table-hover">

                            {{-- dospem 2 penuh --}}
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                   
                            {{-- sukses input dospem 2 --}}
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
                                <th>Status</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th style="white-space: nowrap;">Program Studi</th>
                                <th style="white-space: nowrap;">Dosen Pembimbing 1</th>
								<th style="white-space: nowrap;">Dosen Pembimbing 2</th>
                                <th>Topik</th>
                                <th>Judul</th>
						
								<th>Keterangan</th>
							</tr>
							
                            @foreach($data as $d)

							<tr>
								<td>{{ $counter++ }}</td>
                                <td>
                                    @if($d->status === 'Pending')
                                        <span class="badge text-bg-warning">Pending</span>
                                    @elseif ($d->status === 'Disetujui')
                                        <span class="badge text-bg-success">Disetujui oleh Dosen Pembimbing 1</span>
                                    @elseif ($d->status === 'Ditolak')
                                        <span class="badge text-bg-danger">Ditolak oleh Dosen Pembimbing 1</span>
                                    @elseif ($d->status === 'Sah')
                                        <span class="badge text-bg-primary">Telah Disahkan oleh Ketua Program Studi</span>
                                    @elseif ($d->status === 'Tidak Sah')
                                        <span class="badge text-bg-danger">Tidak sah oleh Ketua Program Studi</span>
                                    @elseif ($d->status === 'Lulus')
                                        <span class="badge text-bg-secondary">Lulus</span>       
                                    @endif
                                </td>
                           
                                <td style="white-space: nowrap;" >{{ $d->nama_mahasiswa }}</td>
                                <td style="white-space: nowrap;"> {{ $d->nim }}</td>
                                <td style="white-space: nowrap;">{{ $d->prodi }}</td>
                                <td style="white-space: nowrap;">{{ $d->nama_dp1 }}</td>
                                <td style="white-space: nowrap;">{{ $d->nama_dp2 ?? '-' }}</td>

                                <td style="white-space: nowrap;">{{ $d->topik }}</td>
                                <td style="white-space: nowrap;">{{ $d->judul }}</td>
								<td>{{ $d->desc_status }}</td>
                            
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
</div> 


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Dosen Pembimbing 2</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            
                <form action="{{ route('dospem.inputDosen') }}" method="POST">
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
                            <label class="small mb-1" for="prodi">Program Studi</label>
                            <input class="form-control" id="prodi" name="prodi" type="string" readonly>
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
                            <label class="small mb-1" for="nama_dp1">Dosen Pembimbing 1</label>
                            <input class="form-control" id="nama_dp1" name="nama_dp1" readonly>
                        </div>
                        <div class="mb-3 col-md-10 mx-auto">
                            <label class="small mb-1" for="nama_dosen">Dosen Pembimbing </label>
                            <select class="form-select" id="dp2_id" name="dp2_id">
                                <option value="" disabled selected>Pilih dosen pembimbing</option>
                                @foreach ($dospem as $id => $nama_dosen)
                                    <option value="{{ $id }}">{{ $nama_dosen }}</option>
                                @endforeach
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
                // Get the data from the button's data attributes
                var nama_mahasiswa = $(this).data("nama_mahasiswa");
                var nim = $(this).data("nim");
                var prodi = $(this).data("prodi");
                var peminatan = $(this).data("peminatan");
                var topik = $(this).data("topik");
                var judul = $(this).data("judul");
                var nama_dp1 = $(this).data("nama_dp1");
                var nama_dp2 = $(this).data("nama_dp2");

                // var status = $(this).data("status");
                // var desc_status = $(this).data("desc_status");

                var recordId = $(this).data("id"); // Get the record ID

                // Populate the modal inputs with the retrieved data
                $("#nama_mahasiswa").val(nama_mahasiswa);
                $("#nim").val(nim);
                $("#prodi").val(prodi);
                $("#peminatan").val(peminatan);
                $("#topik").val(topik);
                $("#judul").val(judul);
                $("#nama_dp1").val(nama_dp1);
                $("#nama_dp2").val(nama_dp2);
                // $("#status").val(status);
                // $("#desc_status").val(desc_status);

                
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