<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequestSeq extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_request',
        'seq'
    ];
}
