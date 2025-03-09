@if ($slot->isNotEmpty())
    <div {{ $attributes->merge(['class' => 'card']) }}>
        <div class="card-header">
            <h4>{{ $attributes->get('title') ?? 'Custom Filter:' }}</h4>
            <div class="card-header-action">
                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i
                        class="fas fa-minus"></i></a>
            </div>
        </div>
        <div class="collapse show" id="mycard-collapse">
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>
@endif
