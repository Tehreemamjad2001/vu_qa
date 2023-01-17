<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class UserQuestionsListController extends Controller
{
    public function userQuestionsList($id)
    {
        $search = isset($request->tag) && !empty($request->tag) ? $request->tag : "";
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";
        $sort = isset($request->sort) && !empty($request->sort) ? $request->sort : "";
        $userName = User::select("name")->where("users.id", $id)->first();
        $this->pageData["user_name"] = $userName;
        $questionRecord = Question::select("questions.id as question_id", "questions.title", "questions.description", "questions.tags",
            "views", "total_no_of_ans", "questions.created_at", "users.name", "users.id", "users.profile_pic", "categories.category_name")
            ->join("users", "users.id", "questions.user_id")
            ->join("categories", "categories.id", "questions.category_id")
            ->where("questions.user_id", $id);
        if (isset($search) && !empty($search)) {
            $questionRecord = $questionRecord->where("tags", $search);
        }
        if (isset($sort) && !empty($sort)) {
            if ($sort == "Newest") {
                $questionRecord = $questionRecord->orderBy("questions.created_at", "desc");
            } elseif ($sort == "Oldest") {

                $questionRecord = $questionRecord->orderBy("questions.created_at", "asc");
            }
        } else {
            $questionRecord = $questionRecord->orderBy("questions.created_at", "desc");
        }

        $questionRecord = $questionRecord->paginate($limit);
        $this->pageData["question-Record"] = $questionRecord;

        $this->pageData["page_title"] = "User Questions";

        $countTotalNumOfUsers = User::count();
        $this->pageData["no_of_user"] = $countTotalNumOfUsers;

        $countTotalNumOfQuestions = Question::count();
        $this->pageData["no_of_questions"] = $countTotalNumOfQuestions;

        $countTotalNumOfAnswers = Answer::count();
        $this->pageData["no_of_answer"] = $countTotalNumOfAnswers;

        $countTotalNumOfAcceptedAnswers = Answer::where('is_accepted', "true")->count();
        $this->pageData["no_of_accepted_answer"] = $countTotalNumOfAcceptedAnswers;
        $selectRandomQuestions = Question::select("questions.id as questions_id", "questions.title", "questions.created_at", "users.name", "users.id")
            ->join("users", "questions.user_id", "users.id")
            ->orderBy(DB::raw('RAND()'))
            ->paginate("3");

        $this->pageData["related-questions"] = $selectRandomQuestions;

        return $this->showPage("front_end.my_question");
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user = $user->delete();
        return $this->showPage("front_end.auth.login_1");
    }
}