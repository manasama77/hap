<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockInSeq extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_in_seq',
        'seq',
    ];
}
