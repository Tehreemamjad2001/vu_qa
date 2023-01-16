<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    public function list(Request $request)
    {

        $searchByQuestion = isset($request->question) && !empty($request->question) ? trim($request->question) : "";
        $searchByUser = isset($request->publish_by) && !empty($request->publish_by) ? trim($request->publish_by) : "";
        $searchByPublishAtFrom = isset($request->publish_at_from) && !empty($request->publish_at_from) ? $request->publish_at_from : "";
        $searchByPublishAtTo = isset($request->publish_at_to) && !empty($request->publish_at_to) ? $request->publish_at_to : "";
        $category = isset($request->category) && !empty($request->category) ? $request->category : "";

        $searchByIsBlocked = isset($request->is_blocked) && !empty($request->is_blocked)  ? $request->is_blocked : "";

        $listCount = isset($request->limit) && !empty($request->limit) ? $request->limit : "5";

        $orderDirection = isset($_REQUEST['sort_dir']) && !empty($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "desc";
        $orderLabel = isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";


        $records = Question::select("questions.*", "categories.category_name as category_name", "users.name as user_name")
            ->join("categories", "questions.category_id", "categories.id")
            ->join("users", "questions.user_id", "users.id");

        if ($searchByQuestion) {
            $records = $records->where("title", "LIKE", "%$searchByQuestion%");
        }
        if ($searchByUser) {
            $records = $records->where("users.name", "LIKE", "%$searchByUser%");
        }
        if ($searchByPublishAtFrom && $searchByPublishAtTo) {
            $records = $records->whereBetween("questions.created_at", [$searchByPublishAtFrom, $searchByPublishAtTo]);
        }
        if ($category) {
            $records = $records->where("questions.category_id", $category);
        }

        if(isset($searchByIsBlocked) && !empty($searchByIsBlocked)){
            if ($searchByIsBlocked == "no") {

                $records = $records->where("questions.is_blocked", 0);
            }elseif($searchByIsBlocked == "yes"){
                $records = $records->where("questions.is_blocked", 1);
            }
        }



        $records = $records->orderBy($orderLabel, $orderDirection)->paginate($listCount);
        $getCategoryFromCategories = Category::select("categories.id", "categories.category_name")->where("categories.parent_id", "0")->get();
        $this->pageData["parent_category"] = $getCategoryFromCategories;

        $getChildCategory = Category::select("categories.*")->join("categories as B", "categories.parent_id", "B.id")->get();
        $this->pageData["child_category"] = $getChildCategory;

        $this->pageData["question_record"] = $records;



        $this->pageData["page_title"] = "Manage Question ";
        $this->pageData["bc_title_1"] = "";
        $this->pageData["bc_title_2"] = "Question List";
        $this->pageData["bc_link_1"] = "";

        return $this->showPage("back_end.questions.question_list");
    }

    public function delete($id)
    {
        $deleteQuestionRow = Question::find($id);
        $deleteQuestionRow->delete();
        if ($deleteQuestionRow) {
            $this->setFormMessage("delete-question", "success", "Record has been deleted");
        } else {
            $this->setFormMessage("delete-question", "danger", "No record has been found");
        }
        return back();
    }

    public function edit($id)
    {
        $this->pageData["page_title"] = "Update Question ";
        $this->pageData["bc_title_1"] = "Question List";
        $this->pageData["bc_title_2"] = "Update Question";
        $this->pageData["bc_link_1"] = route('question-list');

        $getRow = Question::where("id", $id)->first();
        $this->pageData["question_record"] = $getRow;
        $getCategoryFromCategories = Category::select("categories.id", "categories.category_name")->where("categories.parent_id", "0")->get();
        $this->pageData["parent_category"] = $getCategoryFromCategories;
        $getChildCategory = Category::select("categories.*")->join("categories as B", "categories.parent_id", "B.id")->get();
        $this->pageData["child_category"] = $getChildCategory;

        return $this->showPage("back_end.questions.update_question");
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $updateRow = Question::where("id", $id);
        $updateRow->update([
           // "title" => Str::limit($request->title, 12),
            "title" => $request->title,
            "is_blocked" => $request->is_blocked,
            "category_id" => $request->category,
            "tags" => $request->tags
        ]);
        $this->pageData["question_record"] = $updateRow;
        if ($updateRow) {
            $this->setFormMessage("update-question", "success", "Record has been updated");
        } else {
            $this->setFormMessage("update-question", "danger", "No record has been found");
        }
        return back();
    }
}
