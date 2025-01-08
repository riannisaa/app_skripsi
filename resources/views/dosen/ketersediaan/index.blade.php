@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Ketersediaan Jadwal</h1>

        <a href="{{ route('ketersediaan.create') }}" class="btn btn-primary">Tambah Ketersediaan</a>

        @if (isset($message))
        <div class="alert alert-danger mt-4">
            {{ $message }}
        </div>
        @elseif ($ketersediaan->isEmpty())
        <div class="alert alert-info mt-4">
            Anda belum memilih ketersediaan jadwal
        </div>
        @else
        <div class="mt-2">
            <table class="table table-bordered table-hover">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Dosen</th>
                    <th>Prodi</th>
                    <th>Jenis Sidang</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Action</th>
                </tr>

                @if ($ketersediaan)
                @foreach ($ketersediaan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ auth()->user()->dosen->nip }}</td>
                    <td>{{ auth()->user()->dosen->nama_dosen }}</td>
                    <td>{{ $p->plotJadwal->prodi}}</td>
                    <td>{{ $p->plotJadwal->jenis_sidang }}</td>
                    <td>{{ formatTanggalIndo($p->plotJadwal->tanggal) }}</td>
                    <td>{{ $p->plotJadwal->waktu }} WIB</td>
                    <td style="white-space: nowrap;">
                        <button data-bs-toggle="modal" data-bs-target="#deleteModal{{$p->id}}" class="btn btn-danger">Hapus</button>


                        <div class="modal fade" id="deleteModal{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Item</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Anda yakin ingin menghapus item ini ?
                                    </div>
                                    <form class="modal-footer" action="{{route('ketersediaan.destroy', $p->id)}}" method="POST">
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
                @else
                <tr>
                    <td colspan="4">Belum ada pengajuan</td>
                </tr>
                @endif
            </table>
        </div>
        @endif
    </div>
</div>
@endsection