<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Products;
use App\Models\Nota;
use App\Models\Nota_items;
use App\Models\Tagihan;
use App\Models\Tagihan_items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::all();
        $produks   = Products::all();

        $produk = Tagihan::with('customer')->get();

        $nomor = (new Tagihan)->nomor();


        return view('tagihan.index', compact(
            'produk',
            'customers',
            'produks',
            'nomor',
        ));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $nota = Tagihan::create([
                'no_nota'     => Tagihan::nomor(),
                'tanggal'     => $request->tanggal,
                'customer_id' => $request->customer_id,
                'keterangan'  => $request->keterangan,
                'total'       => $request->total,
            ]);

            foreach ($request->items as $item) {
                Tagihan_items::create([
                    'tagihan_id'=> $nota->id, // FIX
                    'product_id'=> $item['product_id'],
                    'kode'      => $item['kode'],
                    'qty'       => $item['qty'],
                    'harga'     => $item['harga'],
                    'subtotal'  => $item['subtotal'],
                ]);
            }

            DB::commit();
            toast()->success('Tagihan berhasil di disimpan');
            return redirect()->route('tagihan.index');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function update(Request $request, $id)
    {
        $nota = Tagihan::findOrFail($id);

        $nota->update([
            'tanggal'     => $request->tanggal,
            'customer_id' => $request->customer_id,
            'keterangan'  => $request->keterangan,
            'total'       => $request->total,
        ]);

        $savedItemIds = [];

        foreach ($request->items as $item) {

            if (!empty($item['id'])) {

                $notaItem = Tagihan_items::find($item['id']);

                if ($notaItem) {

                    $notaItem->update([
                        'product_id' => $item['product_id'],
                        'kode'       => $item['kode'],
                        'qty'        => $item['qty'],
                        'harga'      => $item['harga'],
                        'subtotal'   => $item['subtotal'],
                    ]);

                    $savedItemIds[] = $notaItem->id;
                }
            } else {

                $newItem = $nota->tagihan_items()->create([
                    'product_id' => $item['product_id'],
                    'kode'       => $item['kode'],
                    'qty'        => $item['qty'],
                    'harga'      => $item['harga'],
                    'subtotal'   => $item['subtotal'],
                ]);

                $savedItemIds[] = $newItem->id;
            }
        }

        $nota->tagihan_items()
            ->whereNotIn('id', $savedItemIds)
            ->delete();

        toast()->success('Data berhasil di Update');
        return redirect()
            ->route('tagihan.index');
    }

    public function destroy(String $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        $tagihan->tagihan_items()->delete();
        $tagihan->delete();

        toast()->success('Data berhasil dihapus');

        return redirect()->route('tagihan.index');
    }


    public function print($id)
    {
        $print = Tagihan::with(['customer', 'tagihan_items.product'])->findOrFail($id);

        return view('Print-tagihan', compact('print'));
    }
}
