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
    protected $fillable = [

        "user_id",
        "answer_id",
        "vote_type",

    ];

    public function answerVote($voteType, $ans_id)
    {
        $countVoteUp = AnswerVotes::where("vote_type", "vote Up")->where("answer_id", $ans_id)->count();
        $countVoteDown = AnswerVotes::where("vote_type", "vote Down")->where("answer_id", $ans_id)->count();
        if ($voteType == "vote Up") {
            $updateAnswerVoteCount = Answer::where("id", $ans_id)->update([
                "total_up_vote" => $countVoteUp,
            ]);
        } elseif ($voteType == "vote Down") {
            $updateAnswerVoteCount = Answer::where("id", $ans_id)->update([
                "total_down_vote" => $countVoteDown,
            ]);
        }
        return [
            "up_vote_count" => $countVoteUp,
            "down_vote_count" => $countVoteDown

        ];
    }
}
