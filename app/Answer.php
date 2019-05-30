<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'user_id', 'body', 'votes_count'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsTo(Question::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($answer) {
            // error_log($answer->question);
            // $answer->question->increment('answers_count');
            // $answer->question->save();
            $answer->question['answers_count'] = $answer->question + 1;
            $answer->question->save();
        });
    }
}
