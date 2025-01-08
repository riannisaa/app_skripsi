@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Laporan <br> Sidang Skripsi <br> Dosen Penguji</h2>
                @if ($errors->any())
                <div class="alert alert-danger mb-3 col-md-8 mx-auto">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('hasil-skripsi.store', ['status'=>'penguji']) }}">
                    @csrf
                    <input value="{{$jadwal->id}}" name="id_jadwal_skripsi" type="hidden"/>
                    <input value="{{$prodi}}" name="prodi" type="hidden"/>
                    <input value="{{ auth()->user()->dosen->id }}" name="id_dosen" type="hidden"/>

                    <div class="col-md-8 mx-auto">
                        <label class="small mb-1 fw-bold" for="nama_dosen">Presentasi/Penyajian</label>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">I. Penggunaan sarana & efisiensi alokasi waktu yang digunakan </label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="sarana" type="range" min="1" max="6" value="1" oninput="updateSarana(this.value)">
                            <div class="fw-bold form-control w-25" id="saranaValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">II. Tingkat kemampuan menjelaskan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="menjelaskan" type="range" min="1" max="9" value="1" oninput="updateMenjelaskan(this.value)">
                            <div class="fw-bold form-control w-25" id="menjelaskanValue">1</div>
                        </div>
                    </div>

                    
                    <div class="col-md-8 mt-3 mx-auto">
                        <label class="small mb-1 fw-bold" for="nama_dosen">Teknik Penulisan Tugas Akhir/Skripsi</label>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">III. Penggunaan standarisasi format penulisan sesuai panduan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="standarisasi" type="range" min="1" max="9" value="1" oninput="updateStandarisasi(this.value)">
                            <div class="fw-bold form-control w-25" id="standarisasiValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">IV. Keutuhan dan kelengkapan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="keutuhan" type="range" min="1" max="8" value="1" oninput="updateKeutuhan(this.value)">
                            <div class="fw-bold form-control w-25" id="keutuhanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">V. Kerapihan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="kerapihan" type="range" min="1" max="8" value="1" oninput="updateKerapihan(this.value)">
                            <div class="fw-bold form-control w-25" id="kerapihanValue">1</div>
                        </div>
                    </div>

                    <div class="col-md-8 mt-3 mx-auto">
                        <label class="small mb-1 fw-bold" for="nama_dosen">Materi Tugas Akhir/Skripsi</label>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">VI. Tingkat pemahaman terhadap pokok permasalahan</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="pemahaman" type="range" min="1" max="12" value="1" oninput="updatePemahaman(this.value)">
                            <div class="fw-bold form-control w-25" id="pemahamanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">VII.Tingkat pendekatan penyelesaian masalah</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="pendekatan" type="range" min="1" max="24" value="1" oninput="updatePendekatan(this.value)">
                            <div class="fw-bold form-control w-25" id="pendekatanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">VIII. Kemampuan menjelaskan/menjawab pertanyaan dengan benar sesuai prinsip</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="menjawab" type="range" min="1" max="24" value="1" oninput="updateMenjawab(this.value)">
                            <div class="fw-bold form-control w-25" id="menjawabValue">1</div>
                        </div>
                    </div>

                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Pertanyaan Pokok</label>
                        <textarea class="form-control" name="pertanyaan_pokok"></textarea>
                    </div>

                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Kesimpulan dan Saran</label>
                        <textarea class="form-control" name="saran"></textarea>
                    </div>


                    <div class="mb-3 col-md-8 mx-auto">
                        <button type="submit" class="btn btn-primary" id="submit-button">Simpan</button>
                        <a href="{{ route('hasil-skripsi.index', ['prodi'=>$prodi]) }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<script>
        function updateSarana(value) {
            document.getElementById('saranaValue').textContent = value;
        }

        function updateMenjelaskan(value) {
            document.getElementById('menjelaskanValue').textContent = value;
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

        function updatePemahaman(value) {
            document.getElementById('pemahamanValue').textContent = value;
        }

        function updatePendekatan(value) {
            document.getElementById('pendekatanValue').textContent = value;
        }

        function updateMenjawab(value) {
            document.getElementById('menjawabValue').textContent = value;
        }


    </script>
@endsection