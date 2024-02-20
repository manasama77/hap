<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date_request',
        'approval_by',
        'date_approval',
        'status',
        'note',
        'created_by',
        'updated_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function approvalBy()
    {
        return $this->belongsTo(User::class, 'approval_by');
    }

    public function itemRequestDetails()
    {
        return $this->hasMany(ItemRequestDetail::class, 'item_request_id');
    }
}
