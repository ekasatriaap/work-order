<x-app-layout :title="$title">
    <x-row class="mt-sm-4">
        <div class="col-md-12">
            <x-row>
                <div class="col-md-6">
                    <x-card title="Edit Profile">
                        <x-form method="post" action="{{ route('profile.update') }}" id="update-profile-form">
                            @method('patch')
                            <x-form-input :label="__('Name')" id="name" name="name" :value="old('name', $user->name)" required />
                            <x-form-input :label="__('Username')" id="username" name="username" :value="old('username', $user->username)" required />
                            <x-form-input :label="__('Email')" id="email" name="email" type="email"
                                :value="old('email', $user->email)" required />
                            <div class="text-right">
                                <button class="btn btn-primary btn-icon icon-left">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </x-form>
                    </x-card>
                </div>
                <div class="col-md-6">
                    <x-card title="Change Password">
                        <x-form method="post" action="{{ route('password.update') }}" id="update-password-form">
                            @method('put')
                            <x-form-input :label="__('Current Password')" id="current_password" name="current_password"
                                type="password" value="" required />
                            <x-form-input :label="__('New Password')" id="password" name="password" value=""
                                type="password" required />
                            <x-form-input :label="__('Confirm Password')" id="password_confirmation" name="password_confirmation"
                                type="password" value="" required />
                            <div class="text-right">
                                <button class="btn btn-primary btn-icon icon-left">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </x-form>
                    </x-card>
            </x-row>
        </div>
    </x-row>
    @push('add-scripts')
        <script>
            $(document).ready(function() {
                $(`#update-profile-form`).submit(function(e) {
                    e.preventDefault();
                    const form = this;
                    const url = $(form).attr('action');
                    const method = $(form).attr('method');
                    ajaxMasterSimpan(form, url, method).catch((error) => {
                        setInvalidFeedback(error, form);
                    });
                });

                $(`#update-password-form`).submit(function(e) {
                    e.preventDefault();
                    const form = this;
                    const url = $(form).attr('action');
                    const method = $(form).attr('method');
                    ajaxMasterSimpan(form, url, method).catch((error) => {
                        setInvalidFeedback(error, form);
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
