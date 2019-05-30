@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3>{{ $question->title }}</h3>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body"> 
                    {!! $question->body_html !!}
                    {{-- {!! Parsedown::instance()->text($question->body) !!} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
