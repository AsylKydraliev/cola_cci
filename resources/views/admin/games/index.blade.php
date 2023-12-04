@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="d-flex justify-content-between">
                <h3>Список игр</h3>
                <a href="{{ route('admin.games.create') }}" class="btn btn-outline-primary">
                    <i class="bi bi-plus-lg fs-5"></i>
                    Создать новую игру
                </a>
            </div>

            <hr class="my-4">

            @if(session('success'))
                <div class="alert alert-success my-3">
                    {{ session('success') }}
                </div>
            @endif

            <form
                action="{{ route('admin.games.index') }}"
                method="GET"
            >
            </form>

            <div class="col">
                <table class="table align-middle">
                    <thead class="align-top">
                    <tr>
                        <th scope="col" class="w-75">
                            Название
                        </th>
                        <th scope="col" class="text-center">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td>{{ $game->game_title }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a
                                        href="{{ route('admin.games.show', ['game' => $game]) }}"
                                        class="btn text-primary d-inline-block icons"
                                    >
                                        <i class="bi bi-info-circle fs-4"></i>
                                    </a>

                                    <a
                                        href="{{ route('admin.games.edit', ['game' => $game]) }}"
                                        class="btn d-inline-block icons"
                                    >
                                        <i class="bi bi-pencil-square fs-4 text-warning"></i>
                                    </a>

                                    <form action="{{ route('admin.store_party', ['game' => $game]) }}"
                                          method="post">
                                        @csrf
                                        <button type="submit" class="btn d-inline-block icons">
                                            <i class="bi bi-play-circle fs-4"></i></button>
                                    </form>

                                    <form action="{{ route('admin.games.destroy', ['game' => $game]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn d-inline-block icons icon-link-hover">
                                            <i class="bi bi-trash fs-4 text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    @if(count($games) > 10)
                        <tfoot>
                        <tr>
                            <th colspan="13">{{ $games->links() }}</th>
                        </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
