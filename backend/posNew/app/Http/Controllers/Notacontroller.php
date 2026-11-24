<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Products;
use App\Models\Nota;
use App\Models\Nota_items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Notacontroller extends Controller
{
    public function index(Request $request)
    {
        // $customers = Customer::all();
        // $produks   = Products::all();

        // $produk = Nota::with('customer')->get();

        // $nomor = (new Nota)->nomor();


        // return view('invoice.index', compact(
        //     'produk',
        //     'customers',
        //     'produks',
        //     'nomor'
        // ));

        $nota = Nota::all();
        return response()->json([
            'success' => true,
            'message' => 'Data nota berhasil diambil',
            'data' => $nota
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $nota = Nota::create([
                'no_nota' => $request->no_nota,
                'tanggal' => $request->tanggal,
                'customer_id' => $request->customer_id,
                'keterangan' => $request->keterangan,
                'total' => $request->total,
            ]);

            foreach ($request->items as $item) {
                Nota_items::create([
                    'nota_id' => $nota->id,
                    'product_id' => $item['product_id'],
                    'kode' => $item['kode'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();
            toast()->success('Invoice berhasil di disimpan');
            return redirect()->route('invoice.index');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function update(Request $request, $id)
    {
        $nota = Nota::findOrFail($id);

        $nota->update([
            'tanggal' => $request->tanggal,
            'customer_id' => $request->customer_id,
            'keterangan' => $request->keterangan,
            'total' => $request->total,
        ]);

        $savedItemIds = [];

        foreach ($request->items as $item) {

            if (!empty($item['id'])) {

                $notaItem = Nota_items::find($item['id']);

                if ($notaItem) {

                    $notaItem->update([
                        'product_id' => $item['product_id'],
                        'kode' => $item['kode'],
                        'qty' => $item['qty'],
                        'harga' => $item['harga'],
                        'subtotal' => $item['subtotal'],
                    ]);

                    $savedItemIds[] = $notaItem->id;
                }
            } else {

                $newItem = $nota->items()->create([
                    'product_id' => $item['product_id'],
                    'kode' => $item['kode'],
                    'qty' => $item['qty'],
                    'harga' => $item['harga'],
                    'subtotal' => $item['subtotal'],
                ]);

                $savedItemIds[] = $newItem->id;
            }
        }

        $nota->items()
            ->whereNotIn('id', $savedItemIds)
            ->delete();

        toast()->success('Data berhasil di Update');
        return redirect()
            ->route('invoice.index');
    }

    public function destroy(string $id)
    {
        $nota = Nota::findOrFail($id);
        $nota->items()->delete();
        $nota->delete();
        toast()->success('Data berhasil dihapus');
        return redirect()->route('invoice.index');
    }


    public function print($id)
    {
        $print = Nota::with(['customer', 'items.product'])->findOrFail($id);

        return view('Print-invoice', compact('print'));
    }
}
