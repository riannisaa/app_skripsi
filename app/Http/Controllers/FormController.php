<?php

namespace App\Http\Controllers;

use App\Models\FormStatus;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $respon_rekom = FormStatus::where('form_id', 'rekom')->first()->accepting_responses;
        $respon_topik = FormStatus::where('form_id', 'topik')->first()->accepting_responses;
        $respon_dospem = FormStatus::where('form_id', 'dospem')->first()->accepting_responses;
        $respon_proposal = FormStatus::where('form_id', 'proposal')->first()->accepting_responses;
        $respon_skripsi = FormStatus::where('form_id', 'skripsi')->first()->accepting_responses;
        $respon_nilai_proposal = FormStatus::where('form_id', 'nilai_proposal')->first()->accepting_responses;
        $respon_nilai_skripsi = FormStatus::where('form_id', 'nilai_skripsi')->first()->accepting_responses;

        return view('admin.kelolaform', compact('respon_rekom', 'respon_topik', 'respon_dospem', 'respon_proposal', 'respon_skripsi', 'respon_nilai_proposal', 'respon_nilai_skripsi'));
    }

    public function statusRekom(Request $request)
    {
        $status = $request->status;
        $form = FormStatus::where('form_id', 'rekom')->first();

        $form->update([
            'accepting_responses' => $status

        ]);
          
        session()->flash('success', 'Status form pengajuan rekomendasi akademik berhasil diperbarui');

        return redirect()->back();
    }

    public function statusTopik(Request $request)
    {
        $status = $request->status;
        $form = FormStatus::where('form_id', 'topik')->first();

        $form->update([
            'accepting_responses' => $status

        ]);
    
        session()->flash('success', 'Status form pengajuan topik berhasil diperbarui');

        return redirect()->route('showForm');
    }

    public function statusDospem(Request $request)
    {   $form = $request->query('formId');
        $status = $request->status;
        $form = FormStatus::where('form_id', $form)->first();

        $form->update([
            'accepting_responses' => $status

        ]);

        session()->flash('success', 'Status form pengajuan dosen pembimbing berhasil diperbarui');

        return redirect()->back();
    }
    
}
