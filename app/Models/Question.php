<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Question extends Model
{

    use softDeletes;
    use HasFactory;
    protected $fillable = [
        '0',
        "title",
        "description",
        "user_id",
        "category_id",
        "parent_id",
        "tags",

    ];

    public function questionViewCount($id)
    {
        $clientIP = request()->ip();
        $insertIp = QuestionViewCount::firstOrNew([
            "ip" => $clientIP,
            "question_id" => $id,
        ]);
        $insertIp->save();

        $ViewsCount = QuestionViewCount:: where("question_id", $id)->count();
        $updateView = Question::where("id", $id);
        $updateView = $updateView->update([
            "views" => $ViewsCount,
        ]);
    }
}
