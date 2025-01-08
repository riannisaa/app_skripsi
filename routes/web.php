<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\BerkasSidangProposalController;
use App\Http\Controllers\BerkasSidangSkripsiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DospemController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HasilProposalController;
use App\Http\Controllers\HasilSkripsiController;
use App\Http\Controllers\JadwalProposalController;
use App\Http\Controllers\JadwalSidangController;
use App\Http\Controllers\JadwalSkripsiController;
use App\Http\Controllers\KetersediaanDosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PlotJadwalController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SiteSettingController;
use App\Models\HasilSkripsiPenguji;
use App\Models\JadwalProposal;
use App\Models\PlotJadwal;

Route::get('/', [LoginRegisterController::class, 'login'])->name('root');

Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');
Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');
Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginRegisterController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

//login admin
Route::get('/admin', [LoginRegisterController::class, 'loginAdmin'])->name('loginAdmin');
Route::post('/logoutAdmin', [LoginRegisterController::class, 'logoutAdmin'])->name('logoutAdmin');
Route::post('/authenticate-admin', [LoginRegisterController::class, 'authenticateAdmin'])->name('authenticateAdmin');


//dashboard
Route::get('/dashboard/mahasiswa', [DashboardController::class, 'dashboardMahasiswa'])->name('dashboard.mahasiswa')->middleware('mahasiswa');
Route::get('/dashboard/kaprodi', [DashboardController::class, 'dashboardKaprodi'])->name('dashboard.kaprodi')->middleware('kaprodi');
Route::get('/dashboard/dosen', [DashboardController::class, 'dashboardDosen'])->name('dashboard.dosen')->middleware('dosen');
Route::get('/dashboard/admin', [DashboardController::class, 'dashboardAdmin'])->name('dashboard.admin');


// profile
Route::get('/profile/mahasiswa', [ProfileController::class, 'show'])->middleware('mahasiswa')->name('profile.mahasiswa');
Route::get('/profile/dosen', [ProfileController::class, 'showDosen'])->middleware('auth')->name('profile.dosen');
Route::get('/profile/admin', [ProfileController::class, 'showAdmin'])->name('profile.admin');

// edit profile
Route::get('/editprofile', [ProfileController::class, 'edit'])->middleware('mahasiswa')->name('editprofile');
Route::put('/editprofile', [ProfileController::class, 'update'])->middleware('mahasiswa')->name('updateProfile');
// change password
Route::get('/changepassword', [ProfileController::class, 'editPassword'])->middleware('auth')->name('editPassword');
Route::put('/changepassword', [ProfileController::class, 'updatePassword'])->middleware('auth')->name('updatePassword');


//rekomendasi akademik
Route::get('/rekomendasi/mahasiswa', [RekomendasiController::class, 'show'])->name('rekomendasi.mahasiswa')->middleware('mahasiswa');
Route::get('/rekomendasi/dosen', [RekomendasiController::class, 'showAll'])->name('rekomendasi.dosen')->middleware('dosen');
Route::get('/rekomendasi/dosen-search', [RekomendasiController::class, 'searchRekomendasiDosen'])->name('rekomendasiDosen.search');

Route::get('/rekomendasi/admin', [RekomendasiController::class, 'showAdmin'])->name('rekomendasi.admin');

// Route::get('/rekomendasi/dekanat', [RekomendasiController::class, 'showAdmin'])->name('rekomendasi.dekanat')->middleware('dekanat');
// Route::get('/rekomendasi/admin', [RekomendasiController::class, 'showAdmin'])->name('rekomendasi.admin')->middleware(['admin', 'kaprodi', 'dekanat']);
// Route::get('/rekomendasi/admin', [RekomendasiController::class, 'showAdmin'])->name('rekomendasi.admin')->middleware('admin');

//search rekomendasi kaprodi dekanat admin
Route::get('/rekomendasi/search', [RekomendasiController::class, 'searchRekomendasi'])->name('rekomendasi.search');


// pengajuan rekomendasi
Route::get('/rekomendasi/add', [RekomendasiController::class, 'add'])->name('addRekomendasi')->middleware('mahasiswa');
Route::post('/rekomendasi/save', [RekomendasiController::class, 'save'])->name('saveRekomendasi')->middleware('mahasiswa');

// update status rekomendasi
Route::get('/rekomendasi/{id}', [RekomendasiController::class, 'getRowData']);
Route::put('/rekomendasi/update-status', [RekomendasiController::class, 'updateStatus'])->name('rekomendasi.updateStatus');

// show topik
Route::get('/topik/mahasiswa', [TopikController::class, 'show'])->name('topik.mahasiswa')->middleware('mahasiswa');
Route::get('/topik/kaprodi', [TopikController::class, 'showAll'])->name('topik.kaprodi')->middleware('kaprodi');
Route::get('/topik/dekanat', [TopikController::class, 'showAdmin'])->name('topik.dekanat')->middleware('dekanat');
Route::get('/topik/admin', [TopikController::class, 'showAdmin'])->name('topik.admin')->middleware('admin');
Route::get('/topik/search', [TopikController::class, 'searchTopik'])->name('topik.search');

