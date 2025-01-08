@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <!-- Account details card-->
        <h2>Masukkan Peminatan</h2>

        <div class="card mb-4">
            {{-- <div class="card-header">Account Details</div> --}}
            <div class="card-body">
                <form id='form-edit-profile' action="{{ route('editprofile') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif --}}

                    <div class="mb-3">
                        <label class="small mb-1" for="nama_mahasiswa">Nama Lengkap</label>
                        <input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" type="text" placeholder="Enter your username" value="{{ Auth::user()->name }} " readonly >
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="nim">NIM</label>
                        <input class="form-control" id="nim" name="nim" type="string" placeholder="Masukkan NIM" value="{{ $mahasiswa->nim ?? '' }}" readonly >
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="prodi">Program Studi</label>
                        <input class="form-control" id="prodi" name="prodi" type="string" placeholder="Masukkan NIM" value="{{ $mahasiswa->prodi ?? '' }}" readonly >
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="dosenpa">Dosen Pembimbing Akademik</label>
                        <input class="form-control" id="dosenpa" type="string"  value="{{ $dosen->nama_dosen }}" readonly>
                    </div>  
                    <div class="mb-3">
                        <label class="small mb-1" for="peminatan">Peminatan</label>
                        <select class="form-select" id="peminatan" name="peminatan" required>
                            <option value="" disabled selected>Pilih Peminatan</option>
                        </select>    
                     </div>                  
                    <!-- Save changes button-->
                </form>
                <button class="btn btn-primary" id="saveButton">Simpan</button>
                <a href="{{ route('profile.mahasiswa') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </div>
</div>

<script>
    const peminatanOptions = {
        'S1 Sistem Informasi': ['Software Developer', 'Data Analyst', 'IT Konsultan'],
        'S1 Informatika': ['Software Engineer', 'Cloud Fullstack Operator', 'AI Engineering'],
        'D3 Sistem Informasi': ['Web Developer', 'Mobile Developer', 'BI Developer'],
    };
    
    function updatePeminatanOptions() {
        const prodiInput = document.getElementById('prodi');
        const peminatanSelect = document.getElementById('peminatan');
        const selectedProdi = prodiInput.value;
    
        // Clear current peminatan options
        peminatanSelect.innerHTML = '';
    
        // Populate peminatan options based on the selected prodi
        if (selectedProdi in peminatanOptions) {
            const peminatanValues = peminatanOptions[selectedProdi];
            for (const peminatan of peminatanValues) {
                const option = document.createElement('option');
                option.value = peminatan;
                option.text = peminatan;
                peminatanSelect.appendChild(option);
            }
        }
    }
    
    // Add an event listener to the prodi input to update peminatan options
    document.getElementById('prodi').addEventListener('change', updatePeminatanOptions);
    
    // Initial call to set peminatan options based on the default prodi value
    updatePeminatanOptions();


    document.getElementById('saveButton').addEventListener('click', function() {
        // Display a confirmation dialog
        const isConfirmed = confirm('Apakah Anda yakin ingin menyimpan data peminatan?');
        if (isConfirmed) {
            document.getElementById('form-edit-profile').submit();
        }
    });
    </script>
    
@endsection