@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Laporan <br> Sidang Proposal</h2>
                @if ($errors->any())
                <div class="alert alert-danger mb-3 col-md-10 mx-auto">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('hasil-proposal.store') }}">
                    @csrf
                    <input value="{{$proposal->id}}" name="id_jadwal_proposal" type="hidden"/>
                    <input value="{{$prodi}}" name="prodi" type="hidden"/>
                    <input value="{{ auth()->user()->dosen->id }}" name="id_dosen" type="hidden"/>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nim">Nama Lengkap</label>
                        <input class="form-control" disabled id="nim" readonly value="{{$proposal->berkasProposal->pengajuanDospem->mahasiswa->nama_mahasiswa}}">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nim">NIM</label>
                        <input class="form-control" disabled id="nim" readonly value="{{$proposal->berkasProposal->pengajuanDospem->mahasiswa->nim}}">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Program Studi</label>
                        <input class="form-control" disabled id="prodi" value="{{$prodi}}">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Judul</label>
                        <input class="form-control" disabled id="judul" value="{{$proposal->berkasProposal->pengajuanDospem->judul}}">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Status Dosen</label>
                        <input class="form-control" disabled id="judul" value="{{$status}}">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">I. Kesesuaian Judul Dengan Isi</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="kesesuaian" type="range" min="1" max="15" value="1" oninput="updateKesesuaian(this.value)">
                            <div class="fw-bold form-control w-25" id="kesesuaianValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">II. Kedalaman dan Keluasan Materi Sesuai Level Tugas Akhir</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="kedalaman" type="range" min="1" max="15" value="1" oninput="updateKedalaman(this.value)">
                            <div class="fw-bold form-control w-25" id="kedalamanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">III. Rumusan Masalah Didefinisikan Dengan Jelas</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="rumusan" type="range" min="1" max="20" value="1" oninput="updateRumusan(this.value)">
                            <div class="fw-bold form-control w-25" id="rumusanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">IV. Penguasaan Terhadap Studi Terkait Dan Teori Pendukung</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="penguasaan" type="range" min="1" max="20" value="1" oninput="updatePenguasaan(this.value)">
                            <div class="fw-bold form-control w-25" id="penguasaanValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">V. Kesesuaian Metode Yang Digunakan Untuk Menyelesaikan   Masalah</label>
                        <div class="d-flex gap-2">
                            <input class="form-control" step="0.01" name="metode" type="range" min="1" max="30" value="1" oninput="updateMetode(this.value)">
                            <div class="fw-bold form-control w-25" id="metodeValue">1</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Saran</label>
                        <textarea class="form-control" name="saran"></textarea>
                    </div>


                    <div class="mb-3 col-md-10 mx-auto">
                        <button type="submit" class="btn btn-primary" id="submit-button">Simpan</button>
                        <a href="{{ route('hasil-proposal.index', ['prodi'=>$prodi]) }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<script>
        function updateKesesuaian(value) {
            document.getElementById('kesesuaianValue').textContent = value;
        }

        function updateKedalaman(value) {
            document.getElementById('kedalamanValue').textContent = value;
        }

        function updateRumusan(value) {
            document.getElementById('rumusanValue').textContent = value;
        }

        function updatePenguasaan(value) {
            document.getElementById('penguasaanValue').textContent = value;
        }

        function updateMetode(value) {
            document.getElementById('metodeValue').textContent = value;
        }
    </script>
@endsection