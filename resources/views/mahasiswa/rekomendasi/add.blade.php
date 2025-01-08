@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Pengajuan Rekomendasi <br> Dosen Pembimbing Akademik</h2>
            
                @if ($errors->any())
                <div class="alert alert-danger mb-3 col-md-10 mx-auto">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('saveRekomendasi') }}" enctype="multipart/form-data">
                @csrf
                <div class="alert alert-info col-md-10 mx-auto">
                    <p><i class="fa-solid fa-circle-info"></i> File diupload dengan format .pdf</p>
                </div>
                <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="nama_mahasiswa">Nama Lengkap</label>
                    <input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" type="text" placeholder="Masukkan nama lengkap" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="nim">NIM</label>
                    <input class="form-control" id="nim" name="nim" type="string" value="{{ $nim }}" readonly>
                 </div>
                 <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="jurusan">Program Studi</label>
                    <input class="form-control" id="jurusan" name="jurusan" type="string"  value="{{ $prodi }}" readonly>
                 </div>
                 <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="sks">Jumlah SKS Lulus</label>
                    <input class="form-control" id="sks" name="sks" type="number" required>
                 </div>
                 {{-- khs --}}
                 <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="khs_file">Upload KHS Terbaru <br>
        
                    </label>

                    <input class="form-control" id="khs_file" name="khs_file" type="file" required>
                 </div>
                 {{-- ukt  --}}
                 <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="ukt_question">Apakah Anda telah menyelesaikan administrasi keuangan hingga semester ini?</label>
                    <select id="ukt_question" name="ukt_question" class="form-control" required>
                        <option value="" disabled selected>-</option>
                        <option value="yes">Ya</option>
                        <option value="no">Tidak</option>
                    </select>                 
                </div>
                 <div class="mb-3 col-md-10 mx-auto" id="ukt_file_upload" style="display: none">
                    <label class="small mb-1" for="ukt_file">Upload Bukti Pembayaran UKT
                        
                    </label>
                    <input class="form-control" id="ukt_file" name="ukt_file" type="file" required>
                </div>
                {{-- pkm  --}}
                 <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="pkm_question">Apakah Anda telah upload PKM ke Simbelmawa?</label>
                    <select id="pkm_question" name="pkm_question" class="form-control" required>
                        <option value="" disabled selected>-</option>
                        <option value="yes">Ya</option>
                        <option value="no">Tidak</option>
                    </select>                 
                </div>
                 <div class="mb-3 col-md-10 mx-auto" id="pkm_file_upload" style="display: none">
                    <label class="small mb-1" for="pkm_file">Upload Bukti Submit PKM</label>
                    <input class="form-control" id="pkm_file" name="pkm_file" type="file" required>
                 </div>
                {{-- toefl  --}}
                 <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="toefl_question">Apakah Anda memiliki sertifikat TOEFL? <br>
                        <span style="color: grey;">Score >=450</span></label>
                    <select id="toefl_question" name="toefl_question" class="form-control" required>
                        <option value="" disabled selected>-</option>
                        <option value="yes">Ya</option>
                        <option value="no">Tidak</option>
                    </select>                 
                </div>
                <div class="mb-3 col-md-10 mx-auto" id="toefl_file_upload" style="display: none;" >
                    <label class="small mb-1" for="toefl_file">Upload Sertifikat TOEFL</label>
                    <input class="form-control" id="toefl_file" name="toefl_file" type="file" required>
                </div>
                {{-- seminar  --}}
                <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="seminar_question">Apakah Anda memiliki sertifikat seminar IT? <br>  
                        <span style="color: grey;">Minimal 5</span></label>
                    <select id="seminar_question" name="seminar_question" class="form-control" required>
                        <option value="" disabled selected>-</option>
                        <option value="yes">Ya</option>
                        <option value="no">Tidak</option>
                    </select>                 
                </div>
                <div class="mb-3 col-md-10 mx-auto" id="seminar_file_upload" style="display: none;">
                    <label class="small mb-1" for="seminar_file">Upload Sertifikat Seminar IT</label>
                    <input class="form-control" id="seminar_file" name="seminar_file" type="file" required>
                </div>
                {{-- profesi  --}}
                <div class="mb-3 col-md-10 mx-auto">
                    <label class="small mb-1" for="profesi_question">Apakah Anda memiliki sertifikat profesi IT? <br> 
                        <span style="color: grey;">Minimal skema dari LSP UPNVJ</span></label>
                    <select id="profesi_question" name="profesi_question" class="form-control" required>
                        <option value="" disabled selected>-</option>
                        <option value="yes">Ya</option>
                        <option value="no">Tidak</option>
                    </select>                 
                </div>
                <div class="mb-3 col-md-10 mx-auto" id="profesi_file_upload" style="display: none;">
                    <label class="small mb-1" for="profesi_file">Upload Sertifikat Profesi IT</label>
                    <input class="form-control" id="profesi_file" name="profesi_file" type="file" required>
                </div>
                <div class="mb-3 col-md-10 mx-auto">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('rekomendasi.mahasiswa') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
            </div>
        </div>
	
	</div>
</div>	

<script>

    function handleFileUploadSection(questionId, fileUploadId) {
        const question = document.getElementById(questionId);
        const fileUpload = document.getElementById(fileUploadId);
        const fileInput = document.querySelector(`#${fileUploadId} input[type="file"]`);

        question.addEventListener('change', function () {
            if (question.value === 'yes') {
                fileUpload.style.display = 'block';
                fileInput.required = true;
            } else {
                fileUpload.style.display = 'none';
                fileInput.required = false;
            }
        });
    }

    // Associate each question with its corresponding file upload section
    handleFileUploadSection('ukt_question', 'ukt_file_upload');
    handleFileUploadSection('pkm_question', 'pkm_file_upload');
    handleFileUploadSection('toefl_question', 'toefl_file_upload');
    handleFileUploadSection('seminar_question', 'seminar_file_upload');
    handleFileUploadSection('profesi_question', 'profesi_file_upload');

</script>


@endsection
