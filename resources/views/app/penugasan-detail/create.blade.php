<x-form action='{{ route("{$permission_name}.store") }}' onsubmit="submitModalDataTable(this); return false;"
    method="POST">
    <input type="hidden" name="id_task_hd" value="{{ $id }}">
    @include("{$resource_view}._form")
</x-form>
