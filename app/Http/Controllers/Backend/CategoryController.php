<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function add()
    {
        $this->pageData["page_title"] = "Add New category ";
        $this->pageData["bc_title_1"] = "Category List";
        $this->pageData["bc_title_2"] = "Add Category";
        $this->pageData["bc_link_1"] = route('category-list');
        $listCategoryInSelectOption = category::where("parent_id", "0")->get();
        $this->pageData["category_record"] = $listCategoryInSelectOption;
        return $this->showPage("back_end.category.add_category");
    }

    public function save(CategoryRequest $request)
    {
        //dd($request);
        $insertCategory = Category::insert([
            "category_name" => trim($request->category_name),
            "parent_id" => $request->parent_id,
            "description" => Str::limit($request->description, 40),
            "icon" => $request->icon,
            "status" => $request->status,
        ]);
        if ($insertCategory) {
            $this->setFormMessage('add-category', "success", "Record has been saved ");
        } else {
            $this->setFormMessage('add-category', "danger", "Record does not exit");
        }
        return back();
    }

    public function list(Request $request)
    {
        $this->pageData["page_title"] = "Category List";
        $this->pageData["bc_title_1"] = "";
        $this->pageData["bc_title_2"] = "Category List";
        $this->pageData["bc_link_1"] = route('category-list');
        $searchCategory = $request->search;
        $listCount = isset($request->limit) && !empty($request->limit) ? $request->limit : "5";
        $orderDirection = isset($_REQUEST['sort_dir']) && !empty($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "desc";
        $orderLabel = isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
        $categoryRecord = Category::select(["categories.*", "B.category_name AS parent_name"])
            ->leftjoin("categories as B", "categories.parent_id", "B.id")->orderBy($orderLabel, $orderDirection);
        if ($searchCategory) {
            $categoryRecord = $categoryRecord->where("categories.category_name", "LIKE", "%$searchCategory%");
        }
        $categoryRecord = $categoryRecord->paginate($listCount);
        $this->pageData["category_record"] = $categoryRecord;
        return $this->showPage("back_end.category.list_category");
    }

    public function delete($id)
    {
        $row = category::find($id);
        $row->delete();
        if ($row) {
            $this->setFormMessage("delete-category", "success", "Record has been deleted ");
        } else {
            $this->setFormMessage("delete-category", "danger", "Record does not exit");
        }
        return back();
    }

    public function edit($id)
    {
        $this->pageData["page_title"] = "Update Category";
        $this->pageData["bc_title_1"] = "Category List";
        $this->pageData["bc_title_2"] = "Update category";
        $this->pageData["bc_link_1"] = route('category-list');
        $recordForCategoryEditPage = Category::where("id", $id)->first();
        $this->pageData["category_data"] = $recordForCategoryEditPage;
        $listCategoryInSelectOption = Category::where("parent_id", "0")->get();
        $this->pageData["category_record"] = $listCategoryInSelectOption;
        return $this->showPage("back_end.category.update_category");
    }

    public function update(Request $request, $id)
    {
        $updateCategory = Category::where("id", $id)->update([
            "category_name" => $request->category_name,
            "parent_id" => $request->parent_id,
            "description" => $request->description,
            "icon" => $request->icon,
            "status" => $request->status,
        ]);
        if ($updateCategory) {
            $this->setFormMessage('update-category', "success", "Record has been saved ");
        } else {
            $this->setFormMessage('update-category', "danger", "Record does not exit");
        }
        return back();
    }
}
