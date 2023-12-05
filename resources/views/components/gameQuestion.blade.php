<div class="text-center position-relative mt-4 w-100 mx-auto">
    <div class="mx-5">
        <div>
            <img src="{{ asset('images/title-img.png') }}" alt="" width="100%" height="130">
            <h1 class="pending-title">{{ $partyStage->title }}</h1>
        </div>
    </div>
</div>

<div class="d-flex flex-row justify-content-between gap-2 mx-5 game-content mt-4">
    <div class="position-relative">
        <div class="bubbles d-flex gap-4 flex-wrap align-items-start justify-content-center">
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="200" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="150" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="100" />
            </button>
            <button class="bubble me-5">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="120" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="150"  />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="100" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="80" />
            </button>

            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="100"/>
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="100" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="200" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="120" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="150" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="200" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="80" />
            </button>

            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="100" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="120" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="150" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="120" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="200" />
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="100"/>
            </button>
            <button class="bubble">
                <img src="{{ asset('images/bubbles-big.png') }}" alt="" width="150" />
            </button>
        </div>
        <img src="{{ asset('images/bubbles-bg.png') }}" alt="" width="100%">
    </div>
    <div class="game-leaders">
        <div class="game-leaders-list">
            <div class="game-leaders-label mb-4">Лидеры турнира</div>

            <div class="px-3 d-flex flex-column gap-3">
                <div class="list-item d-flex">
                    <img src="{{ asset('images/cup-gold.png') }}" alt="" width="60" height="100%">
                    <div class="item position-relative">
                        <img src="{{asset('images/gold-bg.png')}}" alt="" width="100%">
                        <span class="list-item-info">Михаил Федоров <span class="ms-5">456</span></span>
                    </div>
                </div>
                <div class="list-item d-flex">
                    <img src="{{ asset('images/cup-silver.png') }}" alt="" width="60" height="100%">
                    <div class="item position-relative">
                        <img src="{{ asset('images/silver-bg.png') }}" alt="" width="100%">
                        <span class="list-item-info">Михаил Федоров <span class="ms-5">456</span></span>
                    </div>
                </div>
                <div class="list-item d-flex">
                    <img src="{{ asset('images/cup-bronze.png') }}" alt="" width="60" height="100%">
                    <div class="item position-relative">
                        <img src="{{ asset('images/bronze-bg.png' )}}" alt="" width="100%">
                        <span class="list-item-info">Михаил Федоров <span class="ms-5">456</span></span>
                    </div>
                </div>
                <div class="list-item">
                    <div class="item-other">Михаил Федоров <span class="ms-5">456</span></div>
                </div>
                <div class="list-item">
                    <div class="item-other">Михаил Федоров <span class="ms-5">456</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
