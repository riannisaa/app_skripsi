@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5 mx-0">
    <div class="col-md-5">

        <div class="card">

            {{-- <img src="{{ asset('image/logo.png') }}" alt="Logo FIK"> --}}
            <div class="mx-auto mt-5">
                <img src="{{ asset('/img/logo.png') }}" alt="Logo FIK" style="width: 250px">

            </div>

            <div class="card-title text-center mt-5 mb-3">
                <h4>SISTEM INFORMASI</h4>
                <h4>TUGAS AKHIR</h4>
            </div>
          
            <div class="card-body">
                <form action="{{ route('authenticate') }}" method="post">
                    @csrf

                    <h6 class="mb-3 col-md-8 mx-auto">Masuk ke Akunmu</h6>
            
                    <div class="mb-3 col-md-8 mx-auto">
                        <label for="nim_nip" class="">NIM/NIP</label>
                        <input type="string" class="form-control @error('nim_nip') is-invalid @enderror" id="nim_nip" name="nim_nip" value="{{ old('nim_nip') }}">
                            @if ($errors->has('nim_nip'))
                                <span class="text-danger">{{ $errors->first('nim_nip') }}</span>
                            @endif
                    </div>
                    <div class="mb-5 col-md-8 mx-auto">
                        <label for="password" class="">Password</label>
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn" value="Login" style="background-color: #FF5733; color:white">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection
