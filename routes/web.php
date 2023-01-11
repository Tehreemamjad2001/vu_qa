<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BlockedKeywordController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\Backend\AnswerController;
use App\Http\Controllers\Frontend\CategoryListController;
use App\Http\Controllers\Frontend\ProfileSettingController;
use App\Http\Controllers\Frontend\ManageQuestionAnswerController;
use App\Http\Middleware\auth_admin;



Route::get("contact-us",function (){
    return view("front_end.contact_us");
})->name("contact-us");

Route::get("about-us",function (){
    return view("front_end.about_us");
})->name("about-us");

Auth::routes();
Route::get("/", [ManageQuestionAnswerController::class, "questionAnswerList"])->name('home');
Route::get("answers/{id}", [ManageQuestionAnswerController::class, "updateViewCount"])->name('answers-page');

Route::group([
    "middleware" => "auth"
], function () {

    Route::post("save-answer", [ManageQuestionAnswerController::class, "saveAnswer"])->name('save-answer');
    Route::Post("answer-votes", [ManageQuestionAnswerController::class, "answerVotes"]);
    Route::Post("accepted-answer", [ManageQuestionAnswerController::class, "acceptedAnswer"])->name("accepted-answer");
    Route::get("my-question", [ManageQuestionAnswerController::class, "questionAnswerList"])->name('my-question-page');
    Route::get("ask-question", [ManageQuestionAnswerController::class, "askQuestion"])->name('ask-question-page');
    Route::get("edit-question/{id}", [ManageQuestionAnswerController::class, "editQuestion"])->name('question-edit-page');
    Route::post("update-question/{id}", [ManageQuestionAnswerController::class, "updateQuestion"])->name('question-update-page');
    Route::get("delete-question/{id}", [ManageQuestionAnswerController::class, "deleteQuestion"])->name('question-delete-page');


    Route::post("save-question", [ManageQuestionAnswerController::class, "saveQuestion"])->name('save-question');
    Route::get("profile-setting/{id}", [ProfileSettingController::class, "profileSetting"])->name('profile-setting');
    Route::post("update-profile-pic/{id}", [ProfileSettingController::class, "updateProfilePic"])->name('update-profile-pic');
    Route::post("profile-pass-setting/{id}", [ProfileSettingController::class, "updateProfilePass"])->name('profile-pass-setting');
    Route::get("delete-user-profile-pic/{id}", [ProfileSettingController::class, "deleteUserProfilePic"])->name('delete-user-profile-pic');
    Route::get("category-list", [CategoryListController::class, "categoryList"])->name('frontend-category-list');
});


//Back-end Routes
Route::group([
    "prefix" => "admin",
    "middleware" => ["auth", "auth_admin"]

], function () {
    Route::get("dashboard", [DashboardController::class, "dashBoard"])->name('dashboard');
    Route::group([
        'prefix' => 'user',
        'as' => 'user-'
    ], function () {
        Route::get("add", [UserController::class, "add"])->name("add");
        Route::get("list", [UserController::class, "list"])->name("list");
        Route::get("edit/{id}", [UserController::class, "edit"])->name("edit");
        Route::post("update/{id}", [UserController::class, "update"])->name("update");
        Route::post("updatePass/{id}", [UserController::class, "updatePass"])->name("update-pass");
        Route::post("update-profile-pic/{id}", [UserController::class, "updateProfilePic"])->name("update-profile-pic");
        Route::post("save", [UserController::class, "save"])->name("save");
        Route::get("delete/{id}", [UserController::class, "delete"])->name("delete");
        Route::get("delete-profile-pic/{id}", [UserController::class, "deleteProfilePic"])->name("delete-profile-pic");
    });

    Route::group([
        'prefix' => "admin",
        'as' => 'admin-'
    ], function () {
        Route::get("add-admin", [AdminController::class, "add"])->name("add");
        Route::get("admin-list", [AdminController::class, "list"])->name("list");
        Route::get("edit-admin/{id}", [AdminController::class, "edit"])->name("edit");
        Route::post("update-info/{id}", [AdminController::class, "updateAdminInfo"])->name("update");
        Route::post("update-pass/{id}", [AdminController::class, "updateAdminPass"])->name("update-pass");
        Route::post("save-admin", [AdminController::class, "save"])->name("save");
        Route::get("delete-admin/{id}", [AdminController::class, "delete"])->name("delete");
        Route::post("update-profile-pic/{id}", [AdminController::class, "updateProfilePic"])->name("update-profile-pic");
        Route::get("delete-profile-pic/{id}", [AdminController::class, "deleteProfilePic"])->name("delete-profile-pic");
    });

    Route::group([
        'prefix' => "category",
        'as' => "category-",
    ], function () {
        Route::get("add-category", [CategoryController::class, "add"])->name("add");
        Route::post("save/{id}", [CategoryController::class, "save"])->name("save");
        Route::get("list", [CategoryController::class, "list"])->name("list");
        Route::get("delete/{id}", [CategoryController::class, "delete"])->name("delete");
        Route::get("edit/{id}", [CategoryController::class, "edit"])->name("edit");
        Route::post("update/{id}", [CategoryController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "blocked-keyword",
        "as" => "blocked-keyword-"
    ], function () {
        Route::get("add-keyword", [BlockedKeywordController::class, "add"])->name("add");
        Route::get("keyword-list", [BlockedKeywordController::class, "list"])->name("list");
        Route::post("keyword-save", [BlockedKeywordController::class, "save"])->name("save");
        Route::get("keyword-delete/{id}", [BlockedKeywordController::class, "delete"])->name("delete");
        Route::get("keyword-edit/{id}", [BlockedKeywordController::class, "edit"])->name("edit");
        Route::post("keyword-update/{id}", [BlockedKeywordController::class, "update"])->name("update");
    });

    Route::group([
        "prefix" => "question",
        "as" => "question-"
    ], function () {
        Route::get("question-list", [QuestionController::class, "list"])->name("list");
        Route::get("question-delete/{id}", [QuestionController::class, "delete"])->name("delete");
        Route::get("question-edit/{id}", [QuestionController::class, "edit"])->name("edit");
        Route::post("question-update/{id}", [QuestionController::class, "update"])->name("update");
    });


    Route::group([
        "prefix" => "answer",
        "as" => "answer-"
    ], function () {
        Route::get("answer-list", [AnswerController::class, "list"])->name("list");
       Route::get("answer-edit/{id}", [AnswerController::class, "edit"])->name("edit");
       Route::post("answer-update/{id}", [AnswerController::class, "update"])->name("update");
        Route::get("question-delete/{id}", [QuestionController::class, "delete"])->name("delete");
    });


});







