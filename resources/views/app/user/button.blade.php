@php
    $listUrl = [];
@endphp
@can("$permission_name.ubah")
    @php
        $listUrl[] = [
            'label' => '<i class="fas fa-edit"></i>',
            'attr' =>
                'onclick="actionModalData(this)" data-url="' .
                route($permission_name . '.edit', $id) .
                '" data-title="Edit Data User"',
            'title' => 'Edit',
            'color' => 'warning',
        ];
    @endphp
@endcan

@can("$permission_name.hapus")
    @php
        $listUrl[] = [
            'label' => '<i class="fas fa-trash"></i>',
            'attr' => "onclick=\"deleteDataDataTable('" . route($permission_name . '.destroy', $id) . "') \"",
            'title' => 'Delete',
            'color' => 'danger',
        ];
    @endphp
@endcan

<x-button-group title="Aksi" :listUrl="$listUrl" />
