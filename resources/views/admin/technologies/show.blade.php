@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            @include('includes.session_message')
                <div class="card text-center p-3">
                    <div class="card-body flex justify-content-center">

                        <h3 class="card-title mb-3"> {{ $technology->name }} </h3>
                        <p class="card-text">
                            <span class="badge text-black" style="background-color: {{ $technology->color }}">
                                {{ $technology->color }}
                            </span>
                        </p>
                        <a href="{{ route('admin.technologies.index') }}" title="Back"><button class="btn btn-secondary me-2">Back <i class="fa fa-arrow-left"></i></button></a>
                        <a href="{{ route('admin.technologies.edit', $technology) }}"><button class="btn btn-warning">Edit <i class="fa fa-pencil"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
