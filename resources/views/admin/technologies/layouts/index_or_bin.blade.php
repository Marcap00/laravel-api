@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        @include('includes.session_message')
        @if (Route::is('admin.technologies.index'))
        <a class="btn btn-success my-3 me-2" href="{{ route('admin.technologies.create') }}">
            Add new technology <i class="fas fa-plus"></i>
        </a>
        <a href="{{ route('admin.technologies.bin') }}" class="btn btn-warning my-3">
            Go to the bin <i class="fas fa-trash"></i>
        </a>
        @elseif (Route::is('admin.technologies.bin'))
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary my-3">
            Go Back<i class="fas fa-arrow-left ms-2"></i>
        </a>
        @endif
        <table class="table table-responsive table-striped table-hover table-borderless mb-0 align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($technologies as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->name }}</td>
                    <td>
                        <span class="badge text-black" style="background-color: {{ $t->color }}">
                            {{ $t->color }}
                        </span>
                    </td>
                    <td>
                        <div class="flex-end">
                            @if (Route::is('admin.technologies.index'))
                            <a class="btn btn-success me-2" href="{{ route('admin.technologies.show', $t) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-secondary me-2" href="{{ route('admin.technologies.edit', $t) }}">
                                <i class="fas fa-pencil"></i>
                            </a>
                            @elseif (Route::is('admin.technologies.bin'))
                            <form class="patch-form" action="{{ route('admin.technologies.restore', ['id' => $t->id, 'name' => $t->name]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-warning me-2" type="submit"><i class="fas fa-rotate"></i></button>
                            </form>
                            @endif
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $t->id }}">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade del-modal" id="staticBackdrop-{{ $t->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ (Route::is('admin.technologies.bin')) ? 'Permanent deleting' : 'Deleting'}} {{ $t->name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to <span class="text-danger fw-semibold">{{ (Route::is('admin.technologies.bin')) ? 'permanent' : ''}}</span> delete <span class="fw-semibold">{{ $t->name }}</span>?</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        @if (Route::is('admin.technologies.index'))
                                        <form class="del-form" action="{{ route('admin.technologies.destroy', $t) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete <i class="fas fa-trash fa-lg"></i></button>
                                        </form>
                                        @elseif (Route::is('admin.technologies.bin'))
                                        <form class="perma-del-form" action="{{ route('admin.technologies.permanent-destroy', ['id' => $t->id, 'name' => $t->name]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete <i class="fas fa-trash fa-lg"></i></button>
                                        </form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No more technologies available...</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div>
            {{ $technologies->links() }}
        </div>
    </div>
</main>
    </div>
</main>
@endsection
