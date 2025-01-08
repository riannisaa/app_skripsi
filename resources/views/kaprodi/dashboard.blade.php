@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-3">

    <h2 class="mb-4 fw-bold">Dashboard</h2>
    <div class="col-md-12 mb-5">
        <h3>Pengajuan Topik Skripsi/TA</h3>
        <div class="row mt-3">

            <div class="col-sm-4">
                <div class="card bg-warning">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $topik_pending }}</p>
                        <h4 class="card-title text-white">Pending</h4>
                        <i class="display-2 opacity-50 fas fa-exclamation-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card bg-success">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $topik_disetujui }}</p>
                        <h4 class="card-title text-white">Disetujui</h4>
                        <i class="display-2 opacity-50 fas fa-check-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $topik_ditolak }}</p>
                        <h4 class="card-title text-white">Ditolak</h4>
                        <i class="display-2 opacity-50 fas fa-xmark-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
        </div>


        <h3 class="mt-5">Pengajuan Dosen Pembimbing Skripsi/TA</h3>
        <div class="row mt-3">
            <div class="col-sm-4">
                <div class="card bg-warning">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $dospem_pending }}</p>
                        <h4 class="card-title text-white">Pending</h4>
                        <i class="display-2 opacity-50 fas fa-exclamation-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-success">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $dospem_disetujui }}</p>
                        <h4 class="card-title text-white">Disetujui</h4>
                        <i class="display-2 opacity-50 fas fa-check-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $dospem_ditolak }}</p>
                        <h4 class="card-title text-white">Ditolak</h4>
                        <i class="display-2 opacity-50 fas fa-circle-xmark text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5">Penjadwalan Sidang Proposal</h3>
        <div class="row mt-3">
            <div class="col-sm-4">
                <div class="card bg-warning">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $proposal_pending }}</p>
                        <h4 class="card-title text-white">Pending</h4>
                        <i class="display-2 opacity-50 fas fa-exclamation-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-success">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $proposal_disetujui }}</p>
                        <h4 class="card-title text-white">Disetujui</h4>
                        <i class="display-2 opacity-50 fas fa-check-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $proposal_ditolak }}</p>
                        <h4 class="card-title text-white">Ditolak</h4>
                        <i class="display-2 opacity-50 fas fa-circle-xmark text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
        </div>


        <h3 class="mt-5">Penjadwalan Sidang Skripsi</h3>
        <div class="row mt-3">
            <div class="col-sm-4">
                <div class="card bg-warning">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $jadwalSkripsi_pending }}</p>
                        <h4 class="card-title text-white">Pending</h4>
                        <i class="display-2 opacity-50 fas fa-exclamation-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-success">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $jadwalSkripsi_disetujui }}</p>
                        <h4 class="card-title text-white">Disetujui</h4>
                        <i class="display-2 opacity-50 fas fa-check-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-danger">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $jadwalSkripsi_ditolak }}</p>
                        <h4 class="card-title text-white">Ditolak</h4>
                        <i class="display-2 opacity-50 fas fa-circle-xmark text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5">Hasil Sidang Proposal</h3>
        <div class="row mt-3">
            <div class="col-sm-6">
                <div class="card bg-warning">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $hasilProposal_pending }}</p>
                        <h4 class="card-title text-white">Pending</h4>
                        <i class="display-2 opacity-50 fas fa-exclamation-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card bg-success">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $hasilProposal_selesai }}</p>
                        <h4 class="card-title text-white">Selesai</h4>
                        <i class="display-2 opacity-50 fas fa-check-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5">Hasil Sidang Skripsi</h3>
        <div class="row mt-3">
            <div class="col-sm-6">
                <div class="card bg-warning">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $hasilSkripsi_pending }}</p>
                        <h4 class="card-title text-white">Pending</h4>
                        <i class="display-2 opacity-50 fas fa-exclamation-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card bg-success">
                    <div class="card-body position-relative">
                        <p class="card-text display-5 text-white mb-0">{{ $hasilSkripsi_selesai }}</p>
                        <h4 class="card-title text-white">Selesai</h4>
                        <i class="display-2 opacity-50 fas fa-check-circle text-dark position-absolute top-50 end-0 translate-middle-y me-3"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



@endsection