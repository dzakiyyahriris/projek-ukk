<?php

namespace App\Http\Controllers;

use App\Models\TipeTiket;
use App\Models\Acara; 
use Illuminate\Http\Request;

class TipeTiketController extends Controller
{
    protected $title = 'Tipe Tiket';

    public function index()
    {
        $tipeTiket = TipeTiket::with('acara')->latest()->get();
        return view('admin.tipe_tiket.index', [
            'title' => $this->title,
            'tipeTiket' => $tipeTiket,
        ]);
    }

    public function create()
    {
        $acara = Acara::all(['id_event', 'nama']);
        return view('admin.tipe_tiket.create', [
            'title' => $this->title,
            'acara' => $acara,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required|numeric|min:0',
        ]);

        TipeTiket::create($request->all());

        return redirect()->route('tipe_tiket.index')->with('success', 'Tipe Tiket berhasil ditambahkan!');
    }

    // === TAMBAHAN UNTUK MENGATASI ERROR ===
    public function show($id)
    {
        return redirect()->route('tipe_tiket.index');
    }
    // ======================================

    public function edit(TipeTiket $tipe_tiket)
    {
        $acara = Acara::all(['id_event', 'nama']);
        return view('admin.tipe_tiket.edit', [
            'title' => $this->title,
            'tipeTiket' => $tipe_tiket,
            'acara' => $acara,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'event_id' => 'required',
            'nama'     => 'required',
            'harga'    => 'required',
            'stok'     => 'required|numeric|min:0', 
        ]);

        $tipeTiket = TipeTiket::findOrFail($id); 
        $tipeTiket->update($request->all());

        return redirect()->route('tipe_tiket.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(TipeTiket $tipe_tiket)
    {
        $tipe_tiket->delete();
        return redirect()->route('tipe_tiket.index')->with('success', 'Tipe Tiket berhasil dihapus!');
    }
}