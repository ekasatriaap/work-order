<div class="form-group">
    @if ($attributes->has('label'))
        <x-form-label label :for="$id" :label="$label"></x-form-label>
    @endif
    <select {!! $attributes->merge(['class' => 'form-control selectric' . ($errors->has($name) ? ' is-invalid' : '')]) !!}>
        @if ($attributes->has('placeholder'))
            <option value="">{{ $placeholder }}</option>
        @endif

        @if ($attributes->has('options'))
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>{{ $option }}
                </option>
            @endforeach
        @else
            {!! $slot !!}
        @endif
    </select>
    @if ($errors->has($name))
        <x-input-error :messages="$errors->get($name)" class="mt-2" />
    @endif
</div>
