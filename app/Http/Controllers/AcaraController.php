<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AcaraController extends Controller
{
    protected $title = 'Acara';

    public function index(Request $request)
    {
        // 1. Mulai Query
        $query = Acara::query();

        // 2. LOGIKA YANG HILANG: Cek filter tanggal
        if ($request->has('tanggal') && $request->tanggal != null) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // 3. Ambil data (filter dulu, baru paginate)
        $acara = $query->latest()->paginate(10);

        // 4. Kirim ke View
        return view('admin.acara.index', compact('acara'));
    }
    // --- PERBAIKAN UTAMA DI SINI ---
    public function cetakPdf(Request $request)
    {
        // 1. Ambil data
        $query = Acara::query();

        if ($request->has('tanggal') && $request->tanggal != null) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $data_acara = $query->get();

        // 2. Load View PDF
        // UBAH BAGIAN INI (tambahkan _view)
        $pdf = Pdf::loadView('admin.acara.pdf_view', compact('data_acara'));

        // 3. Download
        return $pdf->download('laporan_data_acara.pdf');
    }

    public function create()
    {
        return view('admin.acara.create', [
            'title' => $this->title,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/acara'), $imageName);
            $imagePath = 'uploads/acara/' . $imageName;
        }

        Acara::create([
            'admin_id' => Auth::id(),
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('acara.index')->with('success', 'Data Acara berhasil ditambahkan!');
    }

    public function edit(Acara $acara)
    {
        return view('admin.acara.edit', [
            'title' => $this->title,
            'acara' => $acara,
        ]);
    }

    public function update(Request $request, Acara $acara)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
        ];

        if ($request->hasFile('image')) {
            if ($acara->image_path && File::exists(public_path($acara->image_path))) {
                File::delete(public_path($acara->image_path));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/acara'), $imageName);
            $data['image_path'] = 'uploads/acara/' . $imageName;
        }

        $acara->update($data);

        return redirect()->route('acara.index')->with('success', 'Data Acara berhasil diubah!');
    }

    public function destroy(Acara $acara)
    {
        if ($acara->image_path && File::exists(public_path($acara->image_path))) {
            File::delete(public_path($acara->image_path));
        }

        $acara->delete();

        return redirect()->route('acara.index')->with('success', 'Data Acara berhasil dihapus!');
    }
}
