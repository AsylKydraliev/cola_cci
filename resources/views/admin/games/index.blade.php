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
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($games as $game)
                        <tr>
                            <td>{{ $game->game_title }}</td>
                            <td>
                                <div class="d-flex">
                                    <a
                                        href="{{ route('admin.games.show', ['game' => $game]) }}"
                                        class="btn d-inline-block icons"
                                    >
                                        <i
                                            class="bi bi-info-circle fs-4"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="bottom"
                                            data-bs-title="Подробнее"
                                        ></i>
                                    </a>

                                    <a
                                        href="{{ route('admin.games.edit', ['game' => $game]) }}"
                                        class="btn d-inline-block icons"
                                    >
                                        <i class="bi bi-pencil-square fs-4 text-warning"></i>
                                    </a>
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
