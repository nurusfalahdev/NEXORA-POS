<?php
namespace App\Imports;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?Model
    {
        if (empty($row['kode'])) {
            return null;
        }

        return new Products([
            'kode'   => $row['kode'],
            'nama'   => $row['nama'],
            'ukuran' => $row['ukuran'],
            'harga'  => $row['harga'],
            'satuan' => $row['satuan'],
        ]);
    }
}
