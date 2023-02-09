<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Models\Answer;
use App\Models\AnswerVotes;
use App\Models\BlockedKeyword;
use App\Models\Category;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionViewCount;
use App\Models\User;
use function Couchbase\defaultDecoder;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
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
        $searchBySearch = isset($request->search) && !empty($request->search) ? $request->search : "";
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";

        $sort = isset($request->sort) && !empty($request->sort) ? $request->sort : "Newest";
        $questionRecord = Question::select("questions.id as question_id", "questions.title", "questions.description", "questions.tags", "categories.category_name", "views", "total_no_of_ans",
            "questions.created_at", "users.name", "users.id", "users.profile_pic")
            ->join("users", "users.id", "questions.user_id")
            ->join("categories", "categories.id", "questions.category_id");
        if (isset($searchBySearch) && !empty($searchBySearch)) {
            $questionRecord = $this->fullTextSearch($questionRecord, ["questions.title", "questions.description"], $searchBySearch);
        }
        if (isset($searchByTitle) && !empty($searchByTitle)) {
            $questionRecord = $this->fullTextSearch($questionRecord, ["questions.title", "questions.description"], $searchByTitle);
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
        $this->pageData["page_title"] = "Question";

        $selectRandomQuestions = Question::select("questions.id as questions_id", "questions.title", "questions.created_at", "users.name", "users.id")
            ->join("users", "questions.user_id", "users.id")
            ->orderBy(DB::raw('RAND()'))
            ->paginate("3");

        $this->pageData["related_questions"] = $selectRandomQuestions;
        return $this->showPage("front_end.landing_page");

    }

    public function myQuestionList()
    {
        $id = isset(auth()->user()->id) && !empty(auth()->user()->id) ? auth()->user()->id : "";;
        $search = isset(request()->tag) && !empty(request()->tag) ? request()->tag : "";
        $limit = isset(request()->limit) && !empty(request()->limit) ? request()->limit : "10";
        $sort = isset(request()->sort) && !empty(request()->sort) ? request()->sort : "Newest";
        $searchBySlug = isset(request()->slug) && !empty(request()->slug) ? request()->slug : "";
        $searchByTitle = isset(request()->title) && !empty(request()->title) ? request()->title : "";

        $questionRecord = Question::select("questions.id as question_id", "questions.title", "questions.description", "questions.tags",
            "views", "total_no_of_ans", "questions.created_at", "users.name", "users.id", "users.profile_pic", "categories.category_name")
            ->join("users", "users.id", "questions.user_id")
            ->join("categories", "categories.id", "questions.category_id")
            ->where("questions.user_id", $id);
        if (isset($searchByTitle) && !empty($searchByTitle)) {
            $questionRecord = $this->fullTextSearch($questionRecord, ["questions.title", "questions.description"], $searchByTitle);
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

    public function updateQuestion(QuestionRequest $request, $id)
    {
        $updateQuestion = Question::where("id", $id);
        $title = langLimit("question-title-limit", $request->title);
        $description = langLimit("question-description-limit", $request->description);
        $checkBlockedWordsForTitle = checkBlockedKeyWord($request->title);
        $checkBlockedWordsForDescription = checkBlockedKeyWord($request->description);
        $tags = explode(",", $request->tags);
        $sizeOfArray = sizeof($tags);
        if (!$title) {
            return back()
                ->withErrors([
                    'limit' => 'English words exceed the limit!'
                ])->withInput();
        } elseif (!$description) {
            return back()
                ->withErrors([
                    'limit' => 'English words exceed the limit!'
                ])->withInput();
        } elseif ($checkBlockedWordsForTitle != null) {
            return back()
                ->withErrors([
                    'blocked_keyword_title' => "Can't use this '" . $checkBlockedWordsForTitle . "' word!",
                ])->withInput();
        } elseif ($checkBlockedWordsForDescription != null) {
            return back()
                ->withErrors([
                    'blocked_keyword' => "Can't use this '" . $checkBlockedWordsForDescription . "' word!",
                ])->withInput();
        } elseif ($sizeOfArray > 5) {
            return back()
                ->withErrors([
                    'tag_limit' => "Tags exceeds the limit",
                ])->withInput();
        } else {
            $updateQuestion = $updateQuestion->update(["title" => $request->title,
                "description" => $request->description,
                "parent_id" => $request->parent_cat,
                "category_id" => $request->cat,
                "tags" => $request->tags,]);
            if ($updateQuestion) {
                $this->setFormMessage('update-record', "success", "Question has been update ");
            } else {
                $this->setFormMessage('update-record', "danger", "Question does not exit");
            }
            return back();
        }
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
            $this->setFormMessage("delete-question_record", "success", "Record has been deleted ");
        } else {
            $this->setFormMessage("delete-question_record", "danger", "Record does not exit");
        }
        return back();
    }

    public function askQuestion()
    {
        $this->pageData["page_title"] = "Ask Question";
        $getCategoryList = Category::select("categories.*")->where("parent_id", "0")->get();
        $this->pageData["category_Record"] = $getCategoryList;
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

    public function saveQuestion(QuestionRequest $request)
    {
        $title = langLimit("question-title-limit", $request->title);
        $description = langLimit("question-description-limit", $request->description);
        $checkBlockedWordsForTitle = checkBlockedKeyWord($request->title);
        $checkBlockedWordsForDescription = checkBlockedKeyWord($request->description);
        $tags = explode(",", $request->tags);
        $sizeOfArray = sizeof($tags);

        if (!$title) {
            return back()
                ->withErrors([
                    'limit' => 'English words exceed the limit!'
                ])->withInput();
        } elseif (!$description) {
            return back()
                ->withErrors([
                    'limit' => 'English words exceed the limit!'
                ])->withInput();
        } elseif ($checkBlockedWordsForTitle != null) {
            return back()
                ->withErrors([
                    'blocked_keyword_title' => "Can't use this '" . $checkBlockedWordsForTitle . "' word!",
                ])->withInput();
        } elseif ($checkBlockedWordsForDescription != null) {
            return back()
                ->withErrors([
                    'blocked_keyword' => "Can't use this '" . $checkBlockedWordsForDescription . "' word!",
                ])->withInput();
        } elseif ($sizeOfArray > 5) {
            return back()
                ->withErrors([
                    'tag_limit' => "Tags exceeds the limit",
                ])->withInput();
        } else {
            $id = isset(auth()->user()->id) && !empty(auth()->user()->id) ? auth()->user()->id : "";
            $parentId = $request->parent_cat;
            $categoryId = $request->cat;
            $addQuestion = Question::create([
                "title" => $request->title,
                "description" => $request->description,
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
    }

    public function questionDetail(Request $request, $id)
    {
        $loggedUser = isset(auth()->user()->id) && !empty(auth()->user()->id) ? auth()->user()->id : "";
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
            $upVoteCheck = AnswerVotes::where("user_id", $loggedUser)->where("answer_id", $item->id)->where("vote_type", "vote up")->count();
            $downVoteCheck = AnswerVotes::where("user_id", $loggedUser)->where("answer_id", $item->id)->where("vote_type", "vote Down")->count();
            if ($upVoteCheck == 1) {
                $item["is_logged_user_vote_up"] = "Yes";
            } else {
                $item["is_logged_user_vote_up"] = "No";
            }
            if ($downVoteCheck == 1) {
                $item["is_logged_user_vote_down"] = "Yes";
            } else {
                $item["is_logged_user_vote_down"] = "No";
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

        $this->pageData["answer_record"] = $answerRecord;
        $questionRecord = Question::select("questions.*", "users.name", "users.profile_pic", "categories.category_name")
            ->join("users", "questions.user_id", "users.id")
            ->where("questions.id", $id)
            ->join("categories", "categories.id", "questions.category_id")
            ->first();
        $this->pageData["question_record"] = $questionRecord;
        $url = Route::currentRouteName();
        $shareComponent = \Share::page($url, 'share title')
            ->facebook();
        $this->pageData["share_component"] = $shareComponent;
        $this->pageData["page_title"] = Str::limit($questionRecord->title, "20");
        return $this->showPage("front_end.answers");
    }

    public function saveAnswer(QuestionRequest $request)
    {
        $questionId = request()->question_id;
        $answer = langLimit("answer-limit", $request->answer);
        $userId = isset(auth()->user()->id) && !empty(auth()->user()->id) ? auth()->user()->id : "";
        $checkBlockedWords = checkBlockedKeyWord($request->answer);
        if (!$answer) {
            return back()
                ->withErrors([
                    'answer_limit' => 'English words exceed the limit!'
                ])->withInput();
        } elseif ($checkBlockedWords != null) {
            return back()
                ->withErrors([
                    'blocked_keyword' => "Can't use this '" . $checkBlockedWords . "' word!",
                ])->withInput();
        } else {
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
    }

    public function updateAnswer(Request $request)
    {
        $ansId = $request->answer_id;
        $questionId = $request->question_id;
        $answer = langLimit("answer-limit", $request->update_answer);
        $checkBlockedWords = checkBlockedKeyWord($request->update_answer);
        if (!$answer) {
            return back()
                ->withErrors([
                    'answer_limit' => 'English words exceed the limit!'
                ])->withInput();
        } elseif ($checkBlockedWords != null) {
            return back()
                ->withErrors([
                    'blocked_keyword' => "Can't use this '" . $checkBlockedWords . "' word!",
                ])->withInput();
        } else {
            $updateRecord = Answer::where("question_id", $questionId)->where("id", $ansId)->update([
                "answer" => $request->update_answer
            ]);
            if ($updateRecord) {
                $this->setFormMessage("update-user-answer-" . $ansId, "success", "Your answer has been updated");
            } else {
                $this->setFormMessage("update-user-answer-" . $ansId, "danger", "Something is wrong");
            }

            return redirect()->to(route("answers-page", ["id" => $questionId]) . "#update-answer");
        }
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
