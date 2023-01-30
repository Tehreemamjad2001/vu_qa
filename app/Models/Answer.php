<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'answer',
        'question_id',
        'is_accepted',
        'user_id',
    ];
}
