@php
    $listUrl = [];
@endphp
@can("$permission_name.ubah")
    @php
        $listUrl[] = [
            'label' => '<i class="fas fa-spinner"></i>',
            'url' => route($permission_name . '.edit', $id),
            'title' => 'Progress',
            'color' => 'warning',
        ];
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

<x-button-group title="Aksi" :listUrl="$listUrl" />
