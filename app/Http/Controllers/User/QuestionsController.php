<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;

use App\Models\Consultant;
use App\Models\Answer;

class QuestionsController extends Controller
{

    public function __construct(){
        $this->middleware("auth");
    }

    public function index(Request $request){
        return view("User.selectcat");
    }
    public function answers(Request $request){
        $questions=Consultant::where("id",auth()->user()->consultant_id)->with("questions")->first();
        return view("User.answers")->with("questions",$questions->questions);
    }
    public function counsellors(Request $request){
        $cons=Consultant::where("counsil_type",auth()->user()->question_type)->get();
        return view("User.counsellor")->with("consultants",$cons);
    }
    public function saveCategory(Request $request){

        $user=auth()->user();
        if($request->category==null){
            $errors = new MessageBag();
            $errors->add("category",'Select a category to continue'); 
            return redirect()->back()->withErrors($errors);
        }

        $user->question_type=$request->category;
        $user->update();
        return redirect()->route("questions-counsellors");
    }
    public function saveCounsellor(Request $request){

        $user=auth()->user();

        $user->consultant_id=$request->counsellor_id;
        $user->update();
        return redirect()->route("questions-answers");
    }

    public function saveAnswers(Request $request){
        $user=auth()->user();
        foreach ($request->all() as $key => $value) {
           if($key=="_token"){
                continue;
           }
           $answer=new Answer();
           $answer->question_id=(int)$key;
           $answer->answer=$value;
           $answer->user_id=$user->id;
           $answer->save();
        }
        $user->starter_progress=true;
        $user->update();

        return redirect()->route("home");
    }
}
