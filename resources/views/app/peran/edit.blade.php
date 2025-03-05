<x-form action="{{ route('cms.kategori.update', encode($kategori->id)) }}"
    onsubmit="submitModalDataTable(this); return false;" method="POST">
    @method('put')
    @include('cms.kategori._form')
</x-form>
