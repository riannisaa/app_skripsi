@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h2 class="mt-4 mb-4 text-center">Edit Data Topik</h2>
                @if(session('error'))
                <div class="alert alert-danger mb-3 col-md-8 mx-auto">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('updateTopik') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="recordId" value="{{ $topik->id }}">
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="jurusan">Program Studi </label>
                            <input class="form-control" id="jurusan" name="jurusan" value="{{ $topik->jurusan }}" readonly>
                        </div>
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="topik">Topik </label>
                            <input class="form-control" id="topik" name="topik" value="{{ $topik->topik }}" readonly>
                        </div>
                       
                        {{-- <div class="mb-3 col-md-8 mx-auto">
                        </div> --}}
                     
                        <div class="col-md-8 mx-auto">
                            <label class="small mb-1" for="dosen">Dosen </label>                            
                            <select id="dosen" name="dosen[]" class="form-select" multiple required>
                                @foreach ($allDosen as $dosen)
                                    <option value="{{ $dosen->id }}" @if(in_array($dosen->id, $topik->dosen->pluck('id')->toArray())) selected @endif>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3 col-md-8 mx-auto">
                            <label class="small mb-1" for="kapasitas">Kapasitas </label>
                            <input class="form-control" id="kapasitas" name="kapasitas" type="number" value="{{ $topik->kapasitas }}" required>
                        </div>

                        <div class="mb-3 col-md-8 mx-auto">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('listTopik.admin') }}" class="btn btn-secondary">Batal</a>
                        </div>
                </form>

                
            </div>
        </div>
	
	</div>
</div>	

<script>
    // $(document).ready(function() {
    //     $('#dosen').multiselect();
    // });

    $( '#dosen' ).select2( {
        theme: 'bootstrap-5'
    } );
</script>
@endsection