@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    
    <div class="col-md-8">
        <h2>Ubah Password</h2>
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <form method="POST" action="{{ route('updatePassword') }}">
                    @csrf
                    @method('PUT')

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- <div class="mb-3">
                        <label class="small mb-1" for="email">Email</label>
                        <input class="form-control" id="email" name="email" type="email" value="{{  Auth::user()->email  }} " readonly>
                    </div> --}}
                    <div class="mb-3">
                        <label class="small mb-1" for="current_password">Password Lama</label>
                        <input class="form-control" id="current_password" name="current_password" type="password" placeholder="Masukkan password saat ini" required>
                    </div>  
                    <div class="mb-3">
                        <label class="small mb-1" for="new_password">Password Baru</label>
                        <input class="form-control" id="new_password" name="new_password" type="password" placeholder="Masukkan password baru" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-secondary" id="goBack">Batal</button>
                </form>

            </div>
          
        </div>
    </div>
</div> 

<script>
    // JavaScript to go back to the previous page
    document.getElementById('goBack').addEventListener('click', function() {
        window.history.back();
    });
    </script>

@endsection