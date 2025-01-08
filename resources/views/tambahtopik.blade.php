@extends('auth.layouts')

@section('content')


<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Pengajuan <br> Topik Skripsi/Tugas Akhir</h2>
                @if(session('error'))
                <div class="alert alert-danger mb-3 col-md-8 mx-auto">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('simpantopik') }}">
                @csrf
                <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="nama_mahasiswa">Nama Lengkap</label>
                    <input class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" type="text" placeholder="Masukkan nama lengkap" required="" value="{{ Auth::user()->name }}" readonly>
                 </div>
                 <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="nim">NIM</label>
                    <input class="form-control" id="nim" name="nim" type="string" required="" value="{{ $nim }}" readonly>
                 </div>
                 <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="jurusan">Jurusan</label>
                    <input class="form-control" id="jurusan" name="jurusan" type="string" required="" value="{{ $jurusan }}" readonly>
                 </div>
                 <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="peminatan">Peminatan</label>
                    <input class="form-control" id="peminatan" name="peminatan" type="string" required="" value="{{ $peminatan }}" readonly>
                </div>
                <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="topik">Topik </label>
                    <select class="form-select" id="topik" name="topik">
                        <option value="" disabled selected>Pilih topik</option>
                    </select>
                </div>
                <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="judul">Judul </label>
                    <input class="form-control" id="judul" name="judul" type="string" required="" placeholder="Masukkan Judul Skripsi/TA">
                </div>
                <div class="mb-3 col-md-8 mx-auto">
                    <label class="small mb-1" for="desc_judul">Deskripsi Judul </label>
                    <textarea class="form-control" id="desc_judul" name="desc_judul" type="string" required="" placeholder="Masukkan Deskripsi Judul Skripsi/TA"></textarea>
                </div>
              
                 <div class="mb-3 col-md-8 mx-auto">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('tampiltopik') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>
            </div>
        </div>
	
	</div>
</div>	

<script>
    // Define an object to map Peminatan to Topik options
    const topikOptions = {
        'Software Developer': ['Pengembangan Aplikasi Manajemen Data Mahasiswa', 'Pengembangan Sistem Manajemen Inventaris', 'Pengembangan Aplikasi Kesehatan'],
        'Data Analyst': ['Analisis Data Bisnis untuk Pengambilan Keputusan', 'Analisis Data Keuangan', 'Analisis Data Lingkungan'],
        'IT Konsultan': ['Analisis Keamanan Informasi dan Manajemen Risiko', 'Penggunaan Keamanan Siber dalam Bisnis', 'Manajemen Layanan TI (IT Service Management)'],
        'Software Engineer': ['Pengembangan Framework atau Library', 'Pengembangan Permainan (Game) Digital', 'Manajemen Proyek Perangkat Lunak'],
        'Cloud Fullstack Operator': ['Optimisasi Biaya Infrastruktur Cloud', 'Penggunaan Kecerdasan Buatan dalam Otomatisasi Cloud', 'Pemulihan Bencana dan Manajemen Kontinuitas Bisnis'],
        'AI Engineering': ['Optimisasi Infrastruktur AI', 'Penggunaan AI untuk Optimisasi Infrastruktur', 'Pemantauan Perilaku Model AI'],
        'Web Developer': ['Pengembangan Aplikasi Web Berbasis E-commerce', 'Pengembangan Aplikasi Web untuk Manajemen Data', 'Pengembangan Aplikasi Web dengan Pemrosesan Data Real-time'],
        'Mobile Developer': ['Pengembangan Aplikasi Mobile Berbasis Android atau iOS', 'Pengembangan Aplikasi Mobile Berbasis Pembayaran atau E-commerce', 'Pengembangan Aplikasi Mobile Berbasis Kesehatan'],
        'BI Developer': ['Pengembangan Dashboard BI', 'Visualisasi Data Interaktif', 'Analisis Data dan Penemuan Wawasan Bisnis'],
    };

    // Function to update Topik options based on the selected Peminatan
    function updateTopikOptions() {
        const peminatanSelect = document.getElementById('peminatan');
        const topikSelect = document.getElementById('topik');
        const selectedPeminatan = peminatanSelect.value;

        // Clear existing options
        topikSelect.innerHTML = '<option value="" disabled selected>Pilih Topik</option>';

        // Populate Topik options based on the selected Peminatan
        if (selectedPeminatan in topikOptions) {
            topikOptions[selectedPeminatan].forEach((option) => {
                const optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.textContent = option;
                topikSelect.appendChild(optionElement);
            });
        }
    }

    // Add an event listener to the Peminatan select element
    document.getElementById('peminatan').addEventListener('change', updateTopikOptions);

    // Initial call to populate Topik options based on the default selected Peminatan
    updateTopikOptions();
</script>






@endsection