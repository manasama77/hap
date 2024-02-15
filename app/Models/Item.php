<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_item_id',
        'tipe_item_id',
        'name',
        'unit',
        'qty',
        'photo',
        'has_sn',
        'in_warehouse',
        'teknisi_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function category_item()
    {
        return $this->belongsTo(CategoryItem::class);
    }

    public function tipe_item()
    {
        return $this->belongsTo(TipeItem::class);
    }

    public function stock_in_items()
    {
        return $this->hasMany(StockInItem::class);
    }

    public function created_by_name()
    {
        return $this->belongsTo(User::class);
    }

    public function updated_by_name()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deleted_by_name()
    {
        return $this->belongsTo(User::class);
    }

    public function getHasSnTextAttribute()
    {
        return $this->has_sn == 1 ? 'Yes' : 'No';
    }
}
