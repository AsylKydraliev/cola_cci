@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" href="#game"><h5>Создание игры</h5></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#question"><h5>Вопросы</h5></a>
            </li>
        </ul>
        <div id="game" class="tab-content game">Game</div>
        <div id="question" class="tab-content" style="display: none">question</div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/tabs.js'])
@endpush
