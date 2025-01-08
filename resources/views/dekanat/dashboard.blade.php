@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">

        <h3>Pengajuan Rekomendasi Akademik</h3>
        <div class="row mt-3">

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-exclamation-circle text-warning"></i>  Pending</h4>
                        <p class="card-text">1</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-check-circle text-success"></i>  Disetujui</h4>
                        <p class="card-text">2</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-circle-xmark text-danger"></i>  Ditolak</h4>
                        <p class="card-text">3</p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5">Pengajuan Topik Skripsi/TA</h3>
        <div class="row mt-3">

            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-exclamation-circle text-warning"></i>  Pending</h4>
                        <p class="card-text">3</p>
                    </div>
                </div>
            </div>
     
            
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-check-circle text-success"></i>  Disetujui</h4>
                        <p class="card-text">4</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-circle-xmark text-danger"></i>  Ditolak</h4>
                        <p class="card-text">5</p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5">Pengajuan Dosen Pembimbing Skripsi/TA</h3>
        <div class="row mt-3">
                    
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-exclamation-circle text-warning"></i>  Pending</h4>
                        <p class="card-text">1</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-check-circle text-success"></i>  Disetujui</h4>
                        <p class="card-text">3</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-circle-xmark text-danger"></i>  Ditolak</h4>
                        <p class="card-text">0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>            

@endsection