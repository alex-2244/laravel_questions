@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center mt-4">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h3>Edit Your answer<strong>{{ $question->title }}</strong></h3>
            </div>
            <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
              @csrf
              @method('PATCH')
              <div class="form-group">
                <textarea name="body" rows="7" cols="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}">{{ old('body', $answer->body) }}
                </textarea>
              </div>
              <div class="form-group">
                <button type="submit" style="width: 100%;" class="btn btn-primary btn-sm">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection