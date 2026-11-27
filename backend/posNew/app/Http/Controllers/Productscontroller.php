<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Products;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

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



    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240'
        ]);

        Excel::import(
            new ProductsImport,
            $request->file('file')
        );

        return response()->json([
            'success' => true,
            'message' => 'Data produk berhasil diimport!'
        ], 200);
    }


    public function exportExcel()
    {
        return Excel::download(
            new ProductsExport,
            'data_produk_nexora.xlsx'
        );
    }
}
