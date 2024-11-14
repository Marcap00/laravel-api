

@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <form
            action="{{
            (Route::currentRouteName() == 'admin.technologies.edit') ?
            route('admin.technologies.update', $technology->id ) :
            route('admin.technologies.store')
            }}"
            method="POST" class="text-center card">
            @if (Route::currentRouteName() == 'admin.technologies.edit')
                @method('PUT')
            @endif
            @csrf
            <div class="row row-cols-2 g-2 text-white">
                <div class="col flex-column-center my-2">
                    <div class="form-group mb-2">
                        <label for="name"><h6 class="mb-2">Name:</h6></label>

                        <input type="text" class="form-control p-2" id="name" name="name" placeholder="Enter technology name..." value="{{ old('name', $technology->name) }}">

                    </div>
                    @error("name")
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col flex-column-center my-2">
                    <div class="form-group mb-2">
                        <label for="color"><h6 class="mb-2">Color:</h6></label>
                        <input type="text" class="form-control p-2" id="color" name="color" placeholder="Enter technology color label..." value="{{ old('color', $technology->color) }}">
                    </div>
                    @error("color")
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="flex-center my-3">
                    <button type="submit" class="btn btn-warning me-2">
                        @if (Route::currentRouteName() == 'admin.technologies.edit')
                        <span>Edit</span>
                        <i class="fas fa-pencil ms-2"></i>
                        @elseif (Route::currentRouteName() == 'admin.technologies.create')
                        <span>Create new technology</span>
                        <i class="fas fa-plus ms-2"></i>
                        @endif
                    </button>
                    <button type="reset" class="btn btn-secondary me-2">
                        Reset fields
                        <i class="fas fa-undo ms-2"></i>
                    </button>
                    <a href="{{ route('admin.technologies.index') }}" class="btn btn-danger">
                        Go back
                        <i class="fas fa-arrow-left ms-2"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection

