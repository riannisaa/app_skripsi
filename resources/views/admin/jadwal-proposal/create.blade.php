@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Buat Jadwal <br> Sidang Proposal</h2>
                @if ($errors->any())
                <div class="alert alert-danger mb-3 col-md-8 mx-auto">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('jadwal-proposal.store') }}">
                    @csrf
                    <input type="hidden" name="prodi" value="{{$prodi}}"/>
                    <div class="mb-3 col-md-8 mx-auto ">
                        <label class="small mb-1" for="nama">Pilih Mahasiswa</label>
                        <select class="form-select" name="berkas" id="mahasiswa">
                            <option value="" disabled selected>-- Pilih Mahasiswa--</option>
                            @foreach($berkas as $b)
                            <option value="{{$b->pengajuanDospem->id}}-{{$b->id}}">{{ $b->pengajuanDospem->mahasiswa->nama_mahasiswa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nim">NIM</label>
                        <input class="form-control" disabled id="nim" readonly>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Program Studi</label>
                        <input class="form-control" disabled id="prodi">
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Dosen Pembimbing I</label>
                        <input class="form-control" disabled id="dospem1">
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Dosen Pembimbing II</label>
                        <input class="form-control" disabled id="dospem2">
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Topik</label>
                        <input class="form-control" disabled id="topik">
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Judul</label>
                        <input class="form-control" disabled id="judul">
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="judul">Pilih Tanggal</label>
                        <input class="form-control" disabled id="tanggal" name="tanggal" type="date">
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="judul">Pilih Waktu</label>
                        <div id="waktu-container" class="d-flex flex-wrap gap-2">
                            <input class="form-control" disabled value="Isi tanggal terlebih dahulu">
                        </div>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama">Dosen Pembimbing</label>
                        <select class="form-select" name="id_dospem" id="dospem-select">
                            <option value="" disabled selected>-- Pilih Dosen Pembimbing --</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama">Dosen Penguji 1</label>
                        <select class="form-select" name="id_penguji_1" id="penguji1-select">
                            <option value="" disabled selected>-- Pilih Dosen Penguji 1 --</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-8 mx-auto">
                        <label class="small mb-1" for="nama">Dosen Penguji 2</label>
                        <select class="form-select" name="id_penguji_2" id="penguji2-select">
                            <option value="" disabled selected>-- Pilih Dosen Penguji 2 --</option>
                        </select>
                    </div>


                    <div class="mb-3 col-md-8 mx-auto">
                        <button type="submit" class="btn btn-primary" id="submit-button" disabled>Simpan</button>
                        <a href="{{ route('berkas-proposal.index', ['prodi'=>$prodi]) }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mahasiswaSelect = document.getElementById('mahasiswa'); // Rename this ID to something more appropriate if needed
        const nimInput = document.getElementById('nim');
        const prodiInput = document.getElementById('prodi');
        const dospem1Input = document.getElementById('dospem1');
        const dospem2Input = document.getElementById('dospem2');
        const topikInput = document.getElementById('topik');
        const judulInput = document.getElementById('judul');
        const dospemSelect = document.getElementById('dospem-select');
        const tanggalInput = document.getElementById('tanggal');
        const penguji1Select = document.getElementById('penguji1-select');
        const penguji2Select = document.getElementById('penguji2-select');
        const waktuContainer = document.getElementById('waktu-container');
        const submitButton = document.getElementById('submit-button');

        let prodi = ''
        let mahasiswaId = '';

        mahasiswaSelect.addEventListener('change', function() {
            const selectedId = parseInt(mahasiswaSelect.value.match(/^\d+/)[0], 10);
            mahasiswaId = parseInt(mahasiswaSelect.value.match(/^\d+/)[0], 10);

            fetch(`/mahasiswa-info?id=${selectedId}`)
                .then(response => response.json())
                .then(data => {
                    nimInput.value = data.nim;
                    prodiInput.value = data.prodi;
                    dospem1Input.value = data.dospem1;
                    dospem2Input.value = data.dospem2;
                    topikInput.value = data.topik;
                    judulInput.value = data.judul;
                    prodi = data.prodi;
                    tanggalInput.removeAttribute('disabled');
                })
                .catch(error => {
                    console.error('Error fetching student data:', error);
                });
        });

        tanggalInput.addEventListener('change', function() {
            const tanggal = tanggalInput.value;
            const mahasiswaId = parseInt(document.getElementById('mahasiswa').value.match(/^\d+/)[0], 10);
            submitButton.setAttribute('disabled', true);

            fetch(`/get-plot-jadwal?date=${tanggal}&prodi=${prodi}&jenis=Proposal`)
                .then(response => response.json())
                .then(data => {
                    const waktuSelect = document.createElement('select');
                    waktuSelect.setAttribute('name', 'id_plot_jadwal');
                    waktuSelect.setAttribute('id', 'waktuSelect');
                    waktuSelect.setAttribute('class', 'form-select');
                    waktuContainer.innerHTML = '';

                    const warning = document.createElement('option');
                    warning.value = '';
                    warning.text = '-- Pilih Waktu --';
                    if (data.length == 0) {
                        warning.text = 'Tidak ada jadwal/dosen yang tersedia'
                        waktuSelect.setAttribute('disabled', true);
                    };
                    warning.disabled = true;
                    warning.selected = true;
                    waktuSelect.appendChild(warning);

                    dospemSelect.innerHTML = '';
                    const warningDospem = document.createElement('option');
                    warningDospem.value = '';
                    warningDospem.text = '-- Pilih Dosen Pembimbing --';
                    dospemSelect.removeAttribute('disabled');
                    warningDospem.disabled = true;
                    warningDospem.selected = true;
                    dospemSelect.appendChild(warningDospem);

                    penguji1Select.innerHTML = '';
                    const warningPenguji1 = document.createElement('option');
                    warningPenguji1.value = '';
                    warningPenguji1.text = '-- Pilih Dosen Penguji 1 --';
                    penguji1Select.removeAttribute('disabled');
                    warningPenguji1.disabled = true;
                    warningPenguji1.selected = true;
                    penguji1Select.appendChild(warningPenguji1);

                    penguji2Select.innerHTML = '';
                    const warningPenguji2 = document.createElement('option');
                    warningPenguji2.value = '';
                    warningPenguji2.text = '-- Pilih Dosen Penguji 2 --';
                    penguji2Select.removeAttribute('disabled');
                    warningPenguji2.disabled = true;
                    warningPenguji2.selected = true;
                    penguji2Select.appendChild(warningPenguji2);

                    data.map((item) => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.text = item.waktu + ' (' + item.ruangan.nama_ruangan + ')';
                        waktuSelect.appendChild(option);
                    })
                    waktuContainer.appendChild(waktuSelect);

                    waktuSelect.addEventListener('change', function() {
                        const plotJadwal = waktuSelect.value;

                        fetch(`/get-available-data?jadwal=${plotJadwal}&mahasiswaId=${mahasiswaId}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log(data)
                                dospemSelect.innerHTML = '';
                                const warningDospem = document.createElement('option');
                                warningDospem.value = '';
                                warningDospem.text = '-- Pilih Dosen Pembimbing --';
                                dospemSelect.removeAttribute('disabled');
                                if (data.dospem.length == 0) {
                                    warningDospem.text = 'Tidak ada dosen yang tersedia'
                                    dospemSelect.setAttribute('disabled', true);
                                };
                                warningDospem.disabled = true;
                                warningDospem.selected = true;
                                dospemSelect.appendChild(warningDospem);

                                penguji1Select.innerHTML = '';
                                const warningPenguji1 = document.createElement('option');
                                warningPenguji1.value = '';
                                warningPenguji1.text = '-- Pilih Dosen Penguji 1 --';
                                penguji1Select.removeAttribute('disabled');
                                if (data.penguji1.length == 0) {
                                    warningPenguji1.text = 'Tidak ada dosen yang tersedia'
                                    penguji1Select.setAttribute('disabled', true);
                                };
                                warningPenguji1.disabled = true;
                                warningPenguji1.selected = true;
                                penguji1Select.appendChild(warningPenguji1);

                                const option1 = document.createElement('option');
                                option1.value = data.dospem.dospem1.id;
                                option1.text = data.dospem.dospem1.nama;
                                if (data.dospem.dospem1.available == false) {
                                    option1.setAttribute('disabled', 'true');
                                    option1.text = data.dospem.dospem1.nama + " (Tidak Tersedia)";
                                }
                                dospemSelect.appendChild(option1);

                                if (data.dospem.dospem2) {
                                    const option2 = document.createElement('option');
                                    option2.value = data.dospem.dospem2.id;
                                    option2.text = data.dospem.dospem2.nama;
                                    if (data.dospem.dospem2.available == false) {
                                        option2.setAttribute('disabled', 'true');
                                        option2.text = data.dospem.dospem2.nama + " (Tidak Tersedia)";
                                    }
                                    dospemSelect.appendChild(option2);
                                }

                                if (data.penguji1) {
                                    Object.entries(data.penguji1).map(([index, item]) => {
                                        const option = document.createElement('option');
                                        option.value = item;
                                        option.text = index;
                                        penguji1Select.appendChild(option);
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching student data:', error);
                            });
                    });

                })
                .catch(error => {
                    console.error('Error fetching schedule data:', error);
                });
        });

        penguji1Select.addEventListener('change', function() {
            const penguji1 = penguji1Select.value;
            const plotJadwal = document.getElementById('waktuSelect').value;

            fetch(`/get-penguji-2?penguji1=${penguji1}&mahasiswaId=${mahasiswaId}&plot=${plotJadwal}`)
                .then(response => response.json())
                .then(data => {
                    penguji2Select.innerHTML = '';
                    const warningPenguji2 = document.createElement('option');
                    warningPenguji2.value = '';
                    warningPenguji2.text = '-- Pilih Dosen Penguji 2 --';
                    penguji2Select.removeAttribute('disabled');
                    if (data.length == 0) {
                        warningPenguji2.text = 'Tidak ada dosen yang tersedia'
                        penguji2Select.setAttribute('disabled', true);
                    }
                    warningPenguji2.disabled = true;
                    warningPenguji2.selected = true;
                    penguji2Select.appendChild(warningPenguji2);
                    Object.entries(data).map(([index, item]) => {
                        const option = document.createElement('option');
                        option.value = item;
                        option.text = index;
                        penguji2Select.appendChild(option);
                    });
                    
                })
                .catch(error => {
                    console.error('Error fetching dosen data:', error);
                });
        });

        penguji2Select.addEventListener('change', function() {
            const penguji2 = penguji2Select.value;
            if(penguji2 == '') {
                submitButton.setAttribute('disabled', 'true');
            } else {
                submitButton.removeAttribute('disabled');
            }
        });
        
    });
</script>
@endsection