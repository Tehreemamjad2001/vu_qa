<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Question;
use Illuminate\Support\Facades\Crypt;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;


class ProfileSettingController extends Controller
{

    public function profileSetting()
    {
        $this->pageData["page_title"] = "Account Setting";
        return $this->showPage("front_end.profile_setting");
    }

    public function updateProfilePic(UserRequest $request, $id)
    {
        $oldRow = User::find($id);
        $dataBaseProfilePicName = isset($oldRow->profile_pic) && !empty($oldRow->profile_pic) ? $oldRow->profile_pic : "";
        $row = User::find($id);
        $row->name = $request->name;
        $row->country = $request->country;
        $row->comment = $request->about_me;
        $row->save();
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
            $this->setFormMessage('update-user-profile-pic', "success", "Profile Pic has been updated");
        }
        $this->setFormMessage('update-user-profile', "success", "Profiled has been updated");
        return back();
    }

    public function updateProfilePass(UserRequest $request, $id)
    {
        $updateAdminPass = User::where("id", $id)->update([
            "password" => Hash::make($request->password),
        ]);
        if ($updateAdminPass) {
            $this->setFormMessage('frontend-user-pass', "success", "Password has been updated");
        } else {
            $this->setFormMessage('frontend-user-pass', "danger", "Password does not exist");
        }
        return redirect()->to(route("profile-setting", ["id" => $id]) . "##change-password");
    }

    public function deleteUserProfilePic($id)
    {
        $oldRow = User::find($id);
        $profilePic = $oldRow->profile_pic;
        $row = User::find($id);
        $row->profile_pic = "";
        $deletePic = $row->save();
        if (isset($deletePic)) {
            $path = storage_path('app/images/profile_pic/' . $id . "/");
            deleteProfilePicFromFolder($path, $profilePic);
            $this->setFormMessage("delete-frontend-user-profile", "success", "Profile Pic has been deleted ");
        } else {
            $this->setFormMessage("delete-frontend-user-profile", "danger", "Profile Pic does not exit");
        }
        return redirect()->to(route("profile-setting", ["id" => $id]) . "#password-update");
    }

}
