<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\Models\User;
use App\Http\Requests\UserRequest;


class AdminController extends Controller
{
    public function add()
    {
        $this->pageData["page_title"] = "Add New Admin";
        $this->pageData["page_heading"] = "";
        $this->pageData["bc_title_1"] = "Admin List";
        $this->pageData["bc_title_2"] = "Add Admin";
        $this->pageData["bc_link_1"] = route('admin-list');

        return $this->showPage("back_end.admin.add_admin");
    }

    public function save(UserRequest $request)
    {
        $saveAdminRecord = User::create([
            "name" => trim($request->name),
            "email" => trim($request->email),
            "gender" => $request->gender,
            "user_role" => "admin",
            "country" => $request->country,
            "password" => Hash::make($request->password),
        ]);

        if ($saveAdminRecord && $request->hasfile('profile_pic')) {
            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $request->profile_pic->storeAs('images/profile_pic/' . $saveAdminRecord->id . "/", $filename);
            $saveAdminRecord->profile_pic = $filename;
            $saveAdminRecord->user_role = "admin";
            $saveAdminRecord->save();
            $sourcePath = storage_path('app/images/profile_pic/' . $saveAdminRecord->id  . "/");
            $this->createThumbnail($sourcePath, $filename);
        }
        if ($saveAdminRecord) {
            $this->setFormMessage('add-admin', "success", "Admin has been saved ");
        } else {
            $this->setFormMessage('add-admin', "danger", "Record does not exit");
        }
        return back();
    }

    public function list(Request $request)
    {
        $this->pageData["page_title"] = "Manage Admin ";
        $this->pageData["bc_title_1"] = "";
        $this->pageData["bc_title_2"] = "Admin List";
        $this->pageData["bc_link_1"] = "";

        $search_user = $request->search;
        $listCount = isset($request->limit) && !empty($request->limit) ? $request->limit : "5";

        $orderDirection = isset($_REQUEST['sort_dir']) && !empty($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "desc";
        $orderLabel = isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";

        $records = User::orderBy($orderLabel, $orderDirection);

        if ($search_user) {
            $records = $records->where("name", "LIKE", "%$search_user%")->orwhere("email", "LIKE", "%$search_user%");
        }
        $records = $records->where("user_role", "admin")->paginate($listCount);
        $this->pageData["admin_record"] = $records;

        return $this->showPage("back_end.admin.admin_list");
    }

    public function delete($id)
    {
        $deleteRow = User::find($id);
        $deleteRow->delete();
        if ($deleteRow) {
            $this->setFormMessage("delete-admin", "success", "Record has been deleted ");
        } else {
            $this->setFormMessage("delete-admin", "danger", "Record does not exit");
        }
        return back();
    }

    public function edit($id)
    {
        $this->pageData["page_title"] = "Update Admin ";
        $this->pageData["bc_title_1"] = "";
        $this->pageData["bc_title_2"] = "Update Admin";
        $this->pageData["bc_link_1"] = "";

        $editAdmin = User::where("id", $id)->first();

        $this->pageData["admin_record"] = $editAdmin;
        return $this->showPage("back_end.admin.update_admin");
    }

    public function updateAdminInfo(UserRequest $request, $id)
    {
        $updateAdminInfo = User::where("id", $id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "gender" => $request->gender,
        ]);
        if ($updateAdminInfo) {
            $this->setFormMessage('update-admin-info', "success", "Record has been updated");
        } else {
            $this->setFormMessage('update-admin-info', "danger", "Record does not exist");
        }
        return back();
    }

    public function updateAdminPass(UserRequest $request, $id)
    {
        $updateAdminPass = User::where("id", $id)->update([
            "password" => Hash::make($request->password),
        ]);

        if ($updateAdminPass) {
            $this->setFormMessage('update-admin-pass', "success", "Record has been updated");
        } else {
            $this->setFormMessage('update-admin-pass', "danger", "Record does not exist");
        }
        return redirect()->to(route("admin-edit", ["id" => $id]) . "#update-pass");
    }

    public function updateProfilePic(Request $request, $id)
    {
        $oldRow = User::find($id);
        $dataBaseProfilePicName = isset($oldRow->profile_pic) && !empty($oldRow->profile_pic) ? $oldRow->profile_pic : "";

        $row = User::find($id);
        if ($request->hasfile('profile_pic')) {
            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $request->profile_pic->storeAs('images/profile_pic/' . $id . "/", $filename);
            $row->profile_pic = $filename;
            $dataBaseUpdatedProfilePicName = $row->profile_pic;
            $row->save();
            $sourcePath = storage_path('app/images/profile_pic/' . $id . "/");
            if (isset($dataBaseProfilePicName) && !empty($dataBaseProfilePicName)) {
                if ($dataBaseProfilePicName != $dataBaseUpdatedProfilePicName) {
                    deleteProfilePicFromFolder($sourcePath, $dataBaseProfilePicName);
                }
            }
            $this->createThumbnail($sourcePath, $filename);
            $this->setFormMessage('update-admin-profile', "success", "Image has been updated");
        } else {
            $this->setFormMessage('update-admin-profile', "danger", "Please select image");
        }
        return redirect()->to(route("admin-edit", ["id" => $id]) . "#update-profile-pic");
    }

    public function deleteProfilePic($id)
    {
        $oldRow = User::find($id);
        $profilePic = $oldRow->profile_pic;

        $row = User::find($id);
        $row->profile_pic = "";
        $deletePic = $row->save();
        if(isset($deletePic)){
           // dd($profilePic);
            $path = storage_path('app/images/profile_pic/' . $id . "/");
            deleteProfilePicFromFolder($path, $profilePic);
            $this->setFormMessage("delete-admin-profile", "success", "Profile Pic has been deleted ");
        } else {
            $this->setFormMessage("delete-admin-profile", "danger", "Profile Pic does not exit");
        }
        return redirect()->to(route("back_end.admin-edit", ["id" => $id]) . "#update-profile-pic");
    }
}
