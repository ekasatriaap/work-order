<div class="form-group">
    @if ($attributes->has('label'))
        <x-form-label :label="$label" :for="$id" />
    @endif
    <textarea {!! $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) !!}>
            {!! $value !!}
        </textarea>
    @if ($errors->has($name))
        <x-input-error :messages="$errors->get($name)" class="mt-2" />
    @endif
</div>
