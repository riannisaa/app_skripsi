@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Kelola Jadwal Sidang {{$prodi}}</h1>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if(session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
        @endif
        <div class="card p-4 gap-2 d-flex flex-col">
            <h4 class="fw-bold">Pengaturan Jadwal</h4>

            <form class="w-25" action="{{route('site-setting.update', $dailyMax->id)}}" method="POST">
                @csrf
                @method('PUT')
                <label class="small mb-1" for="nama">Maksimum Sidang Per Hari Dosen</label>
                <div class="d-flex gap-1">
                    <input class="form-control" id="nama" name="value" type="number" value="{{$dailyMax->value}}">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>

        <div class="card p-4 gap-2 d-flex flex-col mt-3">
            <h4 class="fw-bold">Tambah Jadwal</h4>
            <form class="w-100" action="{{route('plot-jadwal.store')}}" method="POST">
                @csrf
                <table class="w-75">
                    <tr>
                        <td class="p-2"><label class="small fw-bold mb-1" for="nama">Program Studi</label></td>
                        <td class="p-2">
                            <select class="form-select" name="prodi">
                                <option value="" disabled selected>-- Pilih Prodi --</option>
                                <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                                <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                <option value="S1 Informatika">S1 Informatika</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2"><label class="small fw-bold mb-1" for="nama">Jenis Sidang</label></td>
                        <td class="p-2">
                            <select class="form-select" name="jenis_sidang">
                                <option value="" disabled selected>-- Pilih Jenis Sidang --</option>
                                <option value="Proposal">Proposal</option>
                                <option value="Skripsi">Skripsi</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2"><label class="small fw-bold mb-1" for="nama">Tanggal</label></td>
                        <td class="p-2">
                            <input class="form-control" id="nama" name="tanggal" type="date">
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2"><label class="small fw-bold mb-1" for="nama">Waktu</label></td>
                        <td class="p-2">
                            <div class="d-flex gap-3">

                                <input class="form-control" id="mulai" name="waktu_mulai">
                                <div>s.d.</div>
                                <input class="form-control" id="selesai" name="waktu_selesai" type="time">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2"><label class="small fw-bold mb-1" for="nama">Ruang Sidang</label></td>
                        <td class="p-2">
                            <select class="form-select" id="selectRuang" name="id_ruangan">
                                <option value="" disabled selected>-- Pilih Ruang Sidang --</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2"></td>
                        <td class="p-2">
                            <button type="submit" class="btn btn-primary" id="saveChanges">Simpan</button>
                        </td>
                    </tr>
                </table>
                <div class="d-flex gap-1">


                </div>
            </form>
        </div>

        <div class="card p-4 gap-2 d-flex flex-col mt-3 mb-5">
            <h4 class="fw-bold">Data Slot Harian</h4>
            <div class="table-container" style="overflow-x: auto;">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>No</th>
                        <th style="white-space: nowrap;">Tanggal</th>
                        <th style="white-space: nowrap;">Ruangan</th>
                        <th style="white-space: nowrap;">Link (Untuk Daring)</th>
                        <th style="white-space: nowrap;">Jenis Sidang</th>
                        <th style="white-space: nowrap;">Waktu Sidang</th>
                        <th style="white-space: nowrap;">Aksi</th>
                    </tr>

                    @foreach($jadwal as $d)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">{{formatTanggalIndo($d->tanggal) }}</td>
                        <td style="white-space: nowrap;">{{$d->ruangan->nama_ruangan}}</td>
                        <td style="white-space: nowrap;">{{$d->ruangan->link}}</td>
                        <td style="white-space: nowrap;">{{$d->jenis_sidang}}</td>
                        <td style="white-space: nowrap;">{{ $d->waktu}} WIB</td>
                        <td style="white-space: nowrap;">
                            <button data-bs-toggle="modal" data-bs-target="#deleteModal{{$d->id}}" class="btn btn-danger">Hapus</button>


                            <div class="modal fade" id="deleteModal{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Item</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Anda yakin ingin menghapus item ini ?
                                        </div>
                                        <form class="modal-footer" action="{{route('plot-jadwal.destroy', $d->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        
        <div class="card p-4 gap-2 d-flex flex-col mt-3 mb-5">
            <h4 class="fw-bold">Ketersediaan Dosen</h4>
            <div class="table-container" style="overflow-x: auto;">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>No</th>
                        <th style="white-space: nowrap;">Nama Dosen</th>
                        <th style="white-space: nowrap;">Jenis Sidang</th>
                        <th style="white-space: nowrap;">Prodi</th>
                        <th style="white-space: nowrap;">Tanggal Sidang</th>
                        <th style="white-space: nowrap;">Waktu Sidang</th>
                    </tr>

                    @foreach($ketersediaan as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">{{$d->dosen->nama_dosen}}</td>
                        <td style="white-space: nowrap;">{{$d->plotJadwal->jenis_sidang}}</td>
                        <td style="white-space: nowrap;">{{$d->plotJadwal->prodi}}</td>
                        <td style="white-space: nowrap;">{{formatTanggalIndo($d->plotJadwal->tanggal) }}</td>
                        <td style="white-space: nowrap;">{{ $d->plotJadwal->waktu}} WIB</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    flatpickr("#mulai", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });

    flatpickr("#selesai", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });

    document.addEventListener('DOMContentLoaded', function() {
        const prodi = document.querySelector('[name="prodi"]');
        const jenisSidang = document.querySelector('[name="jenis_sidang"]');
        const tanggal = document.querySelector('[name="tanggal"]');
        const waktuMulai = document.querySelector('[name="waktu_mulai"]');
        const waktuSelesai = document.querySelector('[name="waktu_selesai"]');
        const selectRuang = document.getElementById('selectRuang');
        const submitButton = document.getElementById('saveChanges');

        function checkRuang() {
            const url = new URL('/check-ruang', window.location.origin);

            url.searchParams.append('prodi', prodi.value);
            url.searchParams.append('jenis_sidang', jenisSidang.value);
            url.searchParams.append('tanggal', tanggal.value);
            url.searchParams.append('waktu_mulai', waktuMulai.value);
            url.searchParams.append('waktu_selesai', waktuSelesai.value);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Clear the existing options
                    selectRuang.innerHTML = '';
                    submitButton.disabled = false; // Enable the submit button initially

                    if (data.length === 0) {
                        // If no data is available, add a disabled option
                        const option = document.createElement('option');
                        option.textContent = 'Tidak ada Ruangan tersedia';
                        option.selected = true;
                        option.disabled = true;
                        selectRuang.appendChild(option);

                        // Disable the submit button
                        submitButton.disabled = true;
                    } else {
                        // Iterate over the returned data and create options
                        data.forEach(ruang => {
                            const option = document.createElement('option');
                            option.value = ruang.id; // assuming each ruang has an 'id' property
                            option.textContent = ruang.nama_ruangan; // assuming each ruang has a 'nama_ruang' property
                            selectRuang.appendChild(option);
                        });

                        // Enable the submit button
                        submitButton.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error fetching ruang data:', error);

                    // Disable the submit button if there's an error
                    submitButton.disabled = true;
                });
        }

        // Call checkRuang whenever any input value changes
        [prodi, jenisSidang, tanggal, waktuMulai, waktuSelesai].forEach(input => {
            input.addEventListener('change', checkRuang);
        });
    });
</script>
@endsection