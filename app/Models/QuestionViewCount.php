<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionViewCount extends Model
{
    public $table = "question_views_count";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'ip',
        'question_id',


    ];
}
