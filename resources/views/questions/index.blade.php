@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3>All Questions</h3>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-sm btn-outline-primary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._message')
                    @foreach($questions as $question)
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="votes">
                                <strong>{{ $question->votes }}</strong> {{ str_plural('vote', $question->votes) }}
                            </div>
                            <div class="status {{ $question->status }}">
                                <strong>
                                    {{ $question->answers_count }}
                                </strong> {{ str_plural('answer', $question->answers_count) }}
                            </div>
                            <div class="views">
                                {{ $question->views . " " . str_plural('view', $question->views) }}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center">
                                <h3 class="mt-0">
                                    <a href="{{ $question->url }}">{{ $question->title }}</a>
                                </h3>
                                <div class="ml-auto">
                                    {{-- @if (Auth::user()->can('update', $question))
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                    @endif
                                    @if (Auth::user()->can('delete', $question))
                                        <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    @endif --}}
                                    @can('update', $question)
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    @endcan
                                    @can ('delete', $question)
                                        <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                            <p class="lead">
                                Asked by
                                <a href="{{ Auth::user() }}">{{ Auth::user()->name }}</a>
                                <small class="text-muted">{{ $question->created_date }}</small>
                            </p>
                            <p>{{ str_limit($question->body, 225) }}</p>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="align-center">
                        {{ $questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
