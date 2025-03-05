@php
    $listUrl = [];
@endphp
@can("$permission_name.ubah")
    @php
        $listUrl[] = [
            'label' => '<i class="fas fa-edit"></i>',
            'attr' =>
                'onclick="actionModalData(this)" data-url="' .
                route('cms.kategori.edit', $id) .
                '" data-title="Edit Data Kategori"',
            'title' => 'Edit',
            'color' => 'warning',
        ];
    @endphp
@endcan

@can("$permission_name.hapus")
    @php
        $listUrl[] = [
            'label' => '<i class="fas fa-trash"></i>',
            'attr' => "onclick=\"deleteDataDataTable('" . route('cms.kategori.destroy', $id) . "') \"",
            'title' => 'Delete',
            'color' => 'danger',
        ];
    @endphp
@endcan

<x-button-group title="Aksi" :listUrl="$listUrl" />
