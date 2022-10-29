<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phishing extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'Phishing';

    protected $fillable = [
        'id',
        'url',
        'status',
        'disposition'
    ];
}
