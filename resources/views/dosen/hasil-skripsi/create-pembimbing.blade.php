@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Laporan <br> Sidang Skripsi <br> Dosen Pembimbing</h2>
                @if ($errors->any())
                <div class="alert alert-danger mb-3 col-md-8 mx-auto">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('hasil-skripsi.store', ['status'=>'pembimbing']) }}">
                    @csrf
                    <input value="{{$jadwal->id}}" name="id_jadwal_skripsi" type="hidden"/>
                    <input value="{{$prodi}}" name="prodi" type="hidden"/>
                    <input value="{{ auth()->user()->dosen->id }}" name="id_dosen" type="hidden"/>
            
                    <div class="col-md-8 mx-auto">
                        <label class="small mb-1 fw-bold" for="nama_dosen">Sikap</label>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">I. Kedisiplinan selama pembimbingan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="kedisiplinan" type="range" min="1" max="10" value="1" oninput="updateKedisiplinan(this.value)">
                            <div class="fw-bold form-control w-25" id="kedisiplinanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">II. Kemauan berusaha</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="kemauan" type="range" min="1" max="10" value="1" oninput="updateKemauan(this.value)">
                            <div class="fw-bold form-control w-25" id="kemauanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">III. Kemandirian</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="kemandirian" type="range" min="1" max="10" value="1" oninput="updateKemandirian(this.value)">
                            <div class="fw-bold form-control w-25" id="kemandirianValue">1</div>
                        </div>
                    </div>


                    
                    <div class="col-md-8 mx-auto">
                        <label class="small mb-1 fw-bold" for="nama_dosen">Teknik Penulisan Tugas Akhir/Skripsi</label>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">IV. Penggunaan standarisasi format penulisan sesuai panduan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="standarisasi" type="range" min="1" max="10" value="1" oninput="updateStandarisasi(this.value)">
                            <div class="fw-bold form-control w-25" id="standarisasiValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">V. Keutuhan dan kelengkapan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="keutuhan" type="range" min="1" max="10" value="1" oninput="updateKeutuhan(this.value)">
                            <div class="fw-bold form-control w-25" id="keutuhanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">VI. Kerapihan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="kerapihan" type="range" min="1" max="10" value="1" oninput="updateKerapihan(this.value)">
                            <div class="fw-bold form-control w-25" id="kerapihanValue">1</div>
                        </div>
                    </div>
                    
                    <div class="col-md-8 mx-auto">
                        <label class="small mb-1 fw-bold" for="nama_dosen">Materi Tugas Akhir/Skripsi</label>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">VII. Kemampuan melakukan analisis pemasalahan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="analisis" type="range" min="1" max="10" value="1" oninput="updateAnalisis(this.value)">
                            <div class="fw-bold form-control w-25" id="analisisValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">VIII. Kemampuan memberikan solusi</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="solusi" type="range" min="1" max="10" value="1" oninput="updateSolusi(this.value)">
                            <div class="fw-bold form-control w-25" id="solusiValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">IX. Kemampuan melakukan kajian teoritis dan studi relevan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="kajian" type="range" min="1" max="10" value="1" oninput="updateKajian(this.value)">
                            <div class="fw-bold form-control w-25" id="kajianValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">X. Penguasaan pengetahuan pada bidang ilmunya</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="penguasaan" type="range" min="1" max="10" value="1" oninput="updatePenguasaan(this.value)">
                            <div class="fw-bold form-control w-25" id="penguasaanValue">1</div>
                        </div>
                    </div>


                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Pertanyaan Pokok</label>
                        <textarea class="form-control" name="pertanyaan_pokok"></textarea>
                    </div>

                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Saran</label>
                        <textarea class="form-control" name="saran"></textarea>
                    </div>


                    <div class="mb-3 col-md-8 mx-auto">
                        <button type="submit" class="btn btn-primary" id="submit-button">Simpan</button>
                        <a href="{{ route('hasil-proposal.index', ['prodi'=>$prodi]) }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<script>

    function updateKedisiplinan(value) { 
        document.getElementById('kedisiplinanValue').textContent = value;
    }

    function updateKemauan(value) {
        document.getElementById('kemauanValue').textContent = value;
    }

    function updateKemandirian(value) {
        document.getElementById('kemandirianValue').textContent = value;
    }

    function updateStandarisasi(value) {
        document.getElementById('standarisasiValue').textContent = value;
    }

    function updateKeutuhan(value) {
        document.getElementById('keutuhanValue').textContent = value;
    }

    function updateKerapihan(value) {
        document.getElementById('kerapihanValue').textContent = value;
    }

    function updateAnalisis(value) {
        document.getElementById('analisisValue').textContent = value;
    }

    function updateSolusi(value) {
        document.getElementById('solusiValue').textContent = value;
    }

    function updateKajian(value) {
        document.getElementById('kajianValue').textContent = value;
    }

    function updatePenguasaan(value) {
        document.getElementById('penguasaanValue').textContent = value;
    }


</script>
@endsection