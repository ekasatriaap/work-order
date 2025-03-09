<x-form action='{{ route("{$permission_name}.update", encode($task_dt->id)) }}'
    onsubmit="submitModalDataTable(this); return false;" method="POST">
    @method('put')
    @include("{$resource_view}._form")
</x-form>
