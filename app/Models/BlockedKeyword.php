<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class BlockedKeyword extends Model
{
    public $table = "blocked_keywords";
    use softDeletes;
    use HasFactory;
    protected $fillable = [
        'keyword',
    ];
}
