<?php

namespace App\Http\Controllers\API;

use App\Topic;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
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
        $this->authorize('isAdmin');
        $questions = DB::table('topics')
            ->rightjoin('questions', 'topics.id', '=', 'questions.topic_id')
            ->select('topics.title', 'questions.*')
            ->where('topics.deleted_at', NULL )
            ->where('questions.deleted_at', NULL)
            ->orderby('topics.title')
            ->get();
        return response()->json([
                'questions'=>$questions
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
        return Question::create([
            'topic_id' => $request['topic_id'],
            'question_text' => $request['question_text'],
            'a' => $request['a'],
            'b' => $request['b'],
            'c' => $request['c'],
            'd' => $request['d'],
            'answer' => $request['answer']
        ]);

        //return ['message' => 'question created'];
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
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
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::FindOrFail($id);
        //delete the question
        $question->delete();
        //the message log
        return ['message' => 'Question deleted'];
    }
}
