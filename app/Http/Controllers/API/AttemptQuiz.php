<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Result;
use App\Question;
use App\Topic;
use Illuminate\Support\Facades\DB;

class AttemptQuiz extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    } 
    
    public function index()
    {
        //$this->authorize('isUser');
        $topics = Topic::all();
        return response()->json([
            'quiz'=>$topics
        ],200); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Result::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$this->authorize('isUser');
        
    }

    public function attempt_quiz($id){

        $quiz = DB::table('topics')
            ->join('questions', 'topics.id', '=', 'questions.topic_id')
            ->select('topics.title','topics.per_q_mark', 'questions.*')
            ->where('topics.deleted_at', NULL )
            ->where('questions.deleted_at', NULL)
            ->where('topics.id', '=', $id)
            ->orderby('topics.title')
            ->get();
        return response()->json([
                'quiz'=>$quiz
            ],200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
