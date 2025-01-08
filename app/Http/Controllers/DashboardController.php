<?php

namespace App\Http\Controllers;

use App\Models\BerkasSidangProposal;
use App\Models\BerkasSidangSkripsi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TopikModel;
use App\Models\DospemModel;
use App\Models\HasilProposal;
use App\Models\JadwalProposal;
use App\Models\JadwalSidang;
use App\Models\JadwalSkripsi;
use App\Models\PlotJadwal;
use Illuminate\Http\Request;
use App\Models\RekomendasiModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    public function dashboardMahasiswa()
    {
        if(Auth::check())
        { 
            $user = auth()->user();
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

            if ($mahasiswa) {
                // Fetch all rekomendasi records for the user
                $rekomendasi = RekomendasiModel::where('mahasiswa_id', $mahasiswa->id)->latest('created_at')->first();
                $topik = TopikModel::where('mahasiswa_id', $mahasiswa->id)->latest('created_at')->first();
                $dospem = DospemModel::where('mahasiswa_id', $mahasiswa->id)->latest('created_at')->first();
                $proposal = BerkasSidangProposal::where('id_pengajuan_dospem', $dospem->id ?? null)->latest('created_at')->first();
                $skripsi = BerkasSidangSkripsi::where('id_pengajuan_dospem', $dospem->id ?? null)->latest('created_at')->first();
                $jadwalProposal = JadwalProposal::whereHas('berkasProposal.pengajuanDospem', function($query){
                    $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
                })->latest('created_at')->first()->jadwalSidang ?? null;
                $jadwalSkripsi = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem', function($query){
                    $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
                })->latest('created_at')->first()->jadwalSidang ?? null;

                $hasilProposal = HasilProposal::whereHas('jadwalProposal.berkasProposal.pengajuanDospem', function($query){
                    $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
                })->count();

                $skripsiCond1 = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem', function($query){
                    $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
                })->whereHas('jadwalSidang', function($query){
                    $query->where('done', 1);
                })->latest('created_at')->first();

                $skripsiCond2 = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem', function($query){
                    $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
                })->where('status_revisi', 'Tidak Revisi')->latest('created_at')->first();

                $skripsiCond3 = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem', function($query){
                    $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
                })->whereNotNull('file_pengesahan')->first();

                $accSkripsi = JadwalSkripsi::whereHas('berkasSkripsi.pengajuanDospem', function($query) {
                    $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
                })
                ->where('acc_pembimbing_1', 1)
                ->where('acc_pembimbing_2', 1)
                ->where('acc_penguji_1', 1)
                ->where('acc_penguji_2', 1)
                ->where('acc_kaprodi', 1)
                ->where('bebas_pustaka', 1)
                ->whereHas('hasilSkripsiPembimbing')
                ->withCount('hasilSkripsiPenguji') // Add a count of the hasilSkripsiPenguji relation
                ->having('hasil_skripsi_penguji_count', '=', 2) // Ensure it has exactly 2
                ->latest('created_at')
                ->first();
            

                if(!$skripsiCond1){
                    $hasilSkripsi = 'unfinished';
                }elseif($skripsiCond1 && !$skripsiCond2 && !$skripsiCond3){
                    $hasilSkripsi = 'revisi';
                }elseif($skripsiCond1 && $skripsiCond2 && !$skripsiCond3){
                    $hasilSkripsi = 'pengesahan';
                }elseif($skripsiCond3 && !$accSkripsi){
                    $hasilSkripsi = 'pending';
                }elseif ($skripsiCond3 && $accSkripsi) {
                    $hasilSkripsi = 'selesai';
                }


            } else {
                $rekomendasi = null; // An empty collection if mahasiswa doesn't exist
                $topik = null;
                $dospem = null;
                $proposal = null;
                $skripsi = null;
                $jadwalProposal = null;
                $jadwalSkripsi = null;
                $hasilProposal = null;
            }
    
            return view('mahasiswa.dashboard', [
                'rekomendasi' => $rekomendasi,
                'topik' => $topik,
                'dospem' => $dospem,
                'proposal'=>$proposal,
                'skripsi'=>$skripsi,
                'jadwalProposal'=>$jadwalProposal,
                'jadwalSkripsi'=>$jadwalSkripsi,
                'hasilProposal'=> $hasilProposal < 3 ? 'belum' : 'sudah',
                'hasilSkripsi'=>$hasilSkripsi ?? 'unfinished'
            ]);
                
        }
        
        return redirect()->route('login')
            ->withErrors([
            'nim_nip' => 'Please login to access the dashboard.',
        ])->onlyInput('nim_nip');
    } 

    public function dashboardKaprodi()
    {
        if(Auth::check())
        { 
            $topik_pending = 0;
            $topik_disetujui = 0;
            $topik_ditolak = 0;
            $dospem_pending = 0;
            $dospem_disetujui = 0;
            $dospem_ditolak = 0;

            $topik_pending = TopikModel::where('status', 'Pending')->count();
            $topik_disetujui = TopikModel::where('status', 'Disetujui')->count();
            $topik_ditolak = TopikModel::where('status', 'Ditolak')->count(); 

            $dospem_pending = DospemModel::where('status', 'Pending')->orWhere('status','Disetujui')->count();
            $dospem_disetujui = DospemModel::where('status', 'Sah')->count();
            $dospem_ditolak = DospemModel::where('status', 'Ditolak')->count(); 

            $proposal_pending = JadwalSidang::whereHas('jadwalProposals')->where('status', 'Pending')->count();
            $proposal_disetujui = JadwalSidang::whereHas('jadwalProposals')->where('status', 'Disetujui')->count();
            $proposal_ditolak = JadwalSidang::whereHas('jadwalProposals')->where('status', 'Ditolak')->count();

            $hasilProposal_pending = JadwalProposal::whereHas('jadwalSidang', function($query){
                $query->where('done', 0);
                $query->where('status', 'Disetujui');
            })->count();

            $hasilProposal_selesai = JadwalProposal::whereHas('jadwalSidang', function($query){
                $query->where('done', 1);
                $query->where('status', 'Disetujui');
            })->count();

            $hasilSkripsi_pending = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('done', 1)->where('status', 'Disetujui');
            })->where('bebas_pustaka', 0)->count();

            $hasilSkripsi_selesai = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('done', 1);
                $query->where('status', 'Disetujui');
            })->where('bebas_pustaka', 1)->count();

            $jadwalSkripsi_pending = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Pending');     
            })->count();
            $jadwalSkripsi_disetujui = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Disetujui');
            })->count();
            $jadwalSkripsi_ditolak = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Ditolak'); 
            })->count();
    
            return view('kaprodi.dashboard', [
                'topik_pending' => $topik_pending,
                'topik_disetujui' => $topik_disetujui,
                'topik_ditolak' => $topik_ditolak,
                'dospem_pending' => $dospem_pending,
                'dospem_disetujui' => $dospem_disetujui,
                'dospem_ditolak' => $dospem_ditolak,
                'proposal_pending' => $proposal_pending,
                'proposal_disetujui' => $proposal_disetujui,
                'proposal_ditolak' => $proposal_ditolak,
                'jadwalSkripsi_pending' => $jadwalSkripsi_pending,
                'jadwalSkripsi_disetujui' => $jadwalSkripsi_disetujui,
                'jadwalSkripsi_ditolak' => $jadwalSkripsi_ditolak,
                'hasilProposal_pending' => $hasilProposal_pending,
                'hasilProposal_selesai' => $hasilProposal_selesai,
                'hasilSkripsi_pending' => $hasilSkripsi_pending,
                'hasilSkripsi_selesai' => $hasilSkripsi_selesai
            ]);
            $data = TopikModel::get();

            return view('kaprodi.dashboard', [
                'data' => $data
            ]);
                
        }
        
        return redirect()->route('login')
        ->withErrors([
            'nim_nip' => 'Please login to access the dashboard.',
        ])->onlyInput('nim_nip');
    } 

    public function dashboardDosen()
    {
        if(Auth::check())
        { 
            $user = auth()->user();
            $dosen = Dosen::where('user_id', $user->id)->first();
            $dosen_id = $dosen->id;
            
            $rekomendasi_pending = 0;
            $rekomendasi_disetujui = 0;
            $rekomendasi_ditolak = 0;
            $dospem_pending = 0;
            $dospem_disetujui = 0;
            $dospem_ditolak = 0;
        
            $rekomendasi_pending = RekomendasiModel::where('status', 'Pending')->where('dosenpa_id', $dosen_id)->count();            
            $rekomendasi_disetujui = RekomendasiModel::where('status', 'Disetujui')->where('dosenpa_id', $dosen_id)->count();
            $rekomendasi_ditolak = RekomendasiModel::where('status', 'Ditolak')->where('dosenpa_id', $dosen_id)->count(); 
    
            $dospem_pending = DospemModel::where('status', 'Pending')->where('dp1_id', $dosen_id)->count();
            $dospem_disetujui = DospemModel::where('status', 'Disetujui')->where('dp1_id', $dosen_id)->count();
            $dospem_ditolak = DospemModel::where('status', 'Ditolak')->where('dp1_id', $dosen_id)->count();
            
            $jadwal_tersedia = PlotJadwal::count();
            $jadwal_dipilih = JadwalSidang::where('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id)->orWhere('id_pembimbing', $dosen_id)->count();

            $jadwalProposal_pending = JadwalProposal::whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);
            })->whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('status', 'Pending');
            })->count();

            $jadwalProposal_disetujui = JadwalProposal::whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);
            })->whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('status', 'Disetujui');
            })->count();

            $jadwalProposal_ditolak = JadwalProposal::whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);
            })->whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('status', 'Ditolak');
            })->count();


            $jadwalSkripsi_pending = JadwalSkripsi::whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);
            })->whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('status', 'Pending');
            })->count();

            $jadwalSkripsi_disetujui = JadwalSkripsi::whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);
            })->whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('status', 'Disetujui');
            })->count();

            $jadwalSkripsi_ditolak = JadwalSkripsi::whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);  
            })->whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('status', 'Ditolak');
            })->count();

            $hasilProposal_pending = JadwalProposal::whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id)->where('status', 'Disetujui');
            })
            ->withCount('hasilProposal')
            ->having('hasil_proposal_count', '<', 3)->count();


            $hasilProposal_selesai = JadwalProposal::whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id)->where('status', 'Disetujui');
            })
            ->withCount('hasilProposal')
            ->having('hasil_proposal_count', '=', 3)->count();

            // $hasilSkripsi_pending = JadwalSkripsi::whereHas('jadwalSidang', function($query) use ($dosen_id){
            //     $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id)->where('status', 'Disetujui')->where('done', 1);
            // })
            // ->orWhereHas('berkasSkripsi.pengajuanDospem', function($query) use ($dosen_id){
            //     $query->where('dp2_id', $dosen_id);
            // })->where('bebas_pustaka', 0)->count();

            // $hasilSkripsi_selesai = JadwalSkripsi::whereHas('jadwalSidang', function($query) use ($dosen_id){
            //     $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);
            //     $query->where('status', 'Disetujui')->where('done', 1);
            // })
            // ->orWhereHas('berkasSkripsi.pengajuanDospem', function($query) use ($dosen_id){
            //     $query->where('dp2_id', $dosen_id);
            // })->where('bebas_pustaka', 1)->get();

            $hasilSkripsi_pending = JadwalSkripsi::where(function($query) use ($dosen_id){
                $query->whereHas('jadwalSidang', function($query) use ($dosen_id){
                    $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);
                });
                $query->orWhereHas('berkasSkripsi.pengajuanDospem', function($query) use ($dosen_id){
                    $query->where('dp2_id', $dosen_id);
                });
            })->whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('status', 'Disetujui')->where('done', 1);
            })->where('bebas_pustaka', 0)->count();

            $hasilSkripsi_selesai = JadwalSkripsi::where(function($query) use ($dosen_id){
                $query->whereHas('jadwalSidang', function($query) use ($dosen_id){
                    $query->where('id_pembimbing', $dosen_id)->orWhere('id_penguji_1', $dosen_id)->orWhere('id_penguji_2', $dosen_id);
                });
                $query->orWhereHas('berkasSkripsi.pengajuanDospem', function($query) use ($dosen_id){
                    $query->where('dp2_id', $dosen_id);
                });
            })->whereHas('jadwalSidang', function($query) use ($dosen_id){
                $query->where('status', 'Disetujui')->where('done', 1);
            })->where('bebas_pustaka', 1)->count();


            return view('dosen.dashboard', [
                'rekomendasi_pending' => $rekomendasi_pending,
                'rekomendasi_disetujui' => $rekomendasi_disetujui,
                'rekomendasi_ditolak' => $rekomendasi_ditolak,
                'dospem_pending' => $dospem_pending,
                'dospem_disetujui' => $dospem_disetujui,
                'dospem_ditolak' => $dospem_ditolak,
                'jadwal_tersedia' => $jadwal_tersedia,
                'jadwal_dipilih' => $jadwal_dipilih,
                'jadwalProposal_pending' => $jadwalProposal_pending,
                'jadwalProposal_disetujui' => $jadwalProposal_disetujui,
                'jadwalProposal_ditolak' => $jadwalProposal_ditolak,
                'jadwalSkripsi_pending' => $jadwalSkripsi_pending,
                'jadwalSkripsi_disetujui' => $jadwalSkripsi_disetujui,
                'jadwalSkripsi_ditolak' => $jadwalSkripsi_ditolak,
                'hasilProposal_pending' => $hasilProposal_pending,
                'hasilProposal_selesai' => $hasilProposal_selesai,
                'hasilSkripsi_pending' => $hasilSkripsi_pending,
                'hasilSkripsi_selesai' => $hasilSkripsi_selesai
            ]);
            $data = TopikModel::get();
         
            return view('dosen.dashboard', [
                'data' => $data
            ]);
                
        }
        
        return redirect()->route('login')
        ->withErrors([
            'nim_nip' => 'Please login to access the dashboard.',
        ])->onlyInput('nim_nip');
    } 

    // public function dashboardAdmin(){
    //     return view('admin.dashboard');
    // }

    public function dashboardAdmin()
    {
        if(Auth::check())
        { 
            $topik_pending = 0;
            $topik_disetujui = 0;
            $topik_ditolak = 0;

            $dospem_pending = 0;
            $dospem_disetujui = 0;
            $dospem_ditolak = 0;

            $rekomendasi_pending = 0;
            $rekomendasi_disetujui = 0;
            $rekomendasi_ditolak = 0;

            $berkasProposal_pending = 0;
            $berkasProposal_disetujui = 0;
            $berkasProposal_ditolak = 0;

            $berkasSkripsi_pending = 0;
            $berkasSkripsi_disetujui = 0;
            $berkasSkripsi_ditolak = 0;

            $jadwalProposal_pending = 0;
            $jadwalProposal_disetujui = 0;
            $jadwalProposal_ditolak = 0;

            $jadwalSkripsi_pending = 0;
            $jadwalSkripsi_disetujui = 0;
            $jadwalSkripsi_ditolak = 0;
          
        
            $rekomendasi_pending = RekomendasiModel::where('status', 'Pending')->count();            
            $rekomendasi_disetujui = RekomendasiModel::where('status', 'Disetujui')->count();
            $rekomendasi_ditolak = RekomendasiModel::where('status', 'Ditolak')->count(); 

            $topik_pending = TopikModel::where('status', 'Pending')->count();
            $topik_disetujui = TopikModel::where('status', 'Disetujui')->count();
            $topik_ditolak = TopikModel::where('status', 'Ditolak')->count(); 

            $dospem_pending = DospemModel::where('status', 'Pending')->orWhere('status','Disetujui')->count();
            $dospem_disetujui = DospemModel::where('status', 'Sah')->count();
            $dospem_ditolak = DospemModel::where('status', 'Ditolak')->count(); 

            $berkasProposal_pending = BerkasSidangProposal::where('status', 'Pending')->count();
            $berkasProposal_disetujui = BerkasSidangProposal::where('status', 'Disetujui')->count();
            $berkasProposal_ditolak = BerkasSidangProposal::where('status', 'Ditolak')->count();

            $berkasSkripsi_pending = BerkasSidangSkripsi::where('status', 'Pending')->count();
            $berkasSkripsi_disetujui = BerkasSidangSkripsi::where('status', 'Disetujui')->count();
            $berkasSkripsi_ditolak = BerkasSidangSkripsi::where('status', 'Ditolak')->count();

            $jadwalProposal_pending = JadwalProposal::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Pending');
            })->count();
            $jadwalProposal_disetujui = JadwalProposal::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Disetujui');
            })->count();
            $jadwalProposal_ditolak = JadwalProposal::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Ditolak'); 
            })->count();

            $jadwalSkripsi_pending = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Pending');     
            })->count();
            $jadwalSkripsi_disetujui = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Disetujui');
            })->count();
            $jadwalSkripsi_ditolak = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('status', 'Ditolak'); 
            })->count();

            $hasilProposal_pending = JadwalProposal::whereHas('jadwalSidang', function($query){
                $query->where('done', 0);
                $query->where('status', 'Disetujui');
            })->count();

            $hasilProposal_selesai = JadwalProposal::whereHas('jadwalSidang', function($query){
                $query->where('done', 1);
                $query->where('status', 'Disetujui');
            })->count();

            $hasilSkripsi_pending = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('done', 1);
                $query->where('status', 'Disetujui');
            })->where('bebas_pustaka', 0)->count();

            $hasilSkripsi_selesai = JadwalSkripsi::whereHas('jadwalSidang', function($query){
                $query->where('done', 1);
                $query->where('status', 'Disetujui');
            })->where('bebas_pustaka', 1)->count();
    
            return view('admin.dashboard', [
                'rekomendasi_pending' => $rekomendasi_pending,
                'rekomendasi_disetujui' => $rekomendasi_disetujui,
                'rekomendasi_ditolak' => $rekomendasi_ditolak,
                'topik_pending' => $topik_pending,
                'topik_disetujui' => $topik_disetujui,
                'topik_ditolak' => $topik_ditolak,
                'dospem_pending' => $dospem_pending,
                'dospem_disetujui' => $dospem_disetujui,
                'dospem_ditolak' => $dospem_ditolak,
                'berkasProposal_pending' => $berkasProposal_pending,
                'berkasProposal_disetujui' => $berkasProposal_disetujui,
                'berkasProposal_ditolak' => $berkasProposal_ditolak,
                'berkasSkripsi_pending' => $berkasSkripsi_pending,
                'berkasSkripsi_disetujui' => $berkasSkripsi_disetujui,
                'berkasSkripsi_ditolak' => $berkasSkripsi_ditolak,
                'jadwalProposal_pending' => $jadwalProposal_pending,
                'jadwalProposal_disetujui' => $jadwalProposal_disetujui,
                'jadwalProposal_ditolak' => $jadwalProposal_ditolak,
                'jadwalSkripsi_pending' => $jadwalSkripsi_pending,
                'jadwalSkripsi_disetujui' => $jadwalSkripsi_disetujui,
                'jadwalSkripsi_ditolak' => $jadwalSkripsi_ditolak,
                'hasilProposal_pending' => $hasilProposal_pending,
                'hasilProposal_selesai' => $hasilProposal_selesai,
                'hasilSkripsi_pending' => $hasilSkripsi_pending,
                'hasilSkripsi_selesai' => $hasilSkripsi_selesai,
            ]);

            // $data = TopikModel::get();

            // return view('admin.dashboard', [
            //     'data' => $data
            // ]);
                
        }
        
        return redirect()->route('loginAdmin')
        ->withErrors([
            'nim_nip' => 'Please login to access the dashboard.',
        ])->onlyInput('nim_nip');
    } 
}
