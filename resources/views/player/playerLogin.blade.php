@extends('layouts.client')

@section('content')
    <div class="container">
        <form
            action="{{ route('player_game_uuid', ['player_uuid' => Request::segment(count(Request::segments()))]) }}"
            method="post"
        >
            @csrf
            <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="name">Ваше имя</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    required
                />
            </div>

            <button type="submit" class="btn btn-danger">Войти</button>
        </form>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
