<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BlockedKeyword;
use App\Http\Requests\BlockedKeywordRequest;

class BlockedKeywordController extends Controller
{
    public function add()
    {
        $this->pageData["page_title"] = "Add New Blocked Keyword ";
        $this->pageData["bc_title_1"] = "Blocked Keyword List";
        $this->pageData["bc_title_2"] = "Add Blocked Keyword";
       $this->pageData["bc_link_1"] = route('blocked-keyword-list');
        return $this->showPage("back_end.blocked_keyword.add_blocked_keyword");
    }

    public function save(BlockedKeywordRequest $request)
    {
        $saveKeyword = BlockedKeyword::insert([
            "keyword" => $request->keyword
        ]);
        if($saveKeyword){
            $this->setFormMessage("add-keyword","success","Record has been saved");
        }else{
            $this->setFormMessage("add-keyword","success","Record has been saved");
        }
        return back();
    }

    public function list(Request $request)
    {
        $orderDirection = isset($_REQUEST['sort_dir']) && !empty($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "desc";
        $orderLabel = isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
        $keywordRecord = BlockedKeyword::orderBy($orderLabel, $orderDirection);
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "5";
        $searchKeyword =$request->search;
        if($searchKeyword){
            $keywordRecord = $keywordRecord->where("keyword","Like","%$searchKeyword%");
        }
        $keywordRecord = $keywordRecord->paginate($limit);

        $this->pageData["record"] = $keywordRecord;
        $this->pageData["page_title"] = "Blocked Keyword List";
        $this->pageData["bc_title_1"] = "";
        $this->pageData["bc_title_2"] = "Blocked Keyword List";
        return $this->showPage("back_end.blocked_keyword.blocked_keyword_list");
    }

    public function delete($id)
    {
        $deleteRecord = BlockedKeyword::find($id);
        $deleteRecord->delete();
        if($deleteRecord){
            $this->setFormMessage("delete-keyword","success","Record has been deleted");
        }else{
            $this->setFormMessage("delete-keyword","success","Record has been deleted");
        }
        return back();
    }
    public function edit($id){
        $this->pageData["page_title"] = "Update Blocked Keyword";
        $this->pageData["bc_title_1"] = "Blocked Keyword List";
        $this->pageData["bc_title_2"] = "Update Blocked Keyword";
        $this->pageData["bc_link_1"] = route('blocked-keyword-list');

        $getRecord =  BlockedKeyword::where("id",$id)->first();
        $this->pageData["record"] = $getRecord;
        return $this->showPage("back_end.blocked_keyword.update_blocked_keyword");
    }
    public function update(Request $request ,$id){
        $updateRecord = BlockedKeyword::where("id",$id);
        $updateRecord->update([
            "keyword" => $request->keyword
        ]);
        if($updateRecord){
            $this->setFormMessage("update-keyword","success","Record has been updated");
        }else{
            $this->setFormMessage("update-keyword","success","Record has been updated");
        }
        return back();
    }
}
