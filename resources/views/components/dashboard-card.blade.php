<div class="{{ $attributes->has('class') ? $attributes->get('class') : 'col-lg-3' }} col-md-6 col-sm-6 col-12">
    <div class="card card-statistic-1">
        <div class="card-icon bg-{{ $attributes->has('color') ? $attributes->get('color') : 'primary' }}">
            <i class="{{ $attributes->has('icon') ? $attributes->get('icon') : 'far fa-user' }}"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header">
                <h4>{{ $attributes->has('title') ? $attributes->get('title') : 'Total Admin' }}</h4>
            </div>
            <div class="card-body">
                {{ $attributes->has('value') ? $attributes->get('value') : '0' }}
            </div>
        </div>
    </div>
</div>
