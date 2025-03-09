@php
    $listUrl = [];
@endphp
@can("$permission_name.ubah")
    @php
        if ($status == TASK_STATUS_PENDING) {
            $listUrl[] = [
                'label' => '<i class="fas fa-edit"></i>',
                'attr' =>
                    'onclick="actionModalData(this)" data-url="' .
                    route($permission_name . '-detail.edit', $id) .
                    '" data-title="Edit Data"',
                'title' => 'Edit',
                'color' => 'warning',
            ];
        }
    @endphp
@endcan

@can("{$permission_name}.detail")
    @php
        $listUrl[] = [
            'label' => '<i class="fas fa-info-circle"></i>',
            'attr' =>
                'onclick="actionModalData(this)" data-url="' .
                route($permission_name . '-detail.show', $id) .
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
                'attr' =>
                    "onclick=\"deleteDataDataTable('" . route($permission_name . '-detail.destroy', $id) . "') \"",
                'title' => 'Delete',
                'color' => 'danger',
            ];
        }
    @endphp
@endcan

<x-button-group title="Aksi" :listUrl="$listUrl" />
