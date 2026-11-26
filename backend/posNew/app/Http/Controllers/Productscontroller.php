<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class Productscontroller extends Controller
{
    public function index()
    {
        $produk = Products::all();

        return response()->json([
            'success' => true,
            'message' => 'Data produk berhasil diambil',
            'data' => $produk
        ], 200);
    }


    // public function store(Request $req)
    // {
    //     $validated = $req->validate([
    //         'kode' => 'required',
    //         'nama' => 'required',
    //         'ukuran' => 'required',
    //         'harga' => 'required',
    //         'satuan' => 'required',
    //     ], [
    //         'kode.required' => 'harap masukan kode',
    //         'nama.required' => 'harap masukan nama',
    //         'ukuran.required' => 'harap masukan ukuran',
    //         'harga.required' => 'harap masukan harga',
    //         'satuan.required' => 'harap masukan satuan',
    //     ]);
    //     Products::create($validated);
    //     toast()->success('Data Baru Berhasil Di Tambahkan');
    //     return redirect()->route('master-data.productsindex');
    // }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'kode' => 'required',
            'nama' => 'required',
            'ukuran' => 'required',
            'Harga' => 'required',
            'satuan' => 'nullable'
        ]);

        $produk = Products::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'produk berhasil di tambahkan',
            'data' => $produk
        ], 201);
    }


    // public function update(Request $update, $id)
    // {
    //     $validated = $update->validate([
    //         'kode' => 'required',
    //         'nama' => 'required',
    //         'ukuran' => 'required',
    //         'harga' => 'required',
    //         'satuan' => 'required',
    //     ], [
    //         'kode.required' => 'harap masukan kode',
    //         'nama.required' => 'harap masukan nama',
    //         'ukuran.required' => 'harap masukan ukuran',
    //         'harga.required' => 'harap masukan harga',
    //         'satuan.required' => 'harap masukan satuan',
    //     ]);
    //     $produk = Products::findOrFail($id);
    //     $produk->update($validated);
    //     toast()->success('Data Berhasil Di Edit');
    //     return redirect()->route('master-data.productsindex');
    // }



    public function update(Request $req, $id)
    {
        $validated = $req->validate([
            'kode' => 'required',
            'nama' => 'required',
            'ukuran' => 'required',
            'Harga' => 'required',
            'satuan' => 'required',
        ]);

        $produk = Products::findOrFail($id);

        $produk->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data produk berhasil diperbarui',
            'data' => $produk
        ], 200);
    }


    public function destroy(string $id)
    {
        $produk = Products::findOrFail($id);

        if (!$produk) {
            return response()->json([
                'success' => 'false',
                'message' => 'produk tidak di temukan'
            ], 404);
        }

        $produk->delete();
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }
}
