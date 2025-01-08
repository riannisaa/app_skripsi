@extends('auth.layouts')

@section('content')

<div class="row mt-3 mx-0">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Pengajuan Rekomendasi Dosen Pembimbing Akademik</h1>
        @if(isset($messageDataDiri))
            <button class="btn btn-primary" disabled>Tambah Pengajuan Rekomendasi</button>
            {{-- belum mengisi data diri --}}
            <div class="alert alert-danger mt-4">
                {{ $messageDataDiri }}
            </div>
        @else
            @if($isButtonDisabled)
                <button class="btn btn-primary" disabled>Tambah Pengajuan Rekomendasi</button>
            @else
                <a href="{{ route('addRekomendasi') }}" class="btn btn-primary">Tambah Pengajuan Rekomendasi</a>
            @endif

            @if (isset($message))
                <div class="alert alert-danger mt-4">
                    {{ $message }}
                </div>
            @elseif ($rekomendasi->isEmpty())
                <div class="alert alert-info mt-4">
                    Anda belum melakukan pengajuan
                </div>
             
            @else 
                <div class="mt-5 overflow-scroll">
                    <table class="table table-bordered table-hover">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @php
                            $counter = 1
                        @endphp
                        <tr>
                            {{-- <th>No</th> --}}
                            <th>Tanggal Pengajuan</th>
                            <th>Status Pengajuan</th>
                            <th>Keterangan Status</th>
                        </tr>

                        @if ($rekomendasi)
                            @foreach ($rekomendasi as $p)
                                <tr>
                                    {{-- <td>{{ $counter++ }}</td> --}}
                                    <td>{{ $p->tanggal_pengajuan }}</td>
                                    <td>
                                        @if($p->status === "Pending")
                                            <span class="badge text-bg-warning">Pending</span>
                                        @elseif($p->status ==="Disetujui")
                                            <span class="badge text-bg-success">Disetujui</span>
                                        @elseif($p->status === "Ditolak")
                                            <span class="badge text-bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $p->ket ?? '-'}}</td>
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
        @endif
    </div>
</div>
@endsection
