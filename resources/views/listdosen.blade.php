@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Daftar Dosen Pembimbing Skripsi/Tugas Akhir</h1>

        <div class="row mb-2 mt-4">
            <div class="col-md-6">
             
            </div>
            
            <div class="col-md-3 offset-md-3 text-md-end">
                <form action="{{ route('listDosen.search') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama dosen..." name="search" value="{{ $search ?? '' }}">
                        <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
                        @if ($search)
                            <a href="{{ route('listDosen') }}" class="btn btn-outline-secondary">Clear</a>
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
							<th>Nama</th>
							<th>NIP</th>
							<th>Topik</th>
							<th style="white-space: nowrap;">Kap. 1</th>
							<th style="white-space: nowrap;">Peserta 1</th>
                            <th style="white-space: nowrap;">Kap. 2</th>
							<th style="white-space: nowrap;">Peserta 2</th>
						</tr>
						@foreach($data as $p)

						<tr>
							<td>{{ $counter++ }}</td>
							<td>{{ $p->nama_dosen }}</td>
							<td>{{ $p->nip }}</td>
							<td style="white-space: nowrap;">
                                @foreach($p->topik as $topik)
                                    {{ $loop->iteration }}. {{ $topik->topik }} <br>
                                @endforeach
                            </td>                            
                            <td>{{ $p->kapasitas_dp1 }}</td>
							<td >{{ $p->peserta_dp1}}</td>
                            <td>{{ $p->kapasitas_dp2 }}</td>
							<td>{{ $p->peserta_dp2}}</td>
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