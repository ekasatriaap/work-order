@php
    $listUrl = [];
@endphp
@can("$permission_name.ubah")
    @php
        if ($status != TASK_STATUS_COMPLETED && $status != TASK_STATUS_CANCELED) {
            $listUrl[] = [
                'label' => '<i class="fas fa-edit"></i>',
                'url' => route($permission_name . '.edit', $id),
                'title' => 'Edit',
                'color' => 'warning',
            ];
        }
    @endphp
@endcan

@can("$permission_name.detail")
    @php
        $listUrl[] = [
            'label' => '<i class="fas fa-info-circle"></i>',
            'attr' =>
                'onclick="actionModalData(this)" data-url="' .
                route($permission_name . '.show', $id) .
                '" data-title="Detail Data" btndetail',
            'title' => 'Detail',
            'color' => 'primary',
        ];
    @endphp
@endcan

@can("$permission_name.hapus")
    @php
        if ($status == TASK_STATUS_PENDING) {
            $listUrl[] = [
                'label' => '<i class="fas fa-trash"></i>',
                'attr' => "onclick=\"deleteDataDataTable('" . route($permission_name . '.destroy', $id) . "') \"",
                'title' => 'Delete',
                'color' => 'danger',
            ];
        }
    @endphp
@endcan

<x-button-group title="Aksi" :listUrl="$listUrl" />
