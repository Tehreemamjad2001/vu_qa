<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\UserRequest;
use App\Models\Answer;
use App\Models\AnswerVotes;
use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionViewCount;
use App\Models\User;
use function Couchbase\defaultDecoder;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Traits\Search;

class ManageQuestionAnswerController extends Controller
{
    use Search;

    public function questionAnswerList(Request $request)
    {
        $search = isset($request->tag) && !empty($request->tag) ? $request->tag : "";
        $searchBySlug = isset($request->slug) && !empty($request->slug) ? $request->slug : "";
        $searchByTitle = isset($request->title) && !empty($request->title) ? $request->title : "";
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";

        $sort = isset($request->sort) && !empty($request->sort) ? $request->sort : "Newest";
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

    public function myQuestionList()
    {
        $id = auth()->user()->id;
        $search = isset($request->tag) && !empty($request->tag) ? $request->tag : "";
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";
        $sort = isset(request()->sort) && !empty(request()->sort) ? request()->sort : "Newest";
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
        $this->pageData["question_Record"] = $questionRecord;
        $this->pageData["page_title"] = "My Question";
        $selectRandomQuestions = Question::select("questions.id as questions_id", "questions.title", "questions.created_at", "users.name", "users.id")
            ->join("users", "questions.user_id", "users.id")
            ->orderBy(DB::raw('RAND()'))
            ->paginate("3");

        $this->pageData["related_questions"] = $selectRandomQuestions;
        return $this->showPage("front_end.my_question");

    }

    public function editQuestion($id)
    {
        $question = Question::select("*")->where("questions.id", $id)->first();
        $this->pageData["question_data"] = $question;

        $getCategoryList = Category::select("categories.*")->where("parent_id", "0")->get();
        $this->pageData["category_Record"] = $getCategoryList;

        $parentCategoryId = $question->parent_id;
        $subCategoryList = Category::select("categories.*")->where("parent_id", $parentCategoryId)->get();
        $this->pageData["sub_category_Record"] = $subCategoryList;
        $this->pageData["page_title"] = "update question";
        return $this->showPage("front_end.update_login_user_question");
    }


    public function updateQuestion(UserRequest $request, $id)
    {
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
        $deleteRow = Question::find($id);
        $categoryId = isset($deleteRow->category_id) && !empty($deleteRow->category_id) ? $deleteRow->category_id : "";
        $parentId = isset($deleteRow->parent_id) && !empty($deleteRow->parent_id) ? $deleteRow->parent_id : "";
        $deleteRow->delete();

        if ($deleteRow) {

            $getSubCatTotalQuestionCount = Question::select("*")->where("category_id", $categoryId)->count();
            $parentCatQuestionCount = Question::select("*")->where("parent_id", $parentId)->count();
            $updateInCategory = Category::where("id", $categoryId)->orwhere("id", $parentId);
            $update = $updateInCategory->update([
                "total_no_of_questions_sc" => $getSubCatTotalQuestionCount,
                "total_no_of_questions" => $parentCatQuestionCount,
            ]);
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
        if ($addQuestion) {
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
            $this->setFormMessage('add-question', "success", "Question has been saved ");
        } else {
            $this->setFormMessage('add-question', "danger", "Question does not exit");
        }
        return back();
    }

    public function questionDetail(Request $request, $id)
    {
        $findRecord = QuestionViewCount::where("question_id", $id)->where("ip", request()->ip())->first();
        if ($findRecord == null) {
            $question = new Question;
            $question->questionViewCount($id);
        }

        $answerRecord = Answer::select("answers.*", "users.id as user_id", "users.name", "users.profile_pic")
            ->join("users", "answers.user_id", "users.id")
            ->where("answers.question_id", $id)
            ->orderBy("id", "desc")
            ->paginate(4);

        $finalResult = [];
        foreach ($answerRecord as $item) {
            $upVoteCheck = AnswerVotes::where("user_id", auth()->user()->id)->where("answer_id", $item->id)->where("vote_type", "vote up")->count();
            if ($upVoteCheck == 1) {
                $item["is_logged_user_vote_up"] = "Yes";
            } else {
                $item["is_logged_user_vote_down"] = "Yes";
            }
            $finalResult[] = $item;
        }

        $totalRecord = $answerRecord->total();
        $this->pageData['answer_total_record'] = $totalRecord;
        $perPage = $answerRecord->perPage();
        $this->pageData['answer_per_page'] = $perPage;

        $articles = '';
        if ($request->ajax()) {
            $articles = view("front_end.components.answer_list")->with("finalResult", $finalResult)->render();
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

        $this->pageData["answer_record"] = $finalResult;
        $questionRecord = Question::select("questions.*", "users.name", "users.profile_pic", "categories.category_name")
            ->join("users", "questions.user_id", "users.id")
            ->where("questions.id", $id)
            ->join("categories", "categories.id", "questions.category_id")
            ->first();
        $this->pageData["question_record"] = $questionRecord;

        $this->pageData["page_title"] = Str::limit($questionRecord->title, "20");
        return $this->showPage("front_end.answers");
    }

    public function saveAnswer(QuestionRequest $request)
    {
        $questionId = request()->question_id;
        $answer = langLimit($request->answer);
        $userId = auth()->user()->id;
        if (!$answer) {
            return redirect()->to(route("answers-page", ["id" => $questionId]) . "#error")
                ->withErrors(['answer_limit' => 'Usage of English words must be 20 %'])->withInput();

        }
        $insertAnswer = Answer::create([
            "answer" => $request->answer,
            "question_id" => $questionId,
            "user_id" => $userId,
        ]);
        if ($insertAnswer) {
            $totalNoOfAnswers = Answer::where("question_id", $questionId)->count();
            Question::where("id", $questionId)->update([
                "total_no_of_ans" => $totalNoOfAnswers
            ]);

            $this->setFormMessage("save-answer", "success", "Your answer have been saved");
        } else {
            $this->setFormMessage("save-answer", "danger", "Something is wrong");
        }

        return redirect()->to(route("answers-page", ["id" => $questionId]) . "#save-answer");
    }

    public function updateAnswer(Request $request)
    {
        $ansId = $request->answer_id;
        $questionId = $request->question_id;
        $answer = $request->answer;
        $updateRecord = Answer::where("question_id", $questionId)->where("id", $ansId)->update([
            "answer" => $answer
        ]);
        if ($updateRecord) {
            $this->setFormMessage("save-answer", "success", "Your answer have been saved");
        } else {
            $this->setFormMessage("save-answer", "danger", "Something is wrong");
        }

        return redirect()->to(route("answers-page", ["id" => $questionId]) . "#update-answer");
    }

    public function answerVotes()
    {
        $ans_id = $_REQUEST["ans_id"];
        $user_id = $_REQUEST["user_id"];
        $voteType = $_REQUEST["vote_type"];

        $checkRecordIfExist = AnswerVotes::select("*")->where("user_id", $user_id)
            ->where("answer_id", $ans_id)->first();
        if ($checkRecordIfExist == null) {
            $voteData = AnswerVotes::create([
                "user_id" => $user_id,
                "answer_id" => $ans_id,
                "vote_type" => $voteType,
            ]);
        } else {
            $record = AnswerVotes::where("user_id", $user_id)->where("answer_id", $ans_id)->update([
                "vote_type" => $voteType,
            ]);
            $ans = new AnswerVotes;
            $getCount = $ans->answerVote($voteType, $ans_id);

            return response()->json([
                "user_id" => $user_id,
                "answer_id" => $ans_id,
                "vote_type" => $voteType,
                "up_vote" => $getCount["up_vote_count"],
                "down_vote" => $getCount["down_vote_count"],

            ], 200);
        }
    }

    public function acceptedAnswer()
    {
        $ansId = $_REQUEST["ans_id"];
        $successType = $_REQUEST["success_type"];
        $questionId = $_REQUEST["question_id"];

        $acceptAns = Answer::where("question_id", $questionId)->update([
            "is_accepted" => Null
        ]);

        $updateAcceptAns = Answer::where("id", $ansId)->update([
            "is_accepted" => $successType,
        ]);
        return response()->json([
            "id" => $ansId,
            "accept_ans" => $acceptAns,
        ], 200);
    }


}
