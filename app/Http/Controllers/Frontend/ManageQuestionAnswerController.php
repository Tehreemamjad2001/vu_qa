<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AnswerVotes;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionViewCount;
use App\Models\User;
use App\Models\UserIp;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use DB;

class ManageQuestionAnswerController extends Controller
{

    public function questionAnswerList(Request $request)
    {

        $routeName = Route::currentRouteName();

        if ($routeName == "my-question-page") {
            $id = auth()->user()->id;
            $search = isset($request->tag) && !empty($request->tag) ? $request->tag : "";
            $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";
            $sort = isset($request->sort) && !empty($request->sort) ? $request->sort : "";
            $questionRecord = Question::select("questions.title", "questions.description", "questions.tags","total_no_of_ans", "questions.created_at", "users.name", "users.id", "users.profile_pic")
                ->join("users", "users.id", "questions.user_id")->where("questions.user_id", $id);

            if (isset($search) && !empty($search)) {
                $questionRecord = $questionRecord->where("tags", $search);
            }
            if (isset($sort) && !empty($sort)) {
                if ($sort == "Newest") {
                    $questionRecord = $questionRecord->orderBy("questions.created_at", "desc");
                } elseif ($sort == "oldest") {
                    $questionRecord = $questionRecord->orderBy("questions.created_at", "asc");
                }
            } else {
                $questionRecord = $questionRecord->orderBy("questions.created_at", "desc");
            }
            $questionRecord = $questionRecord->paginate($limit);

            $this->pageData["question-Record"] = $questionRecord;
            $this->pageData["page_title"] = "My Question";
            return $this->showPage("front_end.my_question");
        }


        $search = isset($request->tag) && !empty($request->tag) ? $request->tag : "";
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";
        $sort = isset($request->sort) && !empty($request->sort) ? $request->sort : "";
        $questionRecord = Question::select("questions.id as question_id", "questions.title", "questions.description", "questions.tags", "views","total_no_of_ans",
            "questions.created_at", "users.name", "users.id", "users.profile_pic")
            ->join("users", "users.id", "questions.user_id");

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

        $this->pageData["page_title"] = "Public Question";

        return $this->showPage("front_end.landing_page");

    }

    public function askQuestion()
    {
        $this->pageData["page_title"] = "Ask Question";
        $getCategoryList = Category::select("categories.*")->where("parent_id", "0")->get();
        $this->pageData["category-Record"] = $getCategoryList;

        return $this->showPage("front_end.ask_question");
    }

    public function subCategory(Request $request)
    {

        $parentCat = $request->catId;
        $getSubCategoryList = Category::select("categories.*")->where("categories.parent_id", $parentCat)->get();

        return response()->json([
            "sub_cat" => $getSubCategoryList
        ], 200);
    }

    public function saveQuestion(Request $request)
    {
        $id = auth()->user()->id;
        $addQuestion = Question::insert([
            "title" => $request->title,
            "description" => $request->description,
            "user_id" => $id,
            "category_id" => $request->sub_cat,
            "tags" => $request->tags,
        ]);
        if ($addQuestion) {
            $this->setFormMessage('add-question', "success", "Question has been saved ");
        } else {
            $this->setFormMessage('add-question', "danger", "Question does not exit");
        }
        return back();
    }


    public function updateViewCount(Request $request, $id)
    {
        $clientIP = request()->ip();
        $insertIp = QuestionViewCount::firstOrNew([
            "ip" => $clientIP,
            "question_id" => $id,
        ]);
        $insertIp->save();
        $ViewsCount = $insertIp->where("question_id", $id)->count();
        $updateView = Question::where("id", $id);
        $updateView = $updateView->update([
            "views" => $ViewsCount,
        ]);


        $countTotalNumOfUsers = User::count();
        $this->pageData["no_of_user"] = $countTotalNumOfUsers;

        $countTotalNumOfQuestions = Question::count();
        $this->pageData["no_of_questions"] = $countTotalNumOfQuestions;

        $countTotalNumOfAnswers = Answer::count();
        $this->pageData["no_of_answer"] = $countTotalNumOfAnswers;

        $countTotalNumOfAcceptedAnswers = Answer::where('is_accepted', "true")->count();
        $this->pageData["no_of_accepted_answer"] = $countTotalNumOfAcceptedAnswers;


        $answerRecord = Answer::select("answers.*", "users.name", "users.profile_pic")
            ->join("questions", "answers.question_id", "questions.id")
            ->join("users", "answers.user_id", "users.id")
            ->where("answers.question_id", $id)
            ->paginate(2);
//dd($answerRecord);

        $articles = '';
        if ($request->ajax()) {
            $articles = view("front_end.components.answer_list")->with("answerRecord", $answerRecord)->render();
            return $articles;
        }


        $this->pageData["answer-record"] = $answerRecord;
        $questionRecord = Question::select("questions.*", "users.name", "users.profile_pic")
            ->join("users", "questions.user_id", "users.id")
            ->where("questions.id", $id)->first();
        //  dd($questionRecord);
        $this->pageData["question-record"] = $questionRecord;


        $this->pageData["page_title"] = "Answers";
        return $this->showPage("front_end.answers");
    }

    public function saveAnswer(Request $request)
    {
//dd($request);
        $id = request()->question_id;

        // dd($id);
        $insertAnswer = Answer::insert([
            "answer" => $request->answer,
            "question_id" => $request->question_id,
        ]);

        $totalNoOfAnswers = Answer::where("question_id", $id)->count();
        // dd($totalNoOfAnswers);
        $updateIntoQuestion = Question::where("id",$id);
        $updateIntoQuestion = $updateIntoQuestion->update([
            "total_no_of_ans" => $totalNoOfAnswers
        ]);
//dd($updateIntoQuestion);
        if ($insertAnswer) {
            $this->setFormMessage("save-answer", "success", "Your answer have been saved");
        } else {
            $this->setFormMessage("save-answer", "danger", "Something is wrong");
        }
        return redirect()->to(route("answers-page", ["id" => $id]) . "#save-answer");
    }

    public function answerVotes()
    {
        $ans_id = $_POST["ans_id"];
        $user_id = $_POST["user_id"];
        $voteType = $_POST["vote_type"];

        $addVote = AnswerVotes::insert([
            "user_id" => $user_id,
            "answer_id" => $ans_id,
            "vote_type" => $voteType,
        ]);


        $countUpVotes = AnswerVotes::select("vote_type")->where("vote_type", "vote Up")
            ->where("answer_id", $ans_id)->count();
        $countDownVotes = AnswerVotes::select("vote_type")->where("vote_type", "vote Down")
            ->where("answer_id", $ans_id)->count();

        $votes = Answer::where("id", $ans_id);
        $votes = $votes->update([
            "total_up_vote" => $countUpVotes,
            "total_down_vote" => $countDownVotes,
        ]);

        return response()->json([
            "up_vote" => $countUpVotes,
            "down_vote" => $countDownVotes,
            "answer_id" => $ans_id
        ], 200);


    }

    public function acceptedAnswer()
    {
        $ansId = $_POST["ans_id"];
        $successType = $_POST["success_type"];

        $acceptAns = Answer::where("id", $ansId);
        $acceptAns = $acceptAns->update([
//            "id" => $ansId,
//            "user_id" => $userId,
            "is_accepted" => $successType,
        ]);
        return response()->json([
            "accept_ans" => $acceptAns,
        ], 200);
    }

    public function totalNoOfAnswers()
    {
    }


}
