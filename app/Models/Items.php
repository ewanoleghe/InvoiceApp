<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'name',
        'quantity',
        'price',
        'total',
    ];
    
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
