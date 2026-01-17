<?php

namespace App\Http\Controllers;

use App\Models\Karakter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KarakterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy'
        ]);
    }

    // =========================
    // LIST (PUBLIK)
    // =========================
    public function index(Request $request)
    {
        $query = Karakter::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                  ->orWhere('game', 'like', '%'.$request->search.'%');
            });
        }

        $karakterList = $query->orderBy('kode')->get();
        return view('karakter.index', compact('karakterList'));
    }

    // =========================
    // DETAIL (PUBLIK)
    // =========================
    public function show($id)
    {
        $karakter = Karakter::findOrFail($id);
        return view('karakter.show', compact('karakter'));
    }

    // =========================
    // CREATE (ADMIN)
    // =========================
    public function create()
    {
        return view('karakter.create');
    }

    // =========================
    // STORE (UPLOAD)
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'kode'       => 'required|unique:karakters,kode',
            'nama'       => 'required|string|max:100',
            'game'       => 'required|string|max:100',
            'jenis'      => 'required|string|max:100',
            'foto'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'background' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'warna'      => 'required|string',
            'deskripsi'  => 'required|string',

            'foto'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'background' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $fotoPath = $request->file('foto')->store('karakter/foto', 'public');
        $bgPath   = $request->file('background')->store('karakter/background', 'public');

        Karakter::create([
            'kode'       => $request->kode,
            'nama'       => $request->nama,
            'game'       => $request->game,
            'jenis'      => $request->jenis,
            'warna'      => $request->warna,
            'deskripsi'  => $request->deskripsi,
            'foto'       => $fotoPath,
            'background' => $bgPath,
        ]);

        return redirect()->route('karakter.index')
            ->with('success','Karakter berhasil ditambahkan');
    }

    // =========================
    // EDIT (ADMIN)
    // =========================
    public function edit($id)
    {
        $karakter = Karakter::findOrFail($id);
        return view('karakter.edit', compact('karakter'));
    }

    // =========================
    // UPDATE (UPLOAD OPTIONAL)
    // =========================
    public function update(Request $request, $id)
    {
        $karakter = Karakter::findOrFail($id);

        $request->validate([
            'kode'       => 'required|unique:karakters,kode,'.$karakter->id,
            'nama'       => 'required|string|max:100',
            'game'       => 'required|string|max:100',
            'jenis'      => 'required|string|max:100',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'background' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'warna'      => 'required|string',
            'deskripsi'  => 'required|string',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($karakter->foto);
            $karakter->foto = $request->file('foto')->store('karakter','public');
        }

        if ($request->hasFile('background')) {
            Storage::disk('public')->delete($karakter->background);
            $karakter->background = $request->file('background')->store('background','public');
        }

        $karakter->update($request->except(['foto','background']));

        return redirect()->route('karakter.show',$karakter->id)
            ->with('success','Karakter berhasil diperbarui');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $karakter = Karakter::findOrFail($id);

        Storage::disk('public')->delete([
            $karakter->foto,
            $karakter->background
        ]);

        $karakter->delete();

        return redirect()->route('karakter.index')
            ->with('success','Karakter berhasil dihapus');
    }
}
