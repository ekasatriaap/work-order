<x-form action='{{ route("{$permission_name}-detail.update", encode($task->id)) }}'
    onsubmit="submitModalDataTable(this); return false;" method="POST">
    @method('put')
    <x-detail-data :details="$details" />

    <x-form-label :label="__('Status akan diupdate menjadi ' . TASK_STATUS[nextStatusTask($task->status)])" />
    <x-form-textarea :label="__('Remark')" name="note" id="note" :value="old('note', '')" />
    <x-form-input type="number" :label="__('Jumlah')" id="jumlah" name="jumlah" :value="old('jumlah', 0)" />
</x-form>
