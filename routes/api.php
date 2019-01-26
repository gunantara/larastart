<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//api resource for retrieving data
Route::apiResource('user', 'API\UserController');
Route::apiResource('topic', 'API\TopicController');
Route::apiResource('question', 'API\QuestionController');
Route::get('/edit-question/{id}','API\QuestionController@edit_question');

//api for user profile
Route::get('profile','API\UserController@profile');
Route::put('profile','API\UserController@UpdateProfile');

//api for dashboard admin
Route::get('banyak_users','API\dashboard_controller@banyak_User');
Route::get('banyak_question','API\dashboard_controller@banyak_question');
Route::get('banyak_topics','API\dashboard_controller@banyak_topik');

//api for take Quiz
Route::apiResource('take_quiz','API\AttemptQuiz');
Route::get('attempt_quiz/{id}','API\AttemptQuiz@attempt_quiz');