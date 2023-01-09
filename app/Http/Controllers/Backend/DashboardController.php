<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function dashBoard()
    {

        $this->pageData["page_title"] = "Dashboard";
        $this->pageData["bc_title_1"] = "Dashboard";
        $this->pageData["bc_title_2"] = "";
        $this->pageData["bc_link_1"] = route('dashboard');
        $this->pageData["user_count"] = User::count();
        $this->pageData["category_count"] = category::count();

        return $this->showPage("back_end.dashboard");
    }

    public function login()
    {
        return $this->showPage("login");
    }




}
