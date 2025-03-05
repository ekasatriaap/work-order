<x-form action="{{ route("{$permission_name}.store") }}" onsubmit="submitModalDataTable(this); return false;"
    method="POST">
    @include("cms.{$resource_view}._form")
</x-form>
