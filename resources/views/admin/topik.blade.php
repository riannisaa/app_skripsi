@extends('auth.layouts')

@section('content')

    
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <h1 class="mt-4 mb-4">Pengajuan Topik Skripsi/Tugas Akhir</h1>

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
                                <a href="{{ route('topik.admin') }}" class="btn btn-outline-secondary">Clear</a>
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
                                         

                                            <td style="white-space: nowrap;">{{ $d->nama_mahasiswa}}</td>
                                            <td style="white-space: nowrap;">{{ $d->nim }}</td>
                                            <td style="white-space: nowrap;">{{ $d->prodi }}</td>
                                            <td style="white-space: nowrap;">{{ $d->peminatan }}</td>
                                            <td style="white-space: nowrap;">{{ $d->topik }}</td>
                                            <td style="white-space: nowrap;">{{ $d->judul }}</td>
                                            <td style="white-space: nowrap;">
                                                {{ $d->desc_judul }}
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
    
@endsection