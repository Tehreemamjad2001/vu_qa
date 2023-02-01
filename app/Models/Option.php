<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;
    use HasFactory;

    function getValue($key)
    {
        $getRecord = $this->select("*")->where("key", $key)->first();
        return $getRecord->value;
    }
}
