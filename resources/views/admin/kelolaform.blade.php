@extends('auth.layouts')

@section('content')
    <h2 class="">Kelola Formulir</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Pengajuan Rekomendasi Akademik</h5>
                    <form action="{{ route('status.rekom', ['formId' => 'rekom']) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status Form: {{ $respon_rekom ? 'Buka' : 'Tutup' }}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="1">Buka</option>
                                <option value="0">Tutup</option>
                            </select>    
                         </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Pengajuan Topik</h5>
                    <form action="{{ route('status.topik', ['formId' => 'topik']) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status Form: {{ $respon_topik ? 'Buka' : 'Tutup' }}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="1">Buka</option>
                                <option value="0">Tutup</option>
                            </select>    
                         </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Pengajuan Dosen Pembimbing</h5>
                    <form action="{{ route('status.dospem', ['formId' => 'dospem']) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status Form: {{ $respon_dospem ? 'Buka' : 'Tutup' }}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="1">Buka</option>
                                <option value="0">Tutup</option>
                            </select>    
                         </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Pendaftaran Sidang Proposal</h5>
                    <form action="{{ route('status.dospem', ['formId' => 'proposal']) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status Form: {{ $respon_proposal ? 'Buka' : 'Tutup' }}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="1">Buka</option>
                                <option value="0">Tutup</option>
                            </select>    
                         </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Pendaftaran Sidang Skripsi</h5>
                    <form action="{{ route('status.dospem', ['formId' => 'skripsi']) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status Form: {{ $respon_skripsi ? 'Buka' : 'Tutup' }}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="1">Buka</option>
                                <option value="0">Tutup</option>
                            </select>    
                         </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Penilaian Sidang Proposal</h5>
                    <form action="{{ route('status.dospem', ['formId' => 'nilai_proposal']) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status Form: {{ $respon_nilai_proposal ? 'Buka' : 'Tutup' }}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="1">Buka</option>
                                <option value="0">Tutup</option>
                            </select>    
                         </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Penilaian Sidang Skripsi</h5>
                    <form action="{{ route('status.dospem', ['formId' => 'nilai_skripsi']) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="status">Status Form: {{ $respon_nilai_skripsi ? 'Buka' : 'Tutup' }}</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="1">Buka</option>
                                <option value="0">Tutup</option>
                            </select>    
                         </div>
                        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <style>
        .form-check-input:disabled + .form-check-label {
            color: #6c757d; /* Color when disabled */
        }
    </style> --}}

{{-- <script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
    }

    $(document).ready(function() {
        $(".toggle-form").change(function() {
            var isChecked = $(this).prop("checked");
            $("#toggleLabel").text(isChecked ? "Form Dibuka" : "Form Ditutup");
        });
    });

    // document.getElementById('saveButton').addEventListener('click', function () {
    //     if (confirm('Apakah Anda yakin ingin menyimpan perubahan?')) {
    //         document.getElementById('yourFormId').submit();
    //     }
    // });






</script> --}}
@endsection
