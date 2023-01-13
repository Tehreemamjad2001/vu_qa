<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class CategoryListController extends Controller
{
    public function categoryList(Request $request)
    {
        $searchByCategory = $request->category;
        $getCategory = Category::select("categories.id", "categories.category_name")->where("status", "1");
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
        $subCategory = Category::select("categories.id", "categories.category_name")->where("categories.parent_id", $id);
        if ($searchByCategory) {
            $subCategory = $subCategory->where("categories.category_name", "LIKE", "%$searchByCategory%");
        }
        $subCategory = $subCategory->paginate("30");
        $this->pageData["sub-category"] = $subCategory;
        $this->pageData["page_title"] = "Category List";
        return $this->showPage("front_end.category.subcategory");
    }

    public function catQuestionList($id)
    {
        $questions = Question::select("questions.*")->where("questions.category_id", $id)->get();
        $this->pageData["question-record"] = $questions;
        return $this->showPage("front_end.category.category_questions_list");
    }


}
