<div class="form-group">
    @if ($label)
        <x-form-label :label="$label" :for="$id ?? ''" />
    @endif
    <input {!! $attributes->merge(['class' => 'form-control' . ($errors->has($errorKey) ? ' is-invalid' : '')]) !!} name="{{ $name }}">
    @error($errorKey)
        <x-input-error :messages="$errors->get($errorKey)" class="mt-2" />
    @enderror
</div>
