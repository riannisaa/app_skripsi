@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
  
                <h2 class="mt-4 mb-4 text-center">Edit Data <br> Pengajuan Dosen Pembimbing</h2>
                {{-- @if(session('error'))
                <div class="alert alert-danger mb-3 col-md-8 mx-auto">
                    {{ session('error') }}
                </div>
                @endif --}}

                <form method="POST" action="{{ route('updateDosenPembimbing') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="nama_mahasiswa">Nama Lengkap</label>
                            <input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" type="text" value="{{ $data->nama_mahasiswa }}" readonly>
                        </div>
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="nim">NIM</label>
                            <input class="form-control" id="nim" name="nim" type="string" value="{{ $data->nim }}" readonly>
                        </div>
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="prodi">Program Studi</label>
                            <input class="form-control" id="prodi" name="prodi" type="string" value="{{ $data->prodi }}" readonly>
                        </div>
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="topik">Topik</label>
                            <input class="form-control" id="topik" name="topik" type="string" value="{{ $data->topik }}" readonly>
                        </div>
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="judul">Judul </label>
                            <input class="form-control" id="judul" name="judul" type="string" value="{{ $data->judul }}" readonly>
                        </div>
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="dp1_id">Dosen Pembimbing 1</label>
                            <input class="form-control" id="dp1_id" name="dp1_id" type="string" value="{{ $data->nama_dp1 }}" readonly>
                        </div>
                        @if($data->prodi !== 'D3 Sistem Informasi')
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="dp2_id">Dosen Pembimbing 2</label>
                            <select class="form-select" id="dp2_id" name="dp2_id" >
                                <option value="" disabled selected>Pilih dosen pembimbing</option>
                                @foreach ($dospem as $id => $nama_dosen)
                                    <option value="{{ $id }}">{{ $nama_dosen }}</option>
                                @endforeach
                            </select>                         
                        </div>
                        @else
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="dp1_id">Dosen Pembimbing 2</label>
                            <input class="form-control" disabled value="Tidak ada pembimbing 2">
                        </div>
                        @endif
                        <div class="mb-3 col-md-8 mx-auto">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('dospem.kaprodi') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	
	</div>
</div>	

@endsection