<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_out_id',
        'item_id',
        'qty',
        'temp_code',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function stockOut()
    {
        return $this->belongsTo(StockOut::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
