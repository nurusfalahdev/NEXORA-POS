<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tagihan_items extends Model
{
    use SoftDeletes;
    protected $table = "tagihan_items";
    protected $guarded = [];


    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'nama');
    }

    //   public function tagihan()
// {
//     return $this->belongsTo(
//         Tagihan::class,
//         'tagihan_id',
//         'id'
//     );
// }
}
