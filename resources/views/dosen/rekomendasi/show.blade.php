@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Pengajuan Rekomendasi Dosen Pembimbing Akademik</h1>

        <div class="row mb-2 mt-4">
            <div class="col-md-6">
                <a href="{{ route('exportRekomendasiDosen') }}" class="btn btn-outline-secondary">Export</a>

            </div>
            
            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('rekomendasiDosen.search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama/NIM..." name="search" value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                            <a href="{{ route('rekomendasi.dosen') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-3">
            <div class="table-container" style="overflow-x: auto;">
                <table class="table table-bordered table-hover">

                    @if($rekomendasi->isEmpty())
                        <div class="alert alert-info mt-2">
                            Belum ada pengajuan rekomendasi akademik dari mahasiswa
                        </div>
                    @else    
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif 

            
                            
                        @php
                            $counter = $rekomendasi->firstItem();
                        @endphp
                        <tr>
                            <th>No</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th style="white-space: nowrap;">Tanggal</th>
                            <th style="white-space: nowrap;">Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th style="white-space: nowrap;">Jumlah SKS</th>
                            <th style="white-space: nowrap;">KHS</th>
                            <th style="white-space: nowrap;">Upload PKM</th>
                            <th style="white-space: nowrap;">Pembayaran UKT</th>
                            <th style="white-space: nowrap;">TOEFL</th>
                            <th style="white-space: nowrap;">Sertifikat Profesi</th>
                            <th style="white-space: nowrap;">Sertifikat Seminar</th>
                            <th>Keterangan</th>
                        </tr>

                        @foreach($rekomendasi as $p)

                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $p->status }}</td>
                            <td style="white-space: nowrap;">
                                @if($p->status === 'Pending')
                                    <button type="button" class="btn btn-primary btn-sm open-modal"
                                    data-id="{{ $p->id }}"
                                    data-nama_mahasiswa="{{ $p ->nama_mahasiswa }}"
                                    data-nim="{{ $p ->nim }}"
                                    data-status="{{ $p->status }}">
                                    
                                        Edit Status
                                    </button>
                                @else
                                    <button type="button" class="btn btn-secondary btn-sm open-modal" disabled>
                                        Edit Status
                                    </button>
                                @endif	    
                            </td>


                            <td style="white-space: nowrap;">{{ $p->tanggal_pengajuan }}</td>
                            <td style="white-space: nowrap;">{{ $p->nama_mahasiswa }}</td>
                            <td>{{ $p->nim }}</td>
                            <td>{{ $p->sks }}</td>
                            <td>
                                <a href="{{ Storage::url($p->khs_file) }}" target="_blank" style="text-decoration: none;">View</a>
                            </td>
                            <td>
                                @if($p->pkm_file)
                                    <a href="{{ Storage::url($p->pkm_file) }}" target="_blank" style="text-decoration: none;">View</a>
                                @else
                                    -
                                @endif        
                            </td>
                            <td>
                                @if($p->ukt_file)
                                    <a href="{{ Storage::url($p->ukt_file) }}" target="_blank" style="text-decoration: none;">View</a>
                                @else
                                    -
                                @endif 
                            </td>
                            <td>
                                @if($p->toefl_file)
                                    <a href="{{ Storage::url($p->toefl_file) }}" target="_blank" style="text-decoration: none;">View</a>
                                @else
                                    -
                                @endif 
                            </td>
                            <td>
                                @if($p->profesi_file)
                                    <a href="{{ Storage::url($p->profesi_file) }}" target="_blank" style="text-decoration: none;">View</a>
                                @else
                                    -
                                @endif 
                            </td>
                            <td>
                                @if($p->seminar_file)
                                    <a href="{{ Storage::url($p->seminar_file) }}" target="_blank" style="text-decoration: none;">View</a>
                                @else
                                    -
                                @endif 
                            </td>
                          
                            <td>{{ $p->ket }}</td>
                     
                        </tr>
                        @endforeach
                    @endif    
                </table>

                @if ($rekomendasi)
                    <div class="pagination">
                        {{ $rekomendasi->links('custom_pagination') }}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Approval Pengajuan Rekomendasi Akademik </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('rekomendasi.updateStatus') }}" method="POST">
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
                            <label class="small mb-1" for="status">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Pending">Pending</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-10 mx-auto">
                            <label class="small mb-1" for="ket">Keterangan</label>
                            <textarea class="form-control" id="ket" name="ket" required></textarea>
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
                var status = $(this).data("status");
                var recordId = $(this).data("id"); // Get the record ID

                // Populate the modal inputs with the retrieved data
                $("#nama_mahasiswa").val(nama_mahasiswa);
                $("#nim").val(nim);
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