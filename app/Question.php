<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Parsedown;

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
    // dd($this->body);
    return \Parsedown::instance()->text($this->body);
  }

  public function answers()
  {
    return $this->hasMany(Answer::class);
  }

  

}
