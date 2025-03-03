<x-auth-layout>
    <x-container>
        <x-row>
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                @include('components.login-logo', ['logo' => $logo])

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>{{ $title }}</h4>
                    </div>

                    <div class="card-body">
                        <x-form method="POST" action="{{ route('login') }}">
                            <x-form-input :label="__('Username')" id="username" name="username" :value="old('username')"
                                autocomplete="off" required />
                            <x-form-input :label="__('Password')" id="password" name="password" type="password"
                                :value="old('password')" required />
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label"
                                        for="remember-me">{{ __('Remember me') }}</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    {{ __('Log in') }}
                                </button>
                            </div>
                        </x-form>

                    </div>
                </div>
                @include('layouts.partials.simple-footer')
            </div>
        </x-row>
    </x-container>
</x-auth-layout>
