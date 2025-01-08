@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Pengajuan <br> Dosen Pembimbing Skripsi/Tugas Akhir</h2>
                @if(session('error'))
                <div class="alert alert-danger mb-3 col-md-8 mx-auto">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('saveDospem') }}">
                @csrf
                <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="nama_mahasiswa">Nama Lengkap</label>
                    <input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" type="text" placeholder="Masukkan nama lengkap" required="" value="{{ Auth::user()->name }}" readonly>
                 </div>
                 <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="nim">NIM</label>
                    <input class="form-control" id="nim" name="nim" type="string" required="" value="{{ $nim }}" readonly>
                 </div>
                 <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="jurusan">Program Studi</label>
                    <input class="form-control" id="jurusan" name="jurusan" type="string" required="" value="{{ $prodi}}" readonly>
                 </div>
                <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="topik">Topik </label>
                    <input class="form-control" id="topik" name="topik" type="string" value="{{ $topik }}" readonly>
                </div>
                <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="judul">Judul </label>
                    <input class="form-control" id="judul" name="judul" type="string" value="{{ $judul }}" readonly>
                </div>
                <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="nama_dosen">Dosen Pembimbing </label>
                    <select class="form-select" id="dp1_id" name="dp1_id">
                        <option value="" disabled selected>Pilih dosen pembimbing</option>
                        @foreach ($dospem as $id => $nama_dosen)
                            <option value="{{ $id }}">{{ $nama_dosen }}</option>
                        @endforeach
                    </select>
                </div>
                
                 <div class="mb-3 col-md-8 mx-auto">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('topik.mahasiswa') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>
            </div>
        </div>
	
	</div>
</div>	


@endsection