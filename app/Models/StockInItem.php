<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_in_id',
        'item_id',
        'qty',
        'temp_code',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function stockIn()
    {
        return $this->belongsTo(StockIn::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
