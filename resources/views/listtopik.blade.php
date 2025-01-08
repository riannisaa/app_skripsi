@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Daftar Topik Skripsi/Tugas Akhir</h1>

		<div class="row mb-2 mt-4">
            <div class="col-md-6">
             
            </div>
            
            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('listTopik.search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari peminatan/topik..." name="search" value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                            <a href="{{ route('listTopik') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>


		
			<div class="mt-3">
				<table class="table table-bordered table-hover">
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
                                    {{-- {{ $loop->iteration }}. {{ $supervisor->nama_dosen }} <br> --}}
									• {{ $supervisor->nama_dosen }} <br>

                                @endforeach
                            </td>
							<td>{{ $p->kapasitas}}</td>
							<td>{{ $p->peserta }}</td>							
						</tr>

						@endforeach
				</table>

                <div class="pagination">
                    {{ $data->links('custom_pagination') }}
                </div>
                           
			</div>
	</div>
</div>	

@endsection