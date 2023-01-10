<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\Models\User;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    public function add()
    {
        $this->pageData["page_title"] = "Add New User ";
        $this->pageData["page_heading"] = "";
        $this->pageData["bc_title_1"] = "User List";
        $this->pageData["bc_title_2"] = "Add User";
        $this->pageData["bc_link_1"] = route('user-list');

        return $this->showPage("back_end.user.add_user");
    }

    public function list(Request $request)
    {
        $search_user = $request->search;
        $listCount = isset($request->limit) && !empty($request->limit) ? $request->limit : "5";
        $orderDirection = isset($_REQUEST['sort_dir']) && !empty($_REQUEST['sort_dir']) ? $_REQUEST['sort_dir'] : "desc";
        $orderLabel = isset($_REQUEST['sort']) && !empty($_REQUEST['sort']) ? $_REQUEST['sort'] : "id";
        $records = User::orderBy($orderLabel, $orderDirection);
        if ($search_user) {
            $records = $records->where("name", "LIKE", "%$search_user%")->orwhere("email", "LIKE", "%$search_user%");
        }
        $records = $records->where("user_role", "user")->paginate($listCount);
        $this->pageData["page_title"] = "Manage User ";
        $this->pageData["bc_title_1"] = "";
        $this->pageData["bc_title_2"] = "User List";
        $this->pageData["bc_link_1"] = "";

        $this->pageData["user_data"] = $records;

        return $this->showPage("back_end.user.user_list");
    }

    public function save(UserRequest $request)
    {
        $newUser = User::insert([
            "name" => trim($request->name),
            "email" => trim($request->email),
            "password" => Hash::make($request->password),
            "gender" => $request->gender,
            "user_role" => "user"
        ]);

        if ($newUser && $request->hasfile('profile_pic')) {
            $file = $request->file('profile_pic');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $request->profile_pic->storeAs('images/profile_pic/' . $newUser->id . "/", $filename);
            $newUser->profile_pic = $filename;
            $newUser->save();
            $sourcePath = storage_path('app/images/profile_pic/' . $newUser->id  . "/");
            $this->createThumbnail($sourcePath, $filename);
        }
        if ($newUser) {
            $this->setFormMessage('add-user', "success", "Record has been saved ");
        } else {
            $this->setFormMessage('add-user', "danger", "Record does not exit");
        }
        return back();
    }

    public function delete($id)
    {
        $delete_user = User::find($id);
        $delete_user->delete();
        if ($delete_user) {
            $this->setFormMessage("delete-user", "success", "Record has been deleted ");
        } else {
            $this->setFormMessage("delete-user", "danger", "Record does not exit");
        }
        return back();
    }

    public function edit($id)
    {
        $this->pageData["page_title"] = "Update User ";
        $this->pageData["bc_title_1"] = "Manage User";
        $this->pageData["bc_title_2"] = "Update User";
        $this->pageData["bc_link_1"] = route('user-list');

        $edit_user = User::where("id", $id)->first();

        $this->pageData["user_data"] = $edit_user;
        return $this->showPage("back_end.user.update_user");

    }

    public function Update(UserRequest $request, $id)
    {
        $row = User::find($id);
        if ($row) {
            $row->name = $request->name;
            $row->email = $request->email;
            $row->gender = $request->gender;
            $row->save();

            $this->setFormMessage('update-user-info', "success", "Record has been updated");
        } else {
            $this->setFormMessage('update-user-info', "danger", "Record does not exist");
        }
        return back();

    }

    public function updatePass(UserRequest $request, $id)
    {
        $row = User::find($id);
        if ($row) {

            $row->password = Hash::make($request->password);
            $row->save();

            $this->setFormMessage('update-user-pass', "success", "Password has been updated");
        } else {
            $this->setFormMessage('update-user-pass', "danger", "Something goes wrong");
        }
        return redirect()->to(route("user-edit", ["id" => $id]) . "#update-pass");
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
            $this->setFormMessage('update-user-profile', "success", "Image has been updated");
        } else {
            $this->setFormMessage('update-user-profile', "danger", "Please select image");
        }
        return redirect()->to(route("user-edit", ["id" => $id]) . "#update-profile-pic");
    }

    public function deleteProfilePic($id)
    {
        $oldRow = User::find($id);
        $profilePic = $oldRow->profile_pic;

        $row = User::find($id);
        $row->profile_pic = "";
        $deletePic = $row->save();
        if (isset($deletePic)) {
            $path = storage_path('app/images/profile_pic/' . $id . "/");
            deleteProfilePicFromFolder($path, $profilePic);
            $this->setFormMessage("delete-user-profile", "success", "Profile Pic has been deleted ");
        } else {
            $this->setFormMessage("delete-user-profile", "danger", "Profile Pic does not exit");
        }
        return redirect()->to(route("user-edit", ["id" => $id]) . "#update-profile-pic");
    }

}
