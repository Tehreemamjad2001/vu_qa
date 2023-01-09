<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnswerVotes extends Model
{
    public $table = "answer_votes";
    use SoftDeletes;
    use HasFactory;
}
