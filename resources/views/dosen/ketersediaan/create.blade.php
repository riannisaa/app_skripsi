@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Form Ketersediaan <br> Jadwal Sidang</h2>
                @if ($errors->any())
                <div class="alert alert-danger mb-3 col-md-10 mx-auto">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('ketersediaan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nim">NIP</label>
                        <input class="form-control" disabled id="nim" name="nim" type="string" required="" value="{{ auth()->user()->nim_nip }}" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_dosen">Nama Dosen</label>
                        <input class="form-control" disabled id="nama_mahasiswa" name="nama_mahasiswa" type="text" placeholder="Masukkan nama lengkap" required="" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto ">
                        <label class="small mb-1" for="nama">Program Studi</label>
                        <select class="form-select" name="prodi" id="prodi">
                            <option value="" disabled selected>-- Pilih Prodi --</option>
                            <option value="D3 Sistem Informasi">D3 Sistem Informasi</option>
                            <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                            <option value="S1 Informatika">S1 Informatika</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama">Jenis Sidang</label>
                        <select class="form-select" name="jenis_sidang" id="jenis_sidang">
                            <option value="" disabled selected>-- Pilih Jenis Sidang --</option>
                            <option value="Proposal">Proposal</option>
                            <option value="Skripsi">Skripsi</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Pilih Tanggal</label>
                        <input class="form-control" id="tanggal" name="tanggal" disabled value="Silahkan lengkapi input diatas terlebih dahulu.">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="judul">Pilih Waktu</label>
                        <div id="waktu-container" class="d-flex flex-wrap gap-2">
                            <input class="form-control" disabled value="Isi pilihan diatas terlebih dahulu">
                        </div>
                    </div>

                    <div class="mb-3 col-md-10 mx-auto">
                        <button type="submit" class="btn btn-primary" id="submit-button" disabled>Simpan</button>
                        <a href="{{ route('ketersediaan.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>
        <div class="card p-4 gap-2 d-flex flex-col mt-3 mb-5">
            <h4 class="fw-bold">Data Slot Harian Tersedia</h4>
            <div class="table-container" style="overflow-x: auto;">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>No</th>
                        <th style="white-space: nowrap;">Tanggal</th>
                        <th style="white-space: nowrap;">Ruangan</th>
                        <th style="white-space: nowrap;">Prodi</th>
                        <th style="white-space: nowrap;">Link (Untuk Daring)</th>
                        <th style="white-space: nowrap;">Jenis Sidang</th>
                        <th style="white-space: nowrap;">Waktu Sidang</th>
                    </tr>

                    @foreach($plotJadwal as $d)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">{{formatTanggalIndo($d->tanggal) }}</td>
                        <td style="white-space: nowrap;">{{$d->ruangan->nama_ruangan}}</td>
                        <td style="white-space: nowrap;">{{$d->prodi}}</td>
                        <td style="white-space: nowrap;">{{$d->ruangan->link ?? '-'}}</td>
                        <td style="white-space: nowrap;">{{$d->jenis_sidang}}</td>
                        <td style="white-space: nowrap;">{{ $d->waktu}} WIB</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        const prodi = $('#prodi');
        const jenisSidang = $('#jenis_sidang');
        var tanggal = $('#tanggal');
        const waktuContainer = document.getElementById('waktu-container');
        const submitButton = document.getElementById('submit-button'); 

        function fetchAvailableWaktu(tgl) {
            const url = new URL('/filter-jadwal', window.location.origin);
            url.searchParams.append('prodi', prodi.val());
            url.searchParams.append('jenis_sidang', jenisSidang.val());
            url.searchParams.append('tanggal', tgl);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    waktuContainer.innerHTML = ''; // Clear previous options

                    // Check if the limit has been reached
                    if (data.limitReached) {
                        const limitMessage = document.createElement('div');
                        limitMessage.classList.add('alert', 'alert-warning');
                        limitMessage.textContent = 'Anda sudah mencapai batas maksimal per hari';
                        waktuContainer.appendChild(limitMessage);

                        // Hide checkboxes and disable the submit button
                        submitButton.disabled = true;
                    } else {
                        submitButton.disabled = true; // Disable the submit button initially

                        if (data.availableTimes.length === 0) {
                            waktuContainer.innerHTML = '<input class="form-control" disabled value="Tidak ada jadwal tersedia">';
                        } else {
                            data.availableTimes.forEach(dosen => {
                                const label = document.createElement('label');
                                label.classList.add('btn', 'btn-outline-secondary');
                                label.textContent = dosen.waktu;

                                const input = document.createElement('input');
                                input.type = 'checkbox';
                                input.name = 'waktu[]';
                                input.value = dosen.id;
                                input.classList.add('btn-check');
                                input.autocomplete = 'off';

                                // Apply initial styles for disabled state
                                if (dosen.used) {
                                    label.classList.replace('btn-outline-secondary', 'btn-danger');
                                    input.disabled = true;
                                }

                                // Handle checkbox state changes
                                input.addEventListener('change', function() {
                                    if (input.checked) {
                                        label.classList.replace('btn-outline-secondary', 'btn-primary');
                                    } else {
                                        label.classList.replace('btn-primary', 'btn-outline-secondary');
                                    }

                                    // Enable the submit button if any checkbox is checked
                                    submitButton.disabled = !document.querySelector('input[name="waktu[]"]:checked');
                                });

                                label.appendChild(input);
                                waktuContainer.appendChild(label);
                            });

                            // Check if any checkboxes are already checked
                            submitButton.disabled = !document.querySelector('input[name="waktu[]"]:checked');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching waktu data:', error);
                });
        }

        function fetchAvailableTanggal() {
            waktuContainer.innerHTML = '<input class="form-control" disabled value="Silahkan lengkapi input diatas terlebih dahulu">';
            submitButton.disabled = true;
            if (prodi.val() && jenisSidang.val()) {
                tanggal.prop('disabled', false); // Aktifkan input tanggal
                tanggal.val(''); // Kosongkan placeholder saat input diaktifkan

                const url = new URL('/filter-tanggal', window.location.origin);
                url.searchParams.append('prodi', prodi.val());
                url.searchParams.append('jenis_sidang', jenisSidang.val());

                $.ajax({
                    url: url.href,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        tanggal.datepicker('destroy'); // Hapus datepicker sebelumnya

                        // Inisialisasi datepicker
                        tanggal.datepicker({
                            format: 'yyyy-mm-dd',
                            beforeShowDay: function(date) {
                                // Iterasi setiap tanggal dalam array data
                                for (var i = 0; i < data.availableDate.length; i++) {
                                    // Ubah string tanggal dari server menjadi objek Date
                                    var enabledDate = new Date(data.availableDate[i]);

                                    // Bandingkan waktu (time) dari tanggal di datepicker dengan tanggal dari server
                                    if (date.toDateString() === enabledDate.toDateString()) {

                                        console.log(enabledDate);
                                        return {
                                            enabled: true,
                                            classes: 'active-date'
                                        };
                                    }
                                }
                                return false; // Nonaktifkan semua tanggal lain
                            }
                        });

                        tanggal.on('changeDate', function(event) {
                            fetchAvailableWaktu(tanggal.val());
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching tanggal data:', error);
                    }
                });
            } else {
                tanggal.prop('disabled', true); // Tetap nonaktif jika input belum lengkap
                tanggal.val('Silahkan lengkapi input diatas terlebih dahulu.'); // Reset ke placeholder
            }
        }

        prodi.add(jenisSidang).on('change', fetchAvailableTanggal);

    });
</script>


@endsection