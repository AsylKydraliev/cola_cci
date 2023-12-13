@foreach($points as $key => $point)
    <div class="list-item d-flex">
        @php
            $cupImages = [
                0 => ['cup' => 'gold', 'bg' => 'gold-bg'],
                1 => ['cup' => 'silver', 'bg' => 'silver-bg'],
                2 => ['cup' => 'bronze', 'bg' => 'bronze-bg'],
            ];
        @endphp

        @if($key <= 2)
            <div class="list-item d-flex">
                <img src="{{ asset("images/cup-{$cupImages[$key]['cup']}.png") }}" alt="" width="60" height="100%">
                <div class="item position-relative">
                    <img src="{{ asset("images/{$cupImages[$key]['bg']}.png") }}" alt="" width="100%">
                    <span class="list-item-info">
                        {{ $point['name'] }}
                        <span class="ms-5">{{ $point['points'] ?? 0 }}</span>
                    </span>
                </div>
            </div>
        @else
            <div class="list-item w-100">
                <div class="item-other">
                    {{ $point['name'] }}
                    <span class="ms-5">{{ $point['points'] ?? 0 }}</span>
                </div>
            </div>
        @endif
    </div>
@endforeach
