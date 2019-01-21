<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use App\Topic;
use App\Question;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class dashboard_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    } 

    public function banyak_User(){
        $this->authorize('isAdmin');
        $banyak_user = DB::table('users')
            ->where('users.deleted_at', NULL)
            ->where('id','>', 1)
            ->count();
        return response()->json([
                'jumlah_users'=>$banyak_user
            ],200);
    }

    public function banyak_question(){
        $this->authorize('isAdmin');
        $banyak_question = DB::table('questions')
            ->where('questions.deleted_at', NULL)
            ->count();
        return response()->json([
            'jumlah_questions'=>$banyak_question
        ],200);
    }

    public function banyak_topik(){
        $this->authorize('isAdmin');
        $banyak_topic = DB::table('topics')
            ->where('topics.deleted_at', NULL)
            ->count();
        return response()->json([
            'jumlah_topics'=>$banyak_topic
        ],200);
    }
}