// pengajuan topik
Route::get('/topik/add', [TopikController::class, 'add'])->name('addTopik')->middleware('mahasiswa');
Route::post('/topik/save', [TopikController::class, 'save'])->name('saveTopik')->middleware('mahasiswa');
// update status topik
Route::get('/get-row-data/{id}', [TopikController::class, 'getRowData']);
Route::put('/update-status', [TopikController::class, 'updateStatus'])->name('updateStatus');

// daftar topik -- search
Route::get('/daftartopik/mahasiswa', [TopikController::class, 'listTopik'])->name('listTopik')->middleware('auth');
Route::get('/daftartopik', [TopikController::class, 'listTopikAll'])->name('listTopik.admin');
Route::get('/daftartopik/search', [TopikController::class, 'searchListTopik'])->name('listTopik.search');


// edit daftar topik
Route::get('/get-row-data-topik/{id}', [TopikController::class, 'getRowDataTopik']);
Route::get('/editTopik/{id}', [TopikController::class, 'editTopik'])->name('editTopik');
Route::put('/updateTopik', [TopikController::class, 'updateTopik'])->name('updateTopik');

//delete topik
Route::delete('/deleteTopik', [TopikController::class, 'deleteTopik'])->name('deleteTopik');

//add daftar topik
Route::post('/addTopik', [TopikController::class, 'addDataTopik'])->name('addDataTopik');


// show dosen
Route::get('/dospem/mahasiswa', [DospemController::class, 'show'])->name('dospem.mahasiswa')->middleware('mahasiswa');
Route::get('/dospem/kaprodi', [DospemController::class, 'showAll'])->name('dospem.kaprodi')->middleware('kaprodi');
Route::get('/dospem/dosen', [DospemController::class, 'showDosen'])->name('dospem.dosen')->middleware('dosen');
Route::get('/dospem/admin', [DospemController::class, 'showAdmin'])->name('dospem.admin')->middleware('admin');
Route::get('/dospem/dekanat', [DospemController::class, 'showDekanat'])->name('dospem.dekanat')->middleware('dekanat');

Route::get('/dospem/search', [DospemController::class, 'searchDosen'])->name('dospem.search');


// pengajuan dospem
Route::get('/dospem/add', [DospemController::class, 'add'])->name('addDospem')->middleware('mahasiswa');
Route::post('/dospem/save', [DospemController::class, 'save'])->name('saveDospem')->middleware('mahasiswa');

// update status dospem
Route::get('/dospem/{id}', [DospemController::class, 'getRowData']);
Route::put('/dospem/update-status', [DospemController::class, 'updateStatus'])->name('dospem.updateStatus')->middleware('kaprodi');
Route::put('/dospem/approve-dospem', [DospemController::class, 'approveDosen'])->name('dospem.approveDosen')->middleware('dosen');
Route::put('/dospem/input-dospem', [DospemController::class, 'inputDosen'])->name('dospem.inputDosen')->middleware('kaprodi');

//edit pengajuan dospem 1 dan 2
Route::get('/edit-dosen-pembimbing/{id}', [DospemController::class, 'editDosenPembimbing'])->name('editDosenPembimbing');
Route::put('/update-dosen-pembimbing', [DospemController::class, 'updateDosenPembimbing'])->name('updateDosenPembimbing');


// edit daftar dospem
Route::get('/dospem-data/{id}', [DospemController::class, 'getRowDataDospem']);
Route::put('/dospem/update-dospem', [DospemController::class, 'updateDospem'])->name('updateDospem')->middleware('kaprodi');


//daftar dosen -- search
Route::get('/daftardosen', [DospemController::class, 'listDosen'])->name('listDosen');
Route::get('/daftardosen/kaprodi', [DospemController::class, 'listDosenAll'])->name('listDosen.kaprodi')->middleware('kaprodi');
Route::get('/daftardosen/search', [DospemController::class, 'searchListDosen'])->name('listDosen.search');


Route::get('/kelola-form', [FormController::class, 'index'])->name('showForm')->middleware('admin');
Route::post('/kelola-form/status-rekom', [FormController::class, 'statusRekom'])->name('status.rekom');
Route::post('/kelola-form/status-topik', [FormController::class, 'statusTopik'])->name('status.topik');
Route::post('/kelola-form/status-dospem', [FormController::class, 'statusDospem'])->name('status.dospem');

Route::get('/export', [TopikController::class, 'export'])->name('export');
Route::get('/export-daftar-dospem', [DospemController::class, 'exportListDospem'])->name('exportListDospem');
Route::get('/export-dospem', [DospemController::class, 'exportDospem'])->name('exportDospem');
Route::get('/export-topik', [TopikController::class, 'exportTopik'])->name('exportTopik');
Route::get('/export-rekomendasi-dosen', [RekomendasiController::class, 'exportRekomendasi'])->name('exportRekomendasi');
Route::get('/export-rekomendasi', [RekomendasiController::class, 'exportRekomendasiDosen'])->name('exportRekomendasiDosen');


