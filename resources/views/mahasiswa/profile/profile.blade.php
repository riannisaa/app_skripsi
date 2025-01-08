@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    
    <div class="col-md-12">
        <h2>Profil Saya</h2>
        @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
        @endif
        <div class="card mb-4 mt-4">
            <div class="card-header">Data Akademik</div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="nama">Nama Lengkap</label>
                        <input class="form-control" id="nama" type="text" placeholder="Enter your username" value="{{ Auth::user()->name }} " readonly>
                    </div>
                   
                    <div class="mb-3">
                        <label class="small mb-1" for="nim">NIM</label>
                        <input class="form-control" id="nim" type="string" placeholder="Masukkan NIM" value="{{ $mahasiswa->nim }}"  readonly>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="jurusan">Jurusan</label>
                        <input class="form-control" id="jurusan" type="string" placeholder="Masukkan Jurusan" value="{{ $mahasiswa->prodi}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="dosenpa">Dosen Pembimbing Akademik</label>
                        <input class="form-control" id="dosenpa" type="string"  value="{{ $dosen->nama_dosen }}" readonly>
                    </div>   
                    <div class="mb-3">
                        <label class="small mb-1" for="peminatan">Peminatan</label>
                        <input class="form-control" id="peminatan" type="string" placeholder="Anda belum memasukkan peminatan" value="{{ $mahasiswa->peminatan }}" readonly>
                    </div>   
                    
                    @if(isset($mahasiswa->peminatan) )
                        <button href="{{ route('editprofile') }}" class="btn btn-primary" disabled>Input Peminatan</button>
                    @else
                        <a href="{{ route('editprofile') }}" class="btn btn-primary">Input Peminatan</a>
                    @endif    
                </form>
            </div>
          
        </div>
    </div>
</div> 

<div class="justify-content-center mt-2">
    <div class="col-md-12">
        <!-- Account details card-->
       

        <div class="card mb-4">
            <div class="card-header">Data Akun</div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Anda belum memasukkan email" value="{{  Auth::user()->email  }} " readonly>
                </div>
               
                <div class="mb-3">
                    <label class="small mb-1" for="inputPassword">Password</label>
                    <input class="form-control" id="inputPassword" type="password" value="*********" readonly>
                </div>  
                <a href="{{ route('editPassword') }}" class="btn btn-primary">Ubah Password</a>

            </div>
        </div>
    </div>
</div> 

   


@endsection