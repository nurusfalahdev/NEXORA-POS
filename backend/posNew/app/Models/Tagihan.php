<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan extends Model
{
    use SoftDeletes;
    protected $table = "tagihan";
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo(Products::class, "products_id");
    }

    public function tagihan_items()
    {
        return $this->hasMany(Tagihan_items::class, 'tagihan_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(customer::class, "customer_id");
    }

    public static function nomor()
    {
        $prefix = 'TGH-';
        $periode = date('Ym'); // Contoh: 202607

        // Ambil nomor terakhir pada bulan yang sama
        $last = self::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->orderByDesc('id')
            ->first();

        if ($last) {
            // Ambil 3 digit terakhir
            $lastNumber = (int) substr($last->no_nota, -3);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . $periode . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }


}
