@extends('auth.layouts')

@section('content')

    
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <h1 class="mt-4 mb-4">Pengajuan Topik Skripsi/Tugas Akhir</h1>

            {{-- <a href="{{ route('listTopik.kaprodi') }}" class="btn btn-outline-primary">Lihat Daftar Topik</a> --}}
            
            <div class="row mb-2 mt-4">
                <div class="col-md-6">
                    <a href="{{ route('exportTopik') }}" class="btn btn-outline-secondary">Export</a>

                </div>
                
                <div class="col-md-3 offset-md-3 text-md-end">
                    <form action="{{ route('topik.search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari nama/NIM/prodi..." name="search" value="{{ $search ?? '' }}">
                            <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                            @if ($search)
                                <a href="{{ route('topik.kaprodi') }}" class="btn btn-outline-secondary">Clear</a>
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
                            @php
                                $counter = $data->firstItem();
                            @endphp

                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Nama</th>
                                    <th>NIM</th>
                                    <th>Prodi</th>
                                    <th>Peminatan</th>
                                    <th>Topik</th>
                                    <th>Judul</th>
                                    <th style="white-space: nowrap;">Deskripsi Judul</th>
                                    <th style="white-space: nowrap;">Keterangan</th>
                                   
                                </tr>
                                
                                    @foreach($data as $d)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>
                                                @if($d->status === "Pending")
                                                <span class="badge text-bg-warning">Pending</span>
                                                @elseif($d->status ==="Disetujui")
                                                    <span class="badge text-bg-success">Disetujui</span>
                                                @elseif($d->status === "Ditolak")
                                                    <span class="badge text-bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td style="white-space: nowrap;">
                                                @if($d->status === 'Pending')
                                                    <button type="button" class="btn btn-sm btn-primary open-modal" 
                                                        data-id="{{ $d->pengajuan_id }}"
                                                        data-nama_mahasiswa="{{ $d ->nama_mahasiswa }}"
                                                        data-nim="{{ $d ->nim }}"
                                                        data-prodi="{{ $d ->prodi }}"
                                                        data-peminatan="{{ $d ->peminatan }}"
                                                        data-topik="{{ $d->topik }}"
                                                        data-judul="{{ $d->judul }}"
                                                        data-desc_judul="{{ $d->desc_judul }}"
                                                        data-status="{{ $d->status }}">
                                                        Edit Status
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                        Edit Status
                                                    </button>
                                                @endif	
                                            </td>

                                            <td style="white-space: nowrap;">{{ $d->nama_mahasiswa}}</td>
                                            <td style="white-space: nowrap;">{{ $d->nim }}</td>
                                            <td style="white-space: nowrap;">{{ $d->prodi }}</td>
                                            <td style="white-space: nowrap;">{{ $d->peminatan }}</td>
                                            <td style="white-space: nowrap;">{{ $d->topik }}</td>
                                            <td style="white-space: nowrap;">
                                                {{ $d->judul }}</td>
                                            {{-- <td style="white-space: nowrap; max-width: 250px; overflow: hidden; text-overflow: ellipsis;">    
                                                {{ $d->desc_judul }}
                                            </td> --}}

                                            <td style="white-space: nowrap; max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                                <span class="expandable-content" data-full-content="{{ $d->desc_judul }}">
                                                    {{ $d->desc_judul }}
                                                </span>
                                            </td>

                                            
                                            
                                            
                                                                        
                                            <td>{{ $d->desc_status }}</td>
                                      
                                        </tr>
                                    @endforeach
                            
                        </table>

                        <div class="pagination">
                            {{ $data->links('custom_pagination') }}
                        </div>
                    </div>    
                </div>
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
                    <input type="hidden" name="id" id="id">
        
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
                            <textarea class="form-control" id="desc_status" name="desc_status" required></textarea>
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
                var desc_judul = $(this).data("desc_judul");
                var status = $(this).data("status");
                var id = $(this).data("id"); // Get the record ID

                // Populate the modal inputs with the retrieved data
                $("#nama_mahasiswa").val(nama_mahasiswa);
                $("#nim").val(nim);
                $("#prodi").val(prodi);
                $("#peminatan").val(peminatan);
                $("#topik").val(topik);
                $("#judul").val(judul);
                $("#desc_judul").val(desc_judul);

                $("#status").val(status);
                
                // Set the record ID in the hidden input field
                $("#id").val(id);

                // Open the modal
                $("#exampleModal").modal("show");

                console.log("id: " + id);
                console.log("status: " + $("#status").val());
            });

            $(".expandable-content").click(function() {
                var fullContent = $(this).data("full-content");
                alert(fullContent);
            });
        });
    </script>
@endsection