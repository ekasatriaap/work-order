<div class="form-group">
    @if ($label)
        <x-form-label :label="$label" :for="$id" />
    @endif
    <div {!! $attributes->merge(['class' => 'image-preview']) !!} id="{{ $previewId }}"
        @if ($imageData) style="background-image: url(data:image/{{ $imageData['extension'] ?? '' }};base64,{{ $imageData['imageData'] ?? '' }}); background-size: cover; background-position: center center;" @endif>
        <label for="{{ $id }}" id="image-label">
            @if ($imageData)
                Change Image
            @else
                Choose Image
            @endif
        </label>
        <input type="file" name="{{ $name }}" id="{{ $inputId }}" />
    </div>
    @if ($errors->has($name))
        <x-input-error :messages="$errors->get($name)" class="mt-2" />
    @endif
</div>
