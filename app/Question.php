<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $fillable = ['title', 'slug', 'body', 'views', 'answers', 'votes', 'best_answer_id', 'user_id'];

  public function users()
  {
  	return $this->belongsTo(User::class);
  }

  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;
    $this->attributes['slug'] = str_slug($value);
  }

  public function getUrlAttribute()
  {
    // $user = Auth::User();
    return route('questions.show', $this->slug);
  }

  public function getCreatedDateAttribute()
  {
    return $this->created_at->diffForHumans();
  }

  public function getStatusAttribute()
  {
    if ($this->answers_count > 0) {
      if ($this->best_answer_id) {
        return "answered-accepted";
      }
      return "answered";
    }
    return "unanswered";
  }

  public function getBodyHtmlAttribute()
  {
    return \Parsedown::instance()->text($this->body);
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

}
