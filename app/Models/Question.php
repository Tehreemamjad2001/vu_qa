<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Question extends Model
{

    use softDeletes;
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        '0',
        "title",
        "description",
        "user_id",
        "category_id",
        "parent_id" ,
        "tags" ,

    ];
}
