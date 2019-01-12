<?php
namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @package App
 * @property string $topic
 * @property text $question_text
 * @property text $code_snippet
 * @property text $answer_explanation
 * @property string $more_info_link
*/
class Question extends Model
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'topic_id','question_text','a','b','c','d','answer'
    ];

    public static function boot()
    {
        parent::boot();

        //Question::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id')->withTrashed();
    }
}

