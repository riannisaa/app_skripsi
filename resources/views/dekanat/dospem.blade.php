@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
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
                            <a href="{{ route('dospem.dekanat') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        {{-- <a href="{{ route('listDosen.kaprodi') }}" class="btn btn-outline-secondary">Lihat Daftar Dosen Pembimbing</a> --}}
				<div class="mt-3">
                    <div class="table-container" style="overflow-x: auto;">
					    <table class="table table-bordered table-hover">

                     			
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

@endsection