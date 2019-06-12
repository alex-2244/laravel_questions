<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;

class AcceptAnswerController extends Controller
{
   public function __invoke(Answer $answer)
   {
   	// dd('Coming');
   	$answer->question->acceptBestAnswer($answer);
   	return back();
   }
}
