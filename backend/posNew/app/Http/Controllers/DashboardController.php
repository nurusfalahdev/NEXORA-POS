<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Products;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use App\Models\Tagihan_items;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data Produk Terjual (Chart 1)
        $produkterjual = DB::table('tagihan_items')
            ->join('products', 'tagihan_items.product_id', '=', 'products.id')
            ->select('products.nama', DB::raw('SUM(tagihan_items.qty) as total'))
            ->groupBy('products.id', 'products.nama')
            ->orderByDesc('total')
            ->get();

        // 2. Data Produk Kirim (Chart 2)
        $produkkirim = DB::table('nota_items')
            ->join('products', 'nota_items.product_id', '=', 'products.id')
            ->select('products.nama', DB::raw('SUM(nota_items.qty) as total'))
            ->groupBy('products.id', 'products.nama')
            ->orderByDesc('total')
            ->get();

        // Total Statistik Box
        $totalPendapatan = DB::table('tagihan')->sum('total');
        $totalproduk = Products::count();
        $totaltransaksi = Tagihan::count();
        $totalcustomer = Customer::count();

        // Kirim data dalam bentuk split pluck (Labels & Data) agar Blade tinggal pakai json_encode
        return view('dashboard.index', compact(
            'totalPendapatan',
            'totalproduk',
            'totaltransaksi',
            'totalcustomer',
            'produkterjual',
            'produkkirim'
        ))->with([
            'labelsTerjual' => $produkterjual->pluck('nama'),
            'dataTerjual'   => $produkterjual->pluck('total'),
            'labelsKirim'   => $produkkirim->pluck('nama'),
            'dataKirim'     => $produkkirim->pluck('total'),
        ]);
    }

    public function chartData(Request $request)
    {
        $bulan = $request->bulan;

        // Filter Terjual
        $produkterjual = DB::table('tagihan_items')
            ->join('products', 'tagihan_items.product_id', '=', 'products.id')
            ->select('products.nama', DB::raw('SUM(tagihan_items.qty) as total'))
            ->when($bulan, function ($q) use ($bulan) {
                $q->whereMonth('tagihan_items.created_at', $bulan);
            })
            ->groupBy('products.id', 'products.nama')
            ->orderByDesc('total')
            ->get();

        // Filter Kirim
        $produkkirim = DB::table('nota_items')
            ->join('products', 'nota_items.product_id', '=', 'products.id')
            ->select('products.nama', DB::raw('SUM(nota_items.qty) as total'))
            ->when($bulan, function ($q) use ($bulan) {
                $q->whereMonth('nota_items.created_at', $bulan);
            })
            ->groupBy('products.id', 'products.nama')
            ->orderByDesc('total')
            ->get();

        // SEKARANG LABELS DIPISAH SENDIRI-SENDIRI AGAR SINKRON
        return response()->json([
            'labels_terjual' => $produkterjual->pluck('nama'),
            'data_terjual'   => $produkterjual->pluck('total'),
            'labels_kirim'   => $produkkirim->pluck('nama'),
            'data_kirim'     => $produkkirim->pluck('total'),
        ]);
    }
}
