<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemSn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id',
        'sn',
        'mac',
        'teknisi_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class);
    }
}
