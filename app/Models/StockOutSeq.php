<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutSeq extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_out_seq',
        'seq',
    ];
}
