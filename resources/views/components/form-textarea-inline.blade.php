<div class="form-group row mb-4">
    @if ($attributes->has('label'))
        <x-form-label :label="$label" :for="$id"
            class="col-form-label text-md-right col-12 col-md-3 col-lg-3" />
    @endif
    <div class="col-sm-12 col-md-7">
        <textarea {!! $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) !!}>
            {!! $value !!}
        </textarea>
        @if ($errors->has($name))
            <x-input-error :messages="$errors->get($name)" class="mt-2" />
        @endif
    </div>
</div>
