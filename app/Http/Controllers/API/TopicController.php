<?php

namespace App\Http\Controllers\API;

use App\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
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
        $topics = Topic::all();
        return response()->json([
            'topics'=>$topics
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
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:topics',
        ]);

        return Topic::create([
            'title' => $request['title'],
        ]);
        
        return ['message' => 'topic created'];
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
        $topic = Topic::FindOrFail($id);

        $this->validate($request,[
            'title' => 'required|string|max:191|unique:topics,title,'.$topic->id,
        ]);
        $topic->update($request->all());
        return ['message' => 'topic updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::FindOrFail($id);

        //delete the user
        $topic->delete();
        //the message log
        return ['message' => 'topic deleted'];
    }
}