Route::get('/kelola-mahasiswa', [MahasiswaController::class, 'index'])->name('showMahasiswa')->middleware('admin');
Route::put('/kelola-mahasiswa/update-status', [MahasiswaController::class, 'updateStatus'])->name('updateMahasiswa')->middleware('admin');
Route::get('/kelola-mahasiswa/search', [MahasiswaController::class, 'searchMahasiswa'])->name('searchMahasiswa');


// PROPOSAL - MAHASISWA
Route::resource('berkas-proposal', BerkasSidangProposalController::class);
Route::post('berkas-proposal/update-status', [BerkasSidangProposalController::class, 'updateStatus'])->name('berkas-proposal.update-status')->middleware('admin');
Route::get('/export-berkas-proposal', [BerkasSidangProposalController::class, 'export'])->name('berkas-proposal.export');

// SKRIPSI - MAHASISWA
Route::resource('berkas-skripsi', BerkasSidangSkripsiController::class);
Route::post('berkas-skripsi/update-status', [BerkasSidangSkripsiController::class, 'updateStatus'])->name('berkas-skripsi.update-status')->middleware('admin');
Route::get('/export-berkas-skripsi', [BerkasSidangSkripsiController::class, 'export'])->name('berkas-skripsi.export');

//Sidang - Admin
Route::resource('ruangan', RuanganController::class)->middleware('admin');
Route::resource('plot-jadwal', PlotJadwalController::class)->middleware('admin');
Route::resource('site-setting', SiteSettingController::class)->middleware('admin');
Route::get('/check-ruang', [PlotJadwalController::class, 'checkRuang'])->name('plot-jadwal.check-ruang')->middleware('admin');

//Ketersedian Jadwal - Dosen
Route::resource('ketersediaan', KetersediaanDosenController::class)->middleware('dosen');
Route::get('/filter-jadwal', [KetersediaanDosenController::class, 'filterJadwal'])->middleware('dosen');
Route::get('/filter-tanggal', [KetersediaanDosenController::class, 'filterTanggal'])->middleware('dosen');

// Jadwal - Admin
Route::resource('jadwal-proposal', JadwalProposalController::class);
Route::get('/mahasiswa-info', [JadwalSidangController::class, 'mahasiswaInfo'])->middleware('admin');
Route::get('/dospem-info', [JadwalSidangController::class, 'dospemInfo'])->middleware('admin');
Route::get('/get-available-data', [JadwalSidangController::class, 'getAvailableData'])->middleware('admin');
Route::get('/get-plot-jadwal', [JadwalSidangController::class, 'getPlotJadwal'])->middleware('admin');
Route::get('/get-penguji-2', [JadwalSidangController::class, 'getPenguji2'])->middleware('admin');

Route::get('/export-jadwal-proposal', [JadwalProposalController::class, 'export'])->name('jadwal-proposal.export');
Route::get('/export-jadwal-skripsi', [JadwalSkripsiController::class, 'export'])->name('jadwal-skripsi.export');

Route::resource('jadwal-skripsi', JadwalSkripsiController::class);

//Jadwal - Kaprodi
Route::post('jadwal-proposal/update-status', [JadwalProposalController::class, 'updateStatus'])->name('jadwal-proposal.update-status')->middleware('kaprodi');
Route::post('jadwal-skripsi/update-status', [JadwalSkripsiController::class, 'updateStatus'])->name('jadwal-skripsi.update-status');
Route::post('jadwal-skripsi/update-pustaka', [JadwalSkripsiController::class, 'updatePustaka'])->name('jadwal-skripsi.update-pustaka');

Route::post('jadwal-sidang/update-done', [JadwalSidangController::class, 'updateDone'])->name('jadwal-sidang.update-done')->middleware('dosen');
Route::post('jadwal-sidang/revisi', [JadwalSkripsiController::class, 'revisi'])->name('jadwal-sidang.revisi')->middleware('dosen');
Route::post('jadwal-skripsi/upload-file', [JadwalSkripsiController::class, 'uploadFile'])->name('jadwal-skripsi.upload-file');
Route::get('jadwal-sidang/acc-dosen', [JadwalSkripsiController::class, 'accDosen'])->name('jadwal-skripsi.acc-dosen');

//Hasil - Dosen
Route::resource('hasil-proposal', HasilProposalController::class);
Route::get('/export-hasil-proposal', [HasilProposalController::class, 'export'])->name('hasil-proposal.export');
Route::get('/mass-export-hasil-proposal', [HasilProposalController::class, 'massExport'])->name('hasil-proposal.mass-export');

Route::resource('hasil-skripsi', HasilSkripsiController::class);
Route::get('/export-hasil-skripsi', [HasilSkripsiController::class, 'export'])->name('hasil-skripsi.export');
Route::get('/mass-export-hasil-skripsi', [HasilSkripsiController::class, 'massExport'])->name('hasil-skripsi.mass-export');