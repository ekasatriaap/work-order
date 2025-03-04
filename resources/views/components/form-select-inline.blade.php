<div class="form-group row mb-4">
    @if ($attributes->has('label'))
        <label for="{{ $id }}"
            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ $label }}</label>
    @endif
    <div class="col-sm-12 col-md-7">
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
</div>
