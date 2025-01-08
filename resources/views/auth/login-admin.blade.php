@extends('auth.navbar')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-5">

        <div class="card">

            {{-- <img src="{{ asset('image/logo.png') }}" alt="Logo FIK"> --}}
            <div class="mx-auto mt-5">
                <img src="{{ asset('storage/image/logo.png') }}" alt="Logo FIK" style="width: 250px">
            </div>

            <div class="card-title text-center mt-5 mb-3">
                <h4>SISTEM INFORMASI</h4>
                <h4>TUGAS AKHIR</h4>
            </div>
          
            <div class="card-body">
                <form action="{{ route('authenticateAdmin') }}" method="post">
                    @csrf

                    <h6 class="mb-3 col-md-8 mx-auto">Masuk untuk Prodi</h6>
            
                    <div class="mb-3 col-md-8 mx-auto">
                        <label for="email" class="">Email</label>
                        <input type="string" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                    </div>
                    <div class="mb-5 col-md-8 mx-auto">
                        <label for="password" class="">Password</label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                    </div>
                    <div class="mb-3 mx-auto">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Login">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection
