<?php
namespace App\Http\Controllers;

use App\Models\JenisLokasi;
use Illuminate\Http\Request;

class JenisLokasiController extends Controller
{
    public function index(Request $request)
    {
        $jenisLokasi = JenisLokasi::all();

        return view('JenisLokasi.index', compact('jenisLokasi'));
    }

    public function create()
    {
        return view('JenisLokasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'ikon' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $jenisLokasi = new JenisLokasi();
        $jenisLokasi->nama = $request->input('nama');
        $ikon = $request->file('ikon');
        $ikon->move(public_path('leaflet (1)/images'), $ikon->getClientOriginalName());
        $jenisLokasi->ikon = $ikon->getClientOriginalName();
        $jenisLokasi->save();

        return redirect()->route('JenisLokasi.index')->with('success', 'Data berhasil ditambahkan');
    }
    public function edit(JenisLokasi $jenisLokasi)
    {
        $jenisLokasi->find($jenisLokasi);
        return view('JenisLokasi.edit', compact('jenisLokasi'));
    }

    public function update(Request $request, JenisLokasi $jenisLokasi)
    {
        $jenisLokasi->nama = $request->input('nama');
        if ($request->file('ikon')) {
            $ikon = $request->file('ikon');
            $ikon->move(public_path('leaflet (1)/images'), $ikon->getClientOriginalName());
            $jenisLokasi->ikon = $ikon->getClientOriginalName();
        }
        $jenisLokasi->save();

        return redirect()->route('JenisLokasi.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(JenisLokasi $jenisLokasi)
    {
        $jenisLokasi->delete();

        return redirect()->route('JenisLokasi.index')->with('success', 'Data berhasil dihapus');
    }
}
