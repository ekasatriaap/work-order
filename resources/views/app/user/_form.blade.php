<x-form-input :label="__('Nama User')" id="name" name="name" :value="old('name', $user->name)" />
<x-form-input :label="__('Username')" id="username" name="username" :value="old('username', $user->username)" />
<x-form-select :label="__('Role')" id="id-role" name="id_role" :options="$roles" :value="old('id_role', $user->role_id)" />
