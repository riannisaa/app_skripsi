@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Pengajuan Dosen Pembimbing Skripsi/Tugas Akhir</h1>
        <a href="{{ route('listDosen') }}" class="btn btn-outline-secondary">Lihat Daftar Dosen Pembimbing</a>
        @if(isset($messageDataDiri))
    	    <button class="btn btn-primary" disabled>Tambah Pengajuan Dosen Pembimbing</button>
			{{-- belum mengisi data diri --}}
			<div class="alert alert-danger mt-4">
				{{ $messageDataDiri }}
			</div>	
		@else
			@if($isButtonDisabled)
    	        <button class="btn btn-primary" disabled>Tambah Pengajuan Dosen Pembimbing</button>
			@elseif($isTopikApproved)
				<a href="{{ route('addDospem') }}" class="btn btn-primary">Tambah Pengajuan Dosen Pembimbing</a>
			@endif

				@if (isset($message))
					<div class="alert alert-warning mt-4">
						{{ $message }}
					</div>
				@elseif($dospem->isEmpty())
					<div class="alert alert-info mt-4">
						Anda belum melakukan pengajuan
					</div>
				@else  

					<div class="mt-5 overflow-scroll">
						<table class="table table-bordered table-hover">

							@if(isset($message))
								<div class="alert alert-warning">
									{{ $message }}
								</div>	
							@else
								@if(session('success'))
									<div class="alert alert-success">
										{{ session('success') }}
									</div>
								@endif
									
								
								<tr>
									{{-- <th>No</th> --}}
									<th>Dosen Pembimbing 1</th>
									<th>Dosen Pembimbing 2</th>
									<th>Status</th>
									<th>Keterangan</th>
								</tr>
								
								@foreach($dospem as $d)

								<tr>
									{{-- <td>{{ $counter++ }}</td> --}}
									<td>{{ $d->nama_dp1 ?? '-' }}</td>
									<td>{{ $d->nama_dp2 ?? '-'}}</td>
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
									<td>{{ $d->desc_status ?? '-'}}</td>
								</tr>
								@endforeach
							@endif
						</table>		
					</div>
				@endif	
		@endif
    </div>
</div>   
@endsection