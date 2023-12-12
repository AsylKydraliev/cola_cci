@foreach($points as $point)
    <div class="list-item d-flex">
        <img src="{{ asset('images/cup-gold.png') }}" alt="" width="60" height="100%">
        <div class="item position-relative">
            <img src="{{asset('images/gold-bg.png')}}" alt="" width="100%">
            <span class="list-item-info">
                {{ $point->name }}
                <span class="ms-5">{{ $point->points ?? 0 }}</span>
            </span>
        </div>
    </div>
@endforeach
{{--        <div class="list-item d-flex">--}}
{{--            <img src="{{ asset('images/cup-silver.png') }}" alt="" width="60" height="100%">--}}
{{--            <div class="item position-relative">--}}
{{--                <img src="{{ asset('images/silver-bg.png') }}" alt="" width="100%">--}}
{{--                <span class="list-item-info">Михаил Федоров <span class="ms-5">456</span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="list-item d-flex">--}}
{{--            <img src="{{ asset('images/cup-bronze.png') }}" alt="" width="60" height="100%">--}}
{{--            <div class="item position-relative">--}}
{{--                <img src="{{ asset('images/bronze-bg.png' )}}" alt="" width="100%">--}}
{{--                <span class="list-item-info">Михаил Федоров <span class="ms-5">456</span></span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="list-item">--}}
{{--            <div class="item-other">Михаил Федоров <span class="ms-5">456</span></div>--}}
{{--        </div>--}}
{{--        <div class="list-item">--}}
{{--            <div class="item-other">Михаил Федоров <span class="ms-5">456</span></div>--}}
{{--        </div>--}}
