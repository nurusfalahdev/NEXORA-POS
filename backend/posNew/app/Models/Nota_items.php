<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota_items extends Model
{
    use SoftDeletes;
    protected $table = "nota_items";
    protected $guarded = [];


    public function nota()
    {
        return $this->belongsTo(Nota::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class,  'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
