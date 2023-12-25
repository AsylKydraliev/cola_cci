@extends('layouts.client')

@section('content')
    <div class="client-content">
        <div class="container-fluid">
            @include('components.gameRound', ['partyStage' => $partyStage])
        </div>
    </div>

    <div class="mobile-content d-none">
        <div class="container text-center">
            <img src="{{ asset('images/game-over.png') }}" alt="Game over" width="400">
            <h1 class="mt-4">Извините, страница пока недоступна в этом разрешении экрана</h1>
            <div class="mt-5 card card-body fs-5">
                <div>Возможно у Вас в настройках дисплея установлен <strong>размер текста 150%.</strong></div>
                Если у вас Windows 10 и выше,
                для изменения этого параметра нажмите в любом пустом месте на рабочем столе правой кнопкой мыши
                <div class="mx-auto text-start">
                    <div>> выберите <strong>Параметры экрана</strong></div>
                    <div>> в разделе <strong>Масштаб и Разметка</strong></div>
                    <div>> укажите<strong> размер текста 100%.</strong></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
