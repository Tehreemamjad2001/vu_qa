<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class CategoryListController extends Controller
{
    public function categoryList(Request $request)
    {
        $searchByCategory = $request->category;
        $getCategory = Category::select("categories.id", "categories.category_name", "categories.total_no_of_questions","categories.icon")
            ->where("categories.parent_id", "0")
            ->where("categories.status", "1");
        if ($searchByCategory) {
            $getCategory = $getCategory->where("categories.category_name", "LIKE", "%$searchByCategory%");
        }
        $getCategory = $getCategory->paginate("30");
        $this->pageData["category_name"] = $getCategory;

        $this->pageData["page_title"] = "Category List";
        return $this->showPage("front_end.category.category_list");
    }

    public function subcategoryList(Request $request, $id)
    {
        $searchByCategory = $request->category;
        $subCategory = Category::select("categories.id", "categories.icon", "categories.category_name","categories.total_no_of_questions_sc" )->where("categories.parent_id", $id);
        if ($searchByCategory) {
            $subCategory = $subCategory->where("categories.category_name", "LIKE", "%$searchByCategory%");
        }
        $subCategory = $subCategory->paginate("30");
        $this->pageData["sub-category"] = $subCategory;
        $this->pageData["page_title"] = "Category List";
        return $this->showPage("front_end.category.subcategory");
    }

    public function catQuestionList(Request $request, $id)
    {
        $selectRandomQuestions = Question::select("questions.title", "questions.created_at", "users.name")
            ->join("users", "questions.user_id", "users.id")
            ->orderBy(DB::raw('RAND()'))
            ->paginate("3");
        $this->pageData["related-questions"] = $selectRandomQuestions;

        $search = isset($request->tag) && !empty($request->tag) ? $request->tag : "";
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "10";
        $sort = isset($request->sort) && !empty($request->sort) ? $request->sort : "";
        $userName = User::select("name")->where("users.id", $id)->first();
        $this->pageData["user_name"] = $userName;
        $questionRecord = Question::select("questions.id as question_id", "questions.title", "questions.description", "questions.tags",
            "views", "total_no_of_ans", "questions.created_at", "users.name", "users.id", "users.profile_pic", "categories.category_name")
            ->join("users", "users.id", "questions.user_id")
            ->join("categories", "categories.id", "questions.category_id")
            ->where("questions.category_id", $id);
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
        $this->pageData["question-record"] = $questionRecord;

        $this->pageData["page_title"] = "User Questions";
        return $this->showPage("front_end.category.category_questions_list");
    }


}
