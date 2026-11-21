<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        confirmDelete('Hapus Data', 'Apakah anda yakin ingin menghapus data ini ?', 'Hapus', 'Batal');
        return view('customer.index', compact('customer'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required',
        ], [
            'customer_id.required' => 'Harap Masukan Kode Customer',
            'nama.required' => 'Nama Diperlukan',
            'alamat.required' => 'Alamat Diperlukan',
            'no_tlp.required' => 'No Tlpon Diperlukan',
        ]);

        Customer::create($validated);
        toast()->success('Data Berhasil Di Tambahkan');
        return redirect()->route('master-data.toko.index');
    }

    public function update(Request $update, $id)
    {
        $validated = $update->validate([
            'customer_id' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required',
        ], [
            'customer.required' => 'Harap Masukan Kode Customer',
            'nama.required' => 'Nama Diperlukan',
            'alamat.required' => 'Alamat Diperlukan',
            'no_tlp.required' => 'No Tlpon Diperlukan',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validated);
        toast()->success('Data Berhasil Di Edit');
        return redirect()->route('master-data.toko.index');
    }

    public function destroy(String $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        toast()->success('Data Berhasil Di Hapus ');
        return redirect()->route('master-data.toko.index');
    }
}
