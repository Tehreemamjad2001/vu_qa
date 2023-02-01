<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Http\Requests\OptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function langLimitList()
    {
        $this->pageData["page_title"] = "Lang Limit List";
        $this->pageData["bc_title_1"] = "";
        $this->pageData["bc_title_2"] = "Lang Limit List";
        $search = request()->search;
        $listCount = isset(request()->limit) && !empty(request()->limit) ? request()->limit : "5";
        $orderDirection = isset($_REQUEST['sort_dir']) && !empty($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "desc";
        $orderLabel = isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
        $row = Option::select("*")->orderBy($orderLabel, $orderDirection);
        if ($search) {
            $row = $row->where("key", "LIKE", "%$search%");
        }
        $row = $row->paginate($listCount);
        $this->pageData["option_record"] = $row;
        return $this->showPage("back_end.site_setting.site_setting");
    }

    public function edit($id)
    {
        $findRecord = Option::select("*")->where("id", $id)->first();
        $this->pageData["option_record"] = $findRecord;
        return $this->showPage("back_end.site_setting.update_site_setting");
    }

    public function update(OptionRequest $request, $id)
    {
        $updateRecord = Option::where("id", $id)->update([
            "value" => $request->percentage,
        ]);
        if ($updateRecord) {
            $this->setFormMessage('update-option', "success", "Record has been updated ");
        } else {
            $this->setFormMessage('update-option', "danger", "Record does not exit");
        }
        return back();
    }

    public function delete($id)
    {
        $row = Option::find($id);
        $row->delete();
        if ($row) {
            $this->setFormMessage("delete-option", "success", "Record has been deleted");
        } else {
            $this->setFormMessage("delete-option", "danger", "Record does not exit");
        }
        return back();
    }
}
