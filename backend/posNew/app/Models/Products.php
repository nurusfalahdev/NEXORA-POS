<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $table = "products";
    protected $guarded = [];


    public function notas()
    {
        return $this->hasMany(Nota::class, 'products_id');
    }

    public function tagihan()
    {
        return $this->HashMany(Tagihan::class, 'products_id');
    }
}
