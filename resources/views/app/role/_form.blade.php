<x-form-input :label="__('Nama Role')" id="name" name="name" :value="$role->name" />
<x-form-input :label="__('Level')" type='number' id="level" name="level" :value="$role->level" data-number-only />
@stack('add-scripts')
