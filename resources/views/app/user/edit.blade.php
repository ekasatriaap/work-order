<x-form action='{{ route("{$permission_name}.update", encode($user->id)) }}'
    onsubmit="submitModalDataTable(this); return false;" method="POST">
    @method('put')
    @include("{$resource_view}._form")
</x-form>
