<?php

namespace App\Http\Controllers;

use App\Models\Headersrj;
use App\Models\ItemSrj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratJalanController extends Controller
{
    
    public function index()
    {
          
       $suratJalan = Headersrj::with('items')->get();
       return view('surat-jalan.index', compact('suratJalan'));
    }

    
    public function create()
    {
        return view('surat-jalan.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'TglBuat' => 'required|date',
            'NamaTujuan' => 'required|string|max:255',
            'AlamatTujuan' => 'required|string',
            'PerusahaanTujuan' => 'required|string|max:255',
            'items' => 'required|array|min:1', // Validasi minimal 1 item
            'items.*.NamaItem' => 'required|string|max:255',
            'items.*.WarnaItem' => 'required|string|max:255',
            'items.*.JumlahItem' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $header = Headersrj::create([
                'TglBuat' => $request->TglBuat,
                'NamaTujuan' => $request->NamaTujuan,
                'AlamatTujuan' => $request->AlamatTujuan,
                'PerusahaanTujuan' => $request->PerusahaanTujuan,
            ]);

            foreach ($request->items as $item) {
                $header->items()->create($item);
            }
        });

        return redirect()->route('surat-jalan.index')->with('success', 'Surat Jalan berhasil dibuat.');
    }

    
    public function show($id)
    {
        $sj = Headersrj::with('items')->findOrFail($id);
        return view('surat-jalan.show', compact('sj'));
    }

    
    public function edit($id)
    {
        $sj = Headersrj::with('items')->findOrFail($id);
        return view('surat-jalan.edit', compact('sj'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'TglBuat' => 'required|date',
            'NamaTujuan' => 'required|string|max:255',
            'AlamatTujuan' => 'required|string',
            'PerusahaanTujuan' => 'required|string|max:255',
            'items' => 'required|array|min:1', // Validasi minimal 1 item tetap berlaku
            'items.*.NamaItem' => 'required|string|max:255',
            'items.*.WarnaItem' => 'required|string|max:255',
            'items.*.JumlahItem' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $id) {
            $header = Headersrj::findOrFail($id);
            $header->update([
                'TglBuat' => $request->TglBuat,
                'NamaTujuan' => $request->NamaTujuan,
                'AlamatTujuan' => $request->AlamatTujuan,
                'PerusahaanTujuan' => $request->PerusahaanTujuan,
            ]);

            
            $header->items()->delete();
            foreach ($request->items as $item) {
                $header->items()->create($item);
            }
        });

        return redirect()->route('surat-jalan.index')->with('success', 'Surat Jalan berhasil diperbarui.');
    }

    
    public function destroy($id)
    {
        $header = Headersrj::findOrFail($id);
        $header->delete(); 

        return redirect()->route('surat-jalan.index')->with('success', 'Surat Jalan berhasil dihapus.');
    }
}
