<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
  protected $fillable = [
    'user_id', 'question_id', 'user_correct', 'correct'
  ];

  public function user(){
    return $this->belongsTo('App\User');
  }

  public function question(){
    return $this->belongsTo('App\Question');
  }
}
