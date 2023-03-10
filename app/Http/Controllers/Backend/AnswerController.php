<?php

namespace App\Http\Controllers\Backend;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AnswerController extends Controller
{
    public function list(Request $request)
    {
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "30";
        $sortedBy = isset($request->sort) && !empty($request->sort) ? $request->sort : "id";
        $sortDir = isset($request->sort_dir) && !empty($request->sort_dir) ? $request->sort_dir : "asc";
        $searchByAnswer = isset($request->answer) && !empty($request->answer) ? $request->answer : "";
        $searchByQuestionId = isset($request->question_id) && !empty($request->question_id) ? $request->question_id : "";
        $searchByPublishAtFrom = isset($request->publish_at_from) && !empty($request->publish_at_from) ? $request->publish_at_from : "";
        $searchByPublishAtTo = isset($request->publish_at_to) && !empty($request->publish_at_to) ? $request->publish_at_to : "";
        $searchByIsAccepted = isset($request->is_accepted) && !empty($request->is_accepted) ? $request->is_accepted : "";

        $selectAnswer = Answer::select("answers.*");
        if ($searchByAnswer) {
            $selectAnswer = $selectAnswer->where("answer", "LIKE", "%$searchByAnswer%");
        }
        if ($searchByQuestionId) {
            $selectAnswer = $selectAnswer->where("question_id", "=", "$searchByQuestionId");
        }
        if ($searchByPublishAtFrom && $searchByPublishAtTo) {
            $selectAnswer = $selectAnswer->whereBetween("answers.created_at", [$searchByPublishAtFrom, $searchByPublishAtTo]);
        }
        if ($searchByIsAccepted) {
            $selectAnswer = $selectAnswer->where("answers.is_accepted", "=", "$searchByIsAccepted");
        }
        $selectAnswer = $selectAnswer->orderBy($sortedBy, $sortDir)->paginate($limit);
        $this->pageData["answer-record"] = $selectAnswer;
        return $this->showPage("back_end.answers.answer_list");
    }

    public function userAnswerList($id)
    {
        $limit = isset($request->limit) && !empty($request->limit) ? $request->limit : "30";
        $sortedBy = isset($request->sort) && !empty($request->sort) ? $request->sort : "id";
        $sortDir = isset($request->sort_dir) && !empty($request->sort_dir) ? $request->sort_dir : "asc";
        $searchByAnswer = isset($request->answer) && !empty($request->answer) ? $request->answer : "";
        $searchByQuestionId = isset($request->question_id) && !empty($request->question_id) ? $request->question_id : "";
        $searchByPublishAtFrom = isset($request->publish_at_from) && !empty($request->publish_at_from) ? $request->publish_at_from : "";
        $searchByPublishAtTo = isset($request->publish_at_to) && !empty($request->publish_at_to) ? $request->publish_at_to : "";
        $searchByIsAccepted = isset($request->is_accepted) && !empty($request->is_accepted) ? $request->is_accepted : "";

        $selectAnswer = Answer::select("answers.*")->where("question_id", $id);
        if ($searchByAnswer) {
            $selectAnswer = $selectAnswer->where("answer", "LIKE", "%$searchByAnswer% ");
        }
        if ($searchByQuestionId) {
            $selectAnswer = $selectAnswer->where("question_id", "=", "$searchByQuestionId");
        }
        if ($searchByPublishAtFrom && $searchByPublishAtTo) {
            $selectAnswer = $selectAnswer->whereBetween("answers.created_at", [$searchByPublishAtFrom, $searchByPublishAtTo]);
        }
        if ($searchByIsAccepted) {
            $selectAnswer = $selectAnswer->where("answers.is_accepted", "=", "$searchByIsAccepted");
        }
        $selectAnswer = $selectAnswer->orderBy($sortedBy, $sortDir)->paginate($limit);
        $this->pageData["answer-record"] = $selectAnswer;
        return $this->showPage("back_end.answers.answer_list");
    }

    public function edit($id)
    {
        $answerRecord = Answer::where("id", $id)->first();
        $this->pageData["answer-data"] = $answerRecord;
        return $this->showPage("back_end.answers.update_answer");
    }

    public function update(Request $request, $id)
    {
        $answer = langLimit("answer-limit", $request->answer);
        $checkBlockedWords = checkBlockedKeyWord($request->answer);
        if (!$answer) {
            return back()
                ->withInput()
                ->withErrors([
                    'answer_limit' => 'English words exceed the limit!'
                ]);
        } elseif ($checkBlockedWords != null) {
            return back()
                ->withInput()
                ->withErrors([
                    'blocked_keyword' => "Can't use this '" . $checkBlockedWords . "' word!",
                ]);
        } else {
            $updateAnswerRecord = Answer::find($id);
            $updateAnswerRecord->update([
                "answer" => $request->answer,
            ]);
            if ($request->is_accepted == "0") {
                $updateAnswerRecord->update([
                    "is_accepted" => "false",
                ]);
            }
            if ($request->is_accepted == "1") {
                $updateAnswerRecord->update([
                    "is_accepted" => "true",
                ]);
            }
            if ($updateAnswerRecord) {
                $this->setFormMessage("update-question", "success", "Answer have been updated");
            } else {
                $this->setFormMessage("update-question", "danger", "Something went wrong");
            }
            return back();
        }
    }

    public function delete($id)
    {
        $deleteAnswerRow = Answer::find($id);
        $deleteAnswerRow->delete();
        if ($deleteAnswerRow) {
            $this->setFormMessage("delete-answer", "success", "Record has been deleted");
        } else {
            $this->setFormMessage("delete-answer", "danger", "No record has been found");
        }
        return back();
    }
}
