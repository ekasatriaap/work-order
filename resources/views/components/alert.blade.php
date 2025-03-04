@php
    $alert_types = ['success', 'danger', 'warning', 'info'];
@endphp

@foreach ($alert_types as $item)
    @if (session()->has($item))
        @if (in_array($item, $alert_types))
            <div class="alert alert-{{ $item }}">{{ session($item) }}</div>
        @break
    @endif
@endif
@endforeach
