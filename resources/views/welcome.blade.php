@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row row-cols-3 justify-content-center">
            @forelse ($projects as $project)
            <div class="col mb-4 flex-grow-0">
                <div class="card border rounded-3">
                    @if ($project->image)
                        <img src="{{ asset('/storage/' . $project->image) }}" alt="{{ $project->name }}">
                    @else
                        <img class=" rounded-3 img-fluid" src="{{"https://placehold.co/400x300?text=" . $project->title }}" alt="{{ $project->name }}">
                    @endif
                    <div class="card-body  text-center">
                        <p class="card-text">Category: <span class="fw-semibold">{{ $project->type->name }}</span></p>
                        @forelse ($project->technologies as $t)
                        <span class="badge text-black mb-2" style="background-color: {{ $t->color }}">
                            #{{ $t->name }}
                        </span>
                        @empty
                        <span class="badge text-bg-secondary">
                            none
                        </span>
                        @endforelse
                        <h5 class="card-title fw-bold"> {{ $project->author }} </h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $project->title }} </h6>
                        <p class="card-text"> {{ $project->description }} </p>
                        @auth
                        <a class="btn btn-success me-2 px-4" href="{{ route('admin.projects.show', $project) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endauth
                        <a class="btn btn-secondary px-4" href="{{ $project->url }}">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12">
                    <p>No more project avalaible...</p>
                </div>
            @endforelse
        </div>
        <div>
            {{ $projects->links() }}
        </div>
    </div>
@endsection
