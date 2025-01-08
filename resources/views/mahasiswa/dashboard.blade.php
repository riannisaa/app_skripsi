@extends('auth.layouts')

@section('content')

<h2 class="px-2">Dashboard</h2>
<div class="row mt-3 mx-2 w-100">

  <div class="col-lg-6 p-2">
    <div class="card
    {{
      $rekomendasi ? ($rekomendasi->status === 'Pending' ? 'bg-warning text-white' : ($rekomendasi->status === 'Ditolak' ? 'bg-danger text-white' : ($rekomendasi->status === 'Disetujui' ? 'bg-success text-white' : ''))) : ''
    }}
    
    ">
      <div class="card-body">
        <h5 class="card-title">Pengajuan Rekomendasi Akademik</h5>
        @if ($rekomendasi === null)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @elseif ($rekomendasi->status === 'Disetujui')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Disetujui oleh Dosen PA</p>
        @elseif ($rekomendasi->status === 'Ditolak')
        <p class="card-text"><i class="fas fa-circle-xmark text-white"></i> Ditolak oleh Dosen PA</p>
        @elseif ($rekomendasi->status === 'Pending')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Pending</p>
        @elseif ($rekomendasi === null)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @endif
      </div>
    </div>
  </div>

  <div class="col-lg-6 p-2">
    <div class="card
    
    {{
      $topik ? ($topik->status === 'Pending' ? 'bg-warning text-white' : ($topik->status === 'Ditolak' ? 'bg-danger text-white' : ($topik->status === 'Disetujui' ? 'bg-success text-white' : ''))) : ''
    }}
    
    ">
      <div class="card-body">
        <h5 class="card-title">Pengajuan Topik</h5>
        @if ($topik === null)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @elseif ($topik->status === 'Disetujui')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Disetujui oleh Ketua Program Studi</p>
        @elseif ($topik->status === 'Ditolak')
        <p class="card-text"><i class="fas fa-circle-xmark text-white"></i> Ditolak oleh Ketua Program Studi</p>
        @elseif ($topik->status === 'Pending')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Pending</p>
        @endif
      </div>
    </div>
  </div>

  <div class="col-lg-6 p-2">
    <div class="card
    
    {{
    
    $dospem ? 
    ($dospem->status === 'Pending' ? 'bg-warning text-white' : 
    ($dospem->status === 'Ditolak' ? 'bg-danger text-white' : 
    ($dospem->status === 'Disetujui' ? 'bg-dark text-white' : 
    ($dospem->status === 'Sah' ? 'bg-success text-white' : 
    ($dospem->status === 'Tidak Sah' ? 'bg-danger text-white' : ''))))) : ''
    
    }}
    
    ">
      <div class="card-body">
        <h5 class="card-title">Pengajuan Dosen Pembimbing</h5>
        @if ($dospem === null)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @elseif ($dospem->status === 'Disetujui')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Disetujui oleh Dosen Pembimbing 1</p>
        @elseif ($dospem->status === 'Ditolak')
        <p class="card-text"><i class="fas fa-circle-xmark text-white"></i> Ditolak oleh Dosen Pembimbing 1</p>
        @elseif ($dospem->status === 'Sah')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Disahkan oleh Ketua Program Studi</p>
        @elseif ($dospem->status === 'Tidak Sah')
        <p class="card-text"><i class="fas fa-circle-xmark text-white"></i> Tidak sah oleh Ketua Program Studi</p>
        @elseif ($dospem->status === 'Pending')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Pending</p>
        @elseif ($dospem->status === 'Lulus')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Telah Lulus</p>
        @endif

      </div>
    </div>
  </div>

  @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi !== 'D3 Sistem Informasi')
  <div class="col-lg-6 p-2">
    <div class="card
    
    {{
      $proposal ? ($proposal->status === 'Pending' ? 'bg-warning text-white' : ($proposal->status === 'Ditolak' ? 'bg-danger text-white' : ($proposal->status === 'Disetujui' ? 'bg-success text-white' : ''))) : ''
    }}
    ">
      <div class="card-body">
        <h5 class="card-title"> Daftar Sidang Proposal</h5>
        @if (!$proposal)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @elseif ($proposal->status === 'Pending')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Pending</p>
        @elseif ($proposal->status === 'Ditolak')
        <p class="card-text"><i class="fas fa-circle-xmark text-white"></i> Ditolak</p>
        @elseif ($proposal->status === 'Disetujui')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Disetujui</p>
        @elseif ($proposal === null)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @endif
      </div>
    </div>
  </div>
  @endif

  <div class="col-lg-6 p-2">
    <div class="card
    

    {{
    
    $skripsi ? 
    ($skripsi->status === 'Pending' ? 'bg-warning text-white' : 
    ($skripsi->status === 'Ditolak' ? 'bg-danger text-white' : 
    ($skripsi->status === 'Disetujui' ? 'bg-success text-white' : ''))) : ''
    
    }}

    ">
      <div class="card-body">
        <h5 class="card-title">Daftar Sidang Skripsi</h5>
        @if (!$skripsi)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @elseif ($skripsi->status === 'Pending')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Pending</p>
        @elseif ($skripsi->status === 'Ditolak')
        <p class="card-text"><i class="fas fa-circle-xmark text-white"></i> Ditolak</p>
        @elseif ($skripsi->status === 'Disetujui')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Disetujui</p>
        @elseif ($skripsi === null)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @endif
      </div>
    </div>



  </div>

  @if(isset(auth()->user()->mahasiswa) && auth()->user()->mahasiswa->prodi !== 'D3 Sistem Informasi')
  <div class="col-lg-6 p-2">
    <div class="card
      
      {{
        $jadwalProposal ? 
        ($jadwalProposal->status === 'Pending' ? 'bg-warning text-white' : 
        ($jadwalProposal->status === 'Ditolak' ? 'bg-danger text-white' : 
        ($jadwalProposal->status === 'Disetujui' ? 'bg-success text-white' : ''))) : ''
        
        }}
      
      ">
      <div class="card-body">
        <h5 class="card-title"> Jadwal Sidang Proposal</h5>
        @if (!$jadwalProposal)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @elseif ($jadwalProposal->status === 'Pending')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Pending</p>
        @elseif ($jadwalProposal->status === 'Ditolak')
        <p class="card-text"><i class="fas fa-circle-xmark text-white"></i> Ditolak</p>
        @elseif ($jadwalProposal->status === 'Disetujui')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Disetujui</p>
        @elseif ($jadwalProposal === null)
        <p class="card-text text-muted">Belum ada pengajuan</p>
        @endif
      </div>
    </div>
  </div>
  @endif
  <div class="col-lg-6 p-2">
    <div class="card
    
    {{
    
    $jadwalSkripsi ? 
    ($jadwalSkripsi->status === 'Pending' ? 'bg-warning text-white' : 
    ($jadwalSkripsi->status === 'Ditolak' ? 'bg-danger text-white' : 
    ($jadwalSkripsi->status === 'Disetujui' ? 'bg-success text-white' : ''))) : ''
    
    }}
    
    ">
      <div class="card-body">
        <h5 class="card-title"> Jadwal Sidang Skripsi</h5>
        @if (!$jadwalSkripsi)
        <p class="card-text text-muted">Belum ada jadwal</p>
        @elseif ($jadwalSkripsi->status === 'Pending')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Pending</p>
        @elseif ($jadwalSkripsi->status === 'Ditolak')
        <p class="card-text"><i class="fas fa-circle-xmark text-white"></i> Ditolak</p>
        @elseif ($jadwalSkripsi->status === 'Disetujui')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Disetujui</p>
        @elseif ($jadwalSkripsi === null)
        <p class="card-text text-muted">Belum ada jadwal</p>
        @endif
      </div>
    </div>
  </div>

  <div class="col-lg-6 p-2">
    <div class="card
    
    {{
    
    $hasilProposal ? 
    ($hasilProposal == 'belum' ? '' : 
    ($hasilProposal == 'sudah' ? 'bg-success text-white' : '')) : ''
    
    }}
    
    ">
      <div class="card-body">
        <h5 class="card-title"> Hasil Sidang Proposal</h5>
        @if ($hasilProposal == 'belum')
        <p class="card-text"> Belum ada Penilaian</p>
        @elseif($hasilProposal == 'sudah')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Sudah ada Penilaian</p>
        @endif
      </div>
    </div>
  </div>
  <div class="col-lg-6 p-2">
    <div class="card
    
    {{
    
    $hasilSkripsi ? 
    ($hasilSkripsi == 'unfinished' ? '' :
    ($hasilSkripsi == 'revisi' ? 'bg-warning text-white' : 
    ($hasilSkripsi == 'pengesahan' ? 'bg-warning text-white' : 
    ($hasilSkripsi == 'pending' ? 'bg-warning text-white' :
    ($hasilSkripsi == 'selesai' ? 'bg-success text-white' : ''))))) : ''
    
    }}
    
    ">
      <div class="card-body">
        <h5 class="card-title"> Hasil Sidang Skripsi</h5>
        @if ($hasilSkripsi == 'unfinished')
        <p class="card-text"> Belum ada Penilaian</p>
        @elseif($hasilSkripsi == 'revisi')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Wajib Upload File Revisi & Lembar Pengesahan</p>
        @elseif($hasilSkripsi == 'pengesahan')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> Wajib Upload Lembar Pengesahan</p>
        @elseif($hasilSkripsi == 'pending')
        <p class="card-text"><i class="fas fa-exclamation-circle text-white"></i> ACC Belum Lengkap</p>
        @elseif($hasilSkripsi == 'selesai')
        <p class="card-text"><i class="fas fa-check-circle text-white"></i> Sudah ada Penilaian</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection