<div class="row justify-content-center mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h3>Your Answer</h3>
        </div>
        <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
          @csrf
          <div class="form-group">
            <textarea name="body" rows="7" cols="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"></textarea>
          </div>
          <div class="form-group">
            <button type="submit" style="width: 100%;" class="btn btn-primary btn-sm">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>