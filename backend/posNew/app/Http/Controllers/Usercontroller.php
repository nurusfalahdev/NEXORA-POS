<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    public function index()
    {
        $user = User::all();
        confirmDelete('Hapus User', 'Apakah andan yakin menghapus ini ?');
        return view("users.index", compact("user"));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'email|required',
            'name' => 'required',
        ], [
            'email.email' => 'Email wajib menggunakan @',
            'email.required' => 'Email wajib di isi',
            'name.required' => 'Nama wajib di isi',
        ]);

        $users = User::create($validasi);
        toast()->success('Data Berhasil Di tambahkan');
        return redirect()->route('users.index');
    }
}
