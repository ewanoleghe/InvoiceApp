<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'createdAt',
        'paymentDue',
        'description',
        'paymentTerms',
        'clientName',
        'clientEmail',
        'status',
        'senderAddress_street',
        'senderAddress_city',
        'senderAddress_postCode',
        'senderAddress_country',
        'clientAddress_street',
        'clientAddress_city',
        'clientAddress_postCode',
        'clientAddress_country',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(Items::class, 'invoice_id', 'invoice_id');
    }
}