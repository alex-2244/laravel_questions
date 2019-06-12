<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Answer extends Model
{

    protected $fillable = ['user_id', 'body'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
    public function getCreatedDateAttribute()
    {
       return $this->created_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public static function __boot()
    {
        parent::boot();

        static::created(function($answer) {
            // error_log($answer);
            // dd($answer, true);
            $answer->question->increment('answers_count');
            // $answer->question->save();
            // $answer->question['answers_count'] = $answer->question + 1;
            // $answer->question->save();
        });
        static::deleted(function ($answer) {
            // $answer->question->decrement('answers_count');
            $question = $answer->question;
            $question->decrement('answers_count');
            if ($question->best_answer_id == $answer->id) {
                $question->best_answer_id = NULL;
                $question->save();
            }
        });
    }

    // public function getStatusAttribute()
    // {
    //     return $this->id == $this->question->best_answer_id ? 'vote-accepted' : '';
    // }

    
}
