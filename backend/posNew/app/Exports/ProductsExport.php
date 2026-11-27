<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Enumerable;
class ProductsExport implements FromCollection, WithHeadings
{
   public function collection(): Enumerable
    {
        return Products::select(
            'kode',
            'nama',
            'ukuran',
            'harga',
            'satuan'
        )->get();
    }

    public function headings(): array
    {
        return [
            'kode',
            'nama',
            'ukuran',
            'harga',
            'satuan'
        ];
    }
}
