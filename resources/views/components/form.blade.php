<form {!! $attributes->merge(['class' => $errors->any() ? 'needs-validation' : '']) !!}>
    @unless (in_array($method, ['HEAD', 'GET', 'OPTIONS']))
        @csrf
    @endunless

    {!! $slot !!}
</form>
