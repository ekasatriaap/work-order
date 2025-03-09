<x-app-layout :title="$title">
    <x-row>
        <div class="col-md-12">
            <x-card :title="$title">
                @slot('toolbar')
                    <a href="{{ route("{$permission_name}.index") }}" class="btn btn-sm btn-danger btn-icon icon-left"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                    <button class="btn btn-sm btn-primary btn-icon icon-left" id="btn-save" type="button">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                @endslot
                <x-form action='{{ route("{$permission_name}.store") }}' method="POST" id="form-form">
                    @include("{$resource_view}._form")
                </x-form>
            </x-card>
        </div>
    </x-row>
    @push('add-scripts')
        <script>
            $(document).ready(function() {
                $(`#btn-save`).click(function() {
                    $(`#form-form`).submit();
                });
            });
        </script>
    @endpush
</x-app-layout>
