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
        return $this->showPage("front_end.category_list");
    }

    public function subcategoryList(Request $request)
    {

       $catId = isset($request->id) && !empty($request->id) ?$request->id: "";
        $searchByCategory = isset($request->category) && !empty($request->category) ? $request->category : "";

        $subCategory = Category::select("categories.id", "categories.icon","categories.slug" ,
            "categories.category_name","categories.total_no_of_questions_sc" )
            ->where("categories.parent_id", $catId);
        if ($searchByCategory) {
            $subCategory = $subCategory->where("categories.category_name", "LIKE", "%$searchByCategory%");
        }
        $subCategory = $subCategory->paginate("30");
        $this->pageData["category_name"] = $subCategory;
        $this->pageData["page_title"] = "Category List";
        return $this->showPage("front_end.category_list");
    }



}
