<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockOut extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number',
        'title',
        'type',
        'date_out',
        'attachment',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function created_by_name()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by_name()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function stockOutItems()
    {
        return $this->hasMany(StockOutItem::class);
    }
}
