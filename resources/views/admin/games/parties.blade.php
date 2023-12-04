@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($parties as $key => $party)
            <div class="mb-2">
                <div class="row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <div class="party-card">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Ссылка для участников игры</h5>
                                <input
                                    id="playerUuid{{ $key }}"
                                    type="text"
                                    value="{{ env('APP_URL') . '/player-game/' . $party->player_uuid }}"
                                    class="form-control mb-2"
                                    readonly
                                />
                                <button class="btn btn-outline-primary btn-sm copyBtnPlayerUuid" data-index="{{ $key }}">
                                    Скопировать ссылку
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="party-card">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Ссылка для модератора</h5>
                                <input
                                    id="moderatorUuid{{ $key }}"
                                    type="text"
                                    value="{{ env('APP_URL') . '/moderator-game/' . $party->moderator_uuid }}"
                                    class="form-control mb-2"
                                    readonly
                                />
                                <button class="btn btn-outline-primary btn-sm copyBtnModeratorUuid" data-index="{{ $key }}">
                                    Скопировать ссылку
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/parties.js'])
@endpush
