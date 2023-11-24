<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockIn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number',
        'vendor_id',
        'date_buy',
        'date_in',
        'po_number_vendor',
        'attachment',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function stockInItems()
    {
        return $this->hasMany(StockInItem::class);
    }
}
