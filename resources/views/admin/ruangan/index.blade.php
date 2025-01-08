@extends('auth.layouts')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <h1 class="mt-4 mb-4">Kelola Ruangan Sidang</h1>
        <button class="btn btn-primary open-add-modal">Tambah Ruangan Sidang</button>
        <div class="mt-2">
            <div class="table-container" style="overflow-x: auto;">
                <table class="table table-bordered table-hover">

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <tr>
                        <th>No</th>
                        <th style="white-space: nowrap;">Nama Ruangan</th>
                        <th style="white-space: nowrap;">Link (Untuk Daring)</th>
                        <th>Action</th>
                    </tr>

                    @foreach($ruang as $d)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="white-space: nowrap;">{{ $d->nama_ruangan }}</td>
                        <td style="white-space: nowrap;">
                            <a href="{{$d->link ?? ''}}" target="_blank">{{$d->link ?? ''}}</a>
                        </td>
                        <td style="white-space: nowrap;">
                            <button class="btn btn-sm btn-primary open-modal"
                                data-nama="{{ $d->nama_ruangan }}"
                                data-link="{{ $d->link }}"
                                data-id="{{$d->id}}">Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </table>

                @if ($ruang->isNotEmpty())
                <div class="pagination">
                    {{ $ruang->links('custom_pagination') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Ruangan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="{{route('ruangan.store')}}">
                @csrf
                <input type="hidden" name="id" id="recordId">
                <div class="modal-body">
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama_mahasiswa">Nama Ruangan</label>
                        <input class="form-control" id="nama_mahasiswa" name="nama_ruangan" type="text">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nim">Link (Untuk Daring)</label>
                        <input class="form-control" id="nim" name="link" type="text">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Ruangan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nama">Nama Ruangan</label>
                        <input class="form-control" id="nama" name="nama_ruangan" type="text">
                    </div>
                    <div class="mb-3 col-md-10 mx-auto">
                        <label class="small mb-1" for="nim">Link (Untuk Daring)</label>
                        <input class="form-control" id="link" name="link" type="text">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="saveChanges">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".open-modal").click(function() {
            // Get the data from the button's data attributes
            var nama = $(this).data("nama");
            var link = $(this).data("link");
            var recordId = $(this).data("id");

            $("#nama").val(nama);
            $("#link").val(link);
            $("#exampleModal").modal("show");
            var url = "{{ route('ruangan.update', ':id') }}";
            url = url.replace(':id', recordId);

            $('#editForm').attr('action', url);
        });

        $(".open-add-modal").click(function() {
            $("#addModal").modal("show");
        });
    });

    console.log("recordId: " + recordId);
    console.log("status: " + $("#status").val());
</script>
@endsection