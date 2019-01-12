<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = ['title'];


    public static function boot()
    {
        parent::boot();
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'topic_id')->withTrashed();
    }
}
