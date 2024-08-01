<?php

namespace Modules\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Sales\Database\Factories\InvoiceItemFactory;

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'invoice_id','name','description',
        'unit_cost','quantity','total'
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    protected static function newFactory(): InvoiceItemFactory
    {
        return InvoiceItemFactory::new();
    }
}
