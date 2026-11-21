<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota extends Model
{
    use SoftDeletes;
    protected $table = "notas";
    protected $guarded = [];


    public function products()
    {

        return $this->belongsTo(Products::class, "products_id");
    }

    public function nota_items()
    {
        return $this->hasMany(nota_items::class);
    }

    public function customer()
    {
        return  $this->belongsTo(customer::class, "customer_id");
    }

    public function items()
    {
        return $this->hasMany(Nota_items::class, 'nota_id');
    }

    public static function nomor()
    {
        $prefix = 'INV-';
        $tanggal = date('Ymd');

        $hitung = self::whereDate('created_at', date('Y-m-d'))->count() + 1;

        $nomor = $prefix . $tanggal . '-' . str_pad($hitung, 3, '0', STR_PAD_LEFT);

        return $nomor;
    }
}
