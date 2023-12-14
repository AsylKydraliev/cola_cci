@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success my-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Список партий</h3>

            <form
                action="{{ route('admin.store_party', ['game' => $game]) }}"
                method="post"
                id="parties"
            >
                @csrf
                <button type="submit" class="btn btn-outline-success d-inline-block icons">
                    <i class="bi bi-plus-lg"></i>
                    Создать партию
                </button>
            </form>
        </div>
        <hr>
        @forelse($parties as $key => $party)
{{--            <div class="mt-4 py-2 text-center alert alert-{{ \App\Models\Party::getStatusColor()[$party->status] }}">--}}
{{--                {{ \App\Models\Party::getStatus()[$party->status] }}--}}
{{--            </div>--}}
            {{--            <div class="d-flex justify-content-between mb-1">--}}
            {{--                <div class="text-secondary">--}}
            {{--                    Партия №{{ $key+1 }}--}}
            {{--                    от {{ date('d.m.Y H:i', strtotime($party->created_at)) }}--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <div class="mb-3">
                <div class="row">
                    <div class="col mb-3 mb-sm-0">
                        <div class="party-card">
                            <div class="card-body">
                                <div class="d-flex gap-2 align-items-center justify-content-between">
                                    <h3 class="text-secondary m-0">
                                        Партия №{{ $key+1 }}
                                        от {{ date('d.m.Y H:i', strtotime($party->created_at)) }}
                                    </h3>
                                    <div class="m-0 py-1 text-center alert alert-{{ \App\Models\Party::getStatusColor()[$party->status] }}">
                                        {{ \App\Models\Party::getStatus()[$party->status] }}
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="playerUuid{{ $key }}" class="fw-bold">Ссылка для участников
                                                игры</label>
                                            <div class="input-group align-items-start">
                                                <input
                                                    id="playerUuid{{ $key }}"
                                                    type="text"
                                                    value="{{ env('APP_URL') . '/player_game/' . $party->player_uuid }}"
                                                    class="form-control mb-2"
                                                    readonly
                                                />
                                                <button
                                                    class="copyBtnPlayerUuid btn btn-outline-secondary"
                                                    data-index="{{ $key }}"
                                                    type="button"
                                                >
                                                    <i class="bi bi-clipboard"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="moderatorUuid{{ $key }}" class="fw-bold">Ссылка для
                                                модератора</label>
                                            <div class="input-group align-items-start">
                                                <input
                                                    id="moderatorUuid{{ $key }}"
                                                    type="text"
                                                    value="{{ env('APP_URL') . '/moderator_game/' . $party->moderator_uuid }}"
                                                    class="form-control mb-2"
                                                    readonly
                                                />
                                                <button
                                                    class="copyBtnModeratorUuid btn btn-outline-secondary"
                                                    data-index="{{ $key }}"
                                                    type="button"
                                                >
                                                    <i class="bi bi-clipboard"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="game_code{{ $key }}" class="fw-bold">Код игры</label>
                                        <input
                                            id="game_code{{ $key }}"
                                            type="text"
                                            value="{{ $party->game_code }}"
                                            class="form-control mb-2"
                                            readonly
                                        />
                                    </div>
                                </div>
                                <div class="mt-3 col">
                                    <a
                                        href="{{ route('admin.partyStages', ['party' => $party]) }}"
                                        class="btn btn-dark d-block"
                                        data-index="{{ $key }}"
                                    >
                                        Подробнее о партии
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>Список пуст</p>
        @endforelse
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/parties.js'])
@endpush
