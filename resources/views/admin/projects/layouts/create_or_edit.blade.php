

@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <form action="{{ (Route::currentRouteName() == 'admin.projects.edit') ? route('admin.projects.update', $project->id ) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="text-center card">
            @if (Route::currentRouteName() == 'admin.projects.edit')
            @method('PUT')
            @endif
            @csrf
            <div class="row g-2 text-white">
                <div class="col-6 flex-column-center my-2">
                    <div class="form-group mb-2">
                        <label for="author"><h6 class="mb-2">Author:</h6></label>
                        <input type="text" class="form-control p-2" id="author" name="author" placeholder="Enter project author..." value="{{ old('author', $project->author) }}">
                    </div>
                    @error("author")
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-6 flex-column-center my-2">
                    <div class="form-group mb-2">
                        <label for="title"><h6 class="mb-2">Title:</h6></label>
                        <input type="text" class="form-control p-2" id="title" name="title" placeholder="Enter project title..." value="{{ old('title', $project->title) }}">
                    </div>
                    @error("title")
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-6 flex-column-center my-2">
                    <div class="form-group mb-2">
                        <label for="description"><h6 class="mb-2">Description:</h6></label>
                        <input type="text" class="form-control p-2" id="description" name="description" placeholder="Enter project description..." value="{{ old('description', $project->description) }}">
                    </div>
                    @error("description")
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-6 flex-column-center my-2">
                    <div class="form-group mb-2">
                        <label for="type" class="form-label">Type:</label>
                        {{--
                        Laravel Documentation
                        # Blade Template - # Additional Attributes
                        <select name="version">
                            @foreach ($product->versions as $version)
                                <option value="{{ $version }}" @selected(old('version') == $version)>
                                    {{ $version }}
                                </option>
                            @endforeach
                        </select>
                        --}}
                        <select name="type_id" id="type_id" class="form-select">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected(old('type_id', $project->type_id) == $type->id)>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error("type")
                            <div class="alert alert-warning">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12 flex-column-center my-2">
                    <div class="form-group mb-2">
                        <label for="image"><h6 class="mb-2">Image:</h6></label>
                        <input type="file" class="form-control p-2" id="image" name="image" placeholder="Enter image url...">
                    </div>
                    @error("image")
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 flex-column-center my-2">
                    <div class="form-group mb-2">
                        <label for="technologies"><h6 class="mb-2">Technologies:</h6></label>
                            @foreach ($technologies as $t)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="technologies" value="{{ $t->id }}" name="technologies[]"
                                @checked(old('technologies') ? in_array($t->id, old('technologies')) : $project->technologies->contains($t))>
                                <label class="form-check-label" for="technologies" name="technologies[]">{{ ucwords($t->name) }}</label>
                            </div>
                            @endforeach
                    </div>
                    @error("technologies")
                    <div class="alert alert-warning">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="flex-center my-3">
                <button type="submit" class="btn btn-warning me-2">
                    @if (Route::currentRouteName() == 'admin.projects.edit')
                    <span>Edit</span>
                    <i class="fas fa-pencil ms-2"></i>
                    @elseif (Route::currentRouteName() == 'admin.projects.create')
                    <span>Create new project</span>
                    <i class="fas fa-plus ms-2"></i>
                    @endif
                </button>
                <button type="reset" class="btn btn-secondary me-2">
                    Reset fields
                    <i class="fas fa-undo ms-2"></i>
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-danger">
                    Go back
                    <i class="fas fa-arrow-left ms-2"></i>
                </a>
            </div>
        </form>
    </div>
</main>
@endsection

