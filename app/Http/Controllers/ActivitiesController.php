<?php

namespace App\Http\Controllers;

use App\Activities;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        $activities = Activities::whereNull('start_date')
            ->whereNull('deleted_at')
            ->get();
        return view('activity')->with('data', $activities);
    }

    public function createActivities(Request $request)
    {
        $submit = $request->all();

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $activities = new Activities();
        $activities->code = str_random(4);
        $activities->name = $submit['title'];
        $activities->description = $submit['description'];
        $activities->type = "active";
        $activities->save();

        return redirect(route('home'))->with('new_token', csrf_token());
    }

    public function updateActivities(Request $request, $id)
    {

    }

    public function deleteActivities(Request $request, $id)
    {
        $activities = Activities::find($id);
        $activities->delete();

        return redirect(route('home'))->with('new_token', csrf_token());
    }

    public function updateDoneActivities(Request $request)
    {
        $data = $request->all();
        $activities = Activities::find($data["id"]);
        $activities->type = "non-active";
        $activities->save();

        return response()->json(["success" => true, "message" => "updated"]);
    }
}
