<div class="btn-group mb-3">
    @foreach ($listUrl as $item)
        <a href="{{ empty($item['url']) ? 'javascript:void(0)' : $item['url'] }}"
            class="btn btn-icon btn-{{ $item['color'] ?? 'secondary' }}" {!! $item['attr'] ?? '' !!}
            title="{{ $item['title'] }}">
            {!! $item['label'] !!}
        </a>
    @endforeach
</div>
