<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryListController extends Controller
{
    public function categoryList(Request $request)
    {
        $searchByCategory = $request->category;
        $getCategory = Category::select("categories.category_name")->where("status", "1");
        if ($searchByCategory) {
            $getCategory = $getCategory->where("categories.category_name", "LIKE", "%$searchByCategory%");
        }

        $getCategory = $getCategory->paginate("12");
        $this->pageData["category_name"] = $getCategory;
        $this->pageData["page_title"] = "Category List";
        return $this->showPage("front_end.category_list");
    }




}
