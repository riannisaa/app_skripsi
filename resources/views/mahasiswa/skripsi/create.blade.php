@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Pendaftaran <br> Sidang Skripsi</h2>
                @if ($errors->any())
                <div class="alert alert-danger mb-3 col-md-10 mx-auto">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('berkas-skripsi.store') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id_pengajuan_dospem" value="{{ $dospem->id }}"/>

                    <div class="mb-3 col-md-10 mx-auto">
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-exclamation-circle text-normal"></i>
                            File diupload dengan format .pdf
                        </div>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_mahasiswa">Nama Lengkap</label>
                        <input class="form-control" disabled id="nama_mahasiswa" name="nama_mahasiswa" type="text" placeholder="Masukkan nama lengkap" required="" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nim">NIM</label>
                        <input class="form-control" disabled id="nim" name="nim" type="string" required="" value="{{ auth()->user()->nim_nip }}" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto ">
                        <label class="small mb-1" for="jurusan">Program Studi</label>
                        <input class="form-control" disabled id="jurusan" name="jurusan" type="string" required="" value="{{ $dospem->mahasiswa->prodi}}" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Judul </label>
                        <input class="form-control" disabled id="judul" name="judul" type="string" value="{{ $dospem->mahasiswa->topik->where('status', 'Disetujui')->first()->judul }}" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Dosen Pembimbing I</label>
                        <input class="form-control" disabled id="judul" name="judul" type="string" value="{{ $dospem->dospem1->nama_dosen }}" readonly>
                        
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Dosen Pembimbing II</label>
                        <input class="form-control" disabled id="judul" name="judul" type="string" value="{{ $dospem->dospem2->nama_dosen ?? '-' }}" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Pilih Tahun Ajaran </label>
                        <select class="form-select" id="dp1_id" name="tahun_ajaran">
                            <option value="" disabled selected>-- Pilih Tahun Ajaran --</option>
                            <option value="{{$tahunAjaran}}">{{$tahunAjaran}}</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Scan KTP, KK, Akta Lahir</label>
                        <input class="form-control" accept="application/pdf" name="ktp_kk_akta" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Pas Foto Ijazah (JPG, JPEG, PNG)</label>
                        <input class="form-control" accept=".jpg, .jpeg, .png" name="pas_foto" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Ijazah Terakhir</label>
                        <input class="form-control" accept="application/pdf" name="ijazah" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Buku Bimbingan (Min. 10x Pertemuan)</label>
                        <input class="form-control" accept="application/pdf" name="buku_bimbingan" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Hasil Turnitin (Maks. 25%)</label>
                        <input class="form-control" accept="application/pdf" name="turnitin" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Kartu Hasil Studi (KHS)</label>
                        <input class="form-control" accept="application/pdf" name="khs" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Kartu Studi Tetap (KST)</label>
                        <input class="form-control" accept="application/pdf" name="kst" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Print Out Pembayaran UKT</label>
                        <input class="form-control" accept="application/pdf" name="ukt" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload File Skripsi</label>
                        <input class="form-control" accept="application/pdf" name="file_dokumen" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Upload Video Presentasi</label>
                        <input class="form-control" accept="video/mp4,video/x-m4v,video/*" name="video" type="file">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('topik.mahasiswa') }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


@endsection