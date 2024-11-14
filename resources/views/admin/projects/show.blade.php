@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center p-3">
                    <div class="card-img-top">
                        @if ($project->image)
                            <img src="{{ asset('/storage/' . $project->image) }}" alt="{{ $project->name }}">
                        @else
                            <img class=" rounded-3 img-fluid" src="{{"https://placehold.co/400x300?text=" . $project->title }}" alt="{{ $project->name }}">
                        @endif
                    </div>
                    <div class="card-body flex justify-content-center">
                        <p class="card-text">Category: <span class="fw-semibold">{{ $project->type->name }}</span></p>
                        <p class="card-text">
                            @forelse  ($project->technologies as $technology)
                            <span class="badge text-black" style="background-color: {{ $technology->color }}">
                                #{{ $technology->name }}
                            </span>
                            @empty
                                No Technologies
                            @endforelse
                        </p>
                        <h3 class="card-title mb-3"> {{ $project->title }} </h3>
                        <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $project->author }} </h6>
                        <p class="card-text"> {{ $project->description }} </p>
                        <a href="{{ route('admin.projects.index') }}" title="Back"><button class="btn btn-secondary me-2">Back <i class="fa fa-arrow-left"></i></button></a>
                        <a href="{{ route('admin.projects.edit', $project) }}"><button class="btn btn-warning">Edit <i class="fa fa-pencil"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
