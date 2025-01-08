@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <!-- Account details card-->
        <h2>Profil Saya</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="small mb-1" for="nama">Nama Lengkap</label>
                        <input class="form-control" id="nama" type="text" placeholder="Enter your username" value="{{ Auth::user()->name }} " readonly>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                        <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="{{  Auth::user()->email  }} " readonly>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="role">Role</label>
                        <input class="form-control" id="role" type="text" value="{{  Auth::user()->role  }} " readonly>
                    </div>               
                    {{-- <a href="{{ route('editprofile') }}" class="btn btn-primary">Edit Profile</a> --}}
                </form>
            </div>
        </div>
    </div>
</div> 

</div>
@endsection