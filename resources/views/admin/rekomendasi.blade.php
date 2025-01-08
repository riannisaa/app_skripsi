@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Pengajuan Rekomendasi Dosen Pembimbing Akademik</h1>

        <div class="row mb-2 mt-4">
            <div class="col-md-6">
                <a href="{{ route('exportRekomendasi') }}" id="exportButton" class="btn btn-outline-secondary">Export</a>

            </div>
            
            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('rekomendasi.search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama/NIM/prodi..." name="search" value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                            <a href="{{ route('rekomendasi.admin') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>


        <div class="mt-2">
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
                            <th style="white-space: nowrap;">Tanggal</th>
                            <th style="white-space: nowrap;">Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th style="white-space: nowrap;">Dosen PA</th>
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
                            <td>
                                @if($p->status === "Pending")
                                    <span class="badge text-bg-warning">Pending</span>
                                @elseif($p->status ==="Disetujui")
                                    <span class="badge text-bg-success">Disetujui</span>
                                @elseif($p->status === "Ditolak")
                                    <span class="badge text-bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td style="white-space: nowrap;">{{ $p->tanggal_pengajuan }}</td>
                            <td style="white-space: nowrap;">{{ $p->nama_mahasiswa }}</td>
                            <td>{{ $p->nim }}</td>
                            <td style="white-space: nowrap;">{{ $p->prodi }}</td>
                            <td style="white-space: nowrap;">{{ $p->nama_dosen }}</td>

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

<script>

    document.getElementById('exportButton').addEventListener('click', function (event) {
            var confirmed = confirm('Apakah Anda yakin ingin mengekspor data?');

            if (!confirmed) {
                event.preventDefault();
            }
        });

</script>






@endsection