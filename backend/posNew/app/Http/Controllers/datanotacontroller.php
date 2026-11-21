<?php

namespace App\Http\Controllers;

use App\Models\Nota_items;
use Illuminate\Http\Request;

class datanotacontroller extends Controller
{
    public function index()
    {
        $data = Nota_items::all();
        return view('invoice.data_invoice', compact('data'));
    }
}
