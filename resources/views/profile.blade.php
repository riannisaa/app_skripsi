@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">

    <div class="col-md-12">
        <h2>Profil Saya</h2>
        @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
        @endif
        <div class="card mb-4 mt-4">
            <div class="card-body">
                {{-- <div class="mb-3">
                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="{{  Auth::user()->email  }} " readonly>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="nama">Nama Lengkap</label>
                    <input class="form-control" id="nama" type="text" placeholder="Enter your username" value="{{ Auth::user()->name }} " readonly>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="nip">NIP</label>
                    <input class="form-control" id="nip"  value="{{ $dosen->nip }}" readonly>
                </div> --}}
                <div class="mb-3">
                    <label class="small mb-1" for="role">Role</label>
                    <input class="form-control" id="role"  value="{{ Auth::user()->role }}" readonly>
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

</div>
@endsection