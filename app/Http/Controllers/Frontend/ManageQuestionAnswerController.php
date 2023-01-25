<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Answer;
use App\Models\AnswerVotes;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionViewCount;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
use App\Traits\Search;

class ManageQuestionAnswerController extends Controller
{
    use Search;

    public function questionAnswerList(Request $request)
    {
        if (Auth::check()) {
            $id = auth()->user()->id;
            $search = isset($request->tag) && !empty($request->tag) ? $request->tag : "";
            $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";
            $sort = isset($request->sort) && !empty($request->sort) ? $request->sort : "";

            $searchBySlug = isset($request->slug) && !empty($request->slug) ? $request->slug : "";
            $searchByTitle = isset($request->title) && !empty($request->title) ? $request->title : "";


            $questionRecord = Question::select("questions.id as question_id", "questions.title", "questions.description", "questions.tags",
                "views", "total_no_of_ans", "questions.created_at", "users.name", "users.id", "users.profile_pic", "categories.category_name")
                ->join("users", "users.id", "questions.user_id")
                ->join("categories", "categories.id", "questions.category_id")
                ->where("questions.user_id", $id);
            if (isset($searchByTitle) && !empty($searchByTitle)) {
                $questionRecord = $questionRecord->where("title", $searchByTitle);
            }
            if (isset($search) && !empty($search)) {
                $questionRecord = $questionRecord->where("tags", $search);
            }
            if (isset($searchBySlug) && !empty($searchBySlug)) {
                $questionRecord = $questionRecord->where("slug", $searchBySlug);
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
            $this->pageData["page_title"] = "My Question";

            $selectRandomQuestions = Question::select("questions.id as questions_id", "questions.title", "questions.created_at", "users.name", "users.id")
                ->join("users", "questions.user_id", "users.id")
                ->orderBy(DB::raw('RAND()'))
                ->paginate("3");

            $this->pageData["related-questions"] = $selectRandomQuestions;

            return $this->showPage("front_end.my_question");
        }

        $search = isset($request->tag) && !empty($request->tag) ? $request->tag : "";
        $searchBySlug = isset($request->slug) && !empty($request->slug) ? $request->slug : "";
        $searchByTitle = isset($request->title) && !empty($request->title) ? $request->title : "";
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";

        $sort = isset($request->sort) && !empty($request->sort) ? $request->sort : "desc";
        $questionRecord = Question::select("questions.id as question_id", "questions.title", "questions.description", "questions.tags", "categories.category_name", "views", "total_no_of_ans",
            "questions.created_at", "users.name", "users.id", "users.profile_pic")
            ->join("users", "users.id", "questions.user_id")
            ->join("categories", "categories.id", "questions.category_id");
        if (isset($search) && !empty($search)) {
            $questionRecord = $questionRecord->where("tags", $search);
        }
        if (isset($searchBySlug) && !empty($searchBySlug)) {
            $questionRecord = $questionRecord->where("slug", $searchBySlug);

        }
        if (isset($searchByTitle) && !empty($searchByTitle)) {
//            $title = $this->scopeSearch($questionRecord, $searchByTitle);
//            $questionRecord = $questionRecord->where("title", $searchByTitle);
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
        return $this->showPage("front_end.landing_page");

    }

    public function editQuestion($id)
    {
        //dd($id);
        $question = Question::select("*")->where("questions.id", $id)->first();
        $this->pageData["question-data"] = $question;
        $getCategoryList = Category::select("categories.*")->where("parent_id", "0")->get();

        $this->pageData["category-Record"] = $getCategoryList;
//        $subCat = $getCategoryList->where("categories.id",$id)->get();
//        $this->pageData["sub-category-Record"] = $subCat;
        return $this->showPage("front_end.update_login_user_question");
    }


    public function updateQuestion(UserRequest $request, $id)
    {
       //dd($request);
        $updateQuestion = Question::where("id", $id);
        $title = langLimit($request->title);
        $description = langLimit($request->description);
        if ($title == "false" || $description == "false") {
            $this->setFormMessage('lang-limit', "danger", "English words exceed the limit! ");
            return back();
        }

        $updateQuestion = $updateQuestion->update([
            "title" => $title,
            "description" => $description,
            "parent_id" => $request->parent_cat,
            "category_id" => $request->cat,
            "tags" => $request->tags,
        ]);
        if ($updateQuestion) {
            $this->setFormMessage('update-record', "success", "Question has been update ");
        } else {
            $this->setFormMessage('update-record', "danger", "Question does not exit");
        }
        return back();
    }

    public function deleteQuestion($id)
    {
        //dd($id);
        $deleteRow = question::find($id);
        $deleteRow->delete();
        if ($deleteRow) {
            $this->setFormMessage("delete-question-record", "success", "Record has been deleted ");
        } else {
            $this->setFormMessage("delete-question-record", "danger", "Record does not exit");
        }
        return back();
    }

    public function askQuestion()
    {
        $this->pageData["page_title"] = "Ask Question";
        $getCategoryList = Category::select("categories.*")->where("parent_id", "0")->get();
        $this->pageData["category-Record"] = $getCategoryList;
        $this->pageData["page_title"] = "Ask Question";
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

    public function saveQuestion(UserRequest $request)
    {

        $title = langLimit($request->title);
        $description = langLimit($request->description);

        if ($title == "false") {
            dd("false");
            $this->setFormMessage('lang-limit', "danger", "English words exceed the limit! ");
            return back();
        }

        $id = auth()->user()->id;
        $parentId = $request->parent_cat;
        $categoryId = $request->cat;
        $addQuestion = Question::create([
            "title" => $title,
            "description" => $description,
            "user_id" => $id,
            "category_id" => $categoryId,
            "parent_id" => $parentId,
            "tags" => Str::words($request->tags, "5"),
        ]);
//dd($addQuestion);
        $totalQuestionAccordingParentCategory = Question::where("parent_id", $parentId)->count();
        $updateQuestionRecord = Category::where("id", $parentId);
        $updateQuestionRecord = $updateQuestionRecord->update([
            "total_no_of_questions" => $totalQuestionAccordingParentCategory,
        ]);
        $totalQuestionAccordingSubCategory = Question::where("category_id", $categoryId)->count();
        $updateQuestionRecord = Category::where("id", $categoryId);
        $updateQuestionRecord = $updateQuestionRecord->update([
            "total_no_of_questions_sc" => $totalQuestionAccordingSubCategory,
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
        $lastAnswer = Answer::select("*")->where("question_id", $id)->orderBy('id', 'desc')->limit("1")->first();
        $this->pageData['last-answer'] = $lastAnswer;
        $clientIP = request()->ip();
        $insertIp = QuestionViewCount::firstOrNew([
            "ip" => $clientIP,
            "question_id" => $id,
        ]);

        $insertIp->save();
        //  dd($insertIp);
        $ViewsCount = $insertIp->where("question_id", $id)->count();
        $updateView = Question::where("id", $id);
        $updateView = $updateView->update([
            "views" => $ViewsCount,
        ]);


        $answerRecord = Answer::select("answers.*"
            , "users.name", "users.profile_pic"
        )
            ->join("questions", "answers.question_id", "questions.id")
            ->where("answers.question_id", $id)
            ->join("users", "answers.user_id", "users.id")
            ->paginate(4);


        $totalRecord = $answerRecord->total();
        $this->pageData['answer-total-record'] = $totalRecord;
        $perPage = $answerRecord->perPage();
        $this->pageData['answer-per-page'] = $perPage;

        $articles = '';
        if ($request->ajax()) {
            $articles = view("front_end.components.answer_list")->with("answerRecord", $answerRecord)->render();
            $currentPage = $_GET['page'];
            $page = $perPage * $currentPage;
            if ($page < $totalRecord) {
                $button = "true";
            } else {
                $button = "false";
            }
            return response()->json([
                "view" => $articles,
                "button" => $button,
            ], 200);
        }


        $this->pageData["answer-record"] = $answerRecord;
        $questionRecord = Question::select("questions.*", "users.name", "users.profile_pic")
            ->join("users", "questions.user_id", "users.id")
            ->where("questions.id", $id)->first();
        $this->pageData["question-record"] = $questionRecord;

        $this->pageData["page_title"] = "Answers";
        return $this->showPage("front_end.answers");
    }

    public function saveAnswer(Request $request)
    {
        //dd($request);
        $id = request()->question_id;
        $answer = langLimit($request->answer);
        if ($answer == "false") {
            $this->setFormMessage('lang-limit', "danger", "English words exceed the limit! ");
            return back();
        }
        $insertAnswer = Answer::create([
            "answer" => $answer,
            "question_id" => $request->question_id,
        ]);

        $totalNoOfAnswers = Answer::where("question_id", $id)->count();
        $updateIntoQuestion = Question::where("id", $id);
        $updateIntoQuestion = $updateIntoQuestion->update([
            "total_no_of_ans" => $totalNoOfAnswers
        ]);
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

        $addVote = AnswerVotes::create([
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


}
