<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $title = 'Users';
    protected $menu = 'users';
    protected $directory = 'admin.users';

    /**
     * Tampilan Daftar User dengan Filter Tanggal
     */
    public function index(Request $request)
    {
        // Mulai Query
        $query = User::query();

        // Logika Filter: Jika ada input 'tanggal', filter berdasarkan created_at
        if ($request->has('tanggal') && $request->tanggal != null) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // Ambil data (tambahkan pagination jika perlu, tapi get() aman untuk pdf)
        $users = $query->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function cetakPdf(Request $request)
    {
        // Logikanya SAMA PERSIS dengan index agar datanya sinkron
        $query = User::query();

        $title = 'Laporan Data Pengguna';

        if ($request->has('tanggal') && $request->tanggal != null) {
            $query->whereDate('created_at', $request->tanggal);
            $title .= ' - Tanggal ' . \Carbon\Carbon::parse($request->tanggal)->translatedFormat('d F Y');
        }

        $users = $query->latest()->get();

        // Load view khusus PDF
        $pdf = Pdf::loadView('admin.users.pdf', compact('users', 'title'));

        // Set ukuran kertas (opsional)
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-user.pdf');
    }
    public function create()
    {
        $data['title'] = 'Tambah User Baru';
        $data['menu'] = $this->menu;
        return view($this->directory . '.create', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        if ($user) {
            return redirect()->route('users.index')->with('success', 'Data Berhasil Ditambahkan!');
        }

        return redirect()->back()->with('error', 'Data Gagal Ditambahkan!');
    }

    public function edit(string $id)
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['user'] = User::findOrFail($id);

        return view($this->directory . '.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:5',
            'role' => 'required'
        ]);

        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        if ($user->update($updateData)) {
            return redirect()->route('users.index')->with('success', 'Data Berhasil Diubah!');
        }

        return redirect()->back()->with('error', 'Data Gagal Diubah!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', 'Data Berhasil Dihapus!');
        }

        return redirect()->route('users.index')->with('error', 'Data Gagal Dihapus!');
    }

    /**
     * --- BAGIAN CETAK PDF DATA USER ---
     * Fungsi ini sudah dibenarkan untuk mengambil data USER, bukan PESANAN.
     */
    // Di dalam UserController.php
    // app/Http/Controllers/UserController.php

    public function exportPdf(Request $request)
    {
        $query = \App\Models\User::query();
        $title = 'Laporan Data Pengguna';

        // Ambil data user
        $users = $query->latest()->get();

        // Memuat view yang baru saja dibuat
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.users.pdf', compact('users', 'title'));

        return $pdf->stream('laporan-user.pdf');
    }
}
