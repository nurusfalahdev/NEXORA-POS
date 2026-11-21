<?php

namespace App\Http\Controllers;

use App\Models\Tagihan_items;
use Illuminate\Http\Request;

class DatatagihanController extends Controller
{
    public function index()
    {
        $data = Tagihan_items::all();

        return view('tagihan.data_tagihan', compact('data'));
    }
}