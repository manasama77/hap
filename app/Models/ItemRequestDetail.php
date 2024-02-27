<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequestDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_request_id',
        'item_id',
        'item_sn_id',
        'qty',
        'qty_approved',
        'temp_code',
        'loan_item_id',
    ];

    public function itemRequest()
    {
        return $this->belongsTo(ItemRequest::class, 'item_request_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function itemSn()
    {
        return $this->belongsTo(ItemSn::class, 'item_sn_id');
    }
}
