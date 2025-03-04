<div class="text-right">
    <div class="form-group">
        <label class=""></label>
        @if ($attributes->has('mainRoute'))
            <a href="{{ route("cms.{$mainRoute}.index") }}" class="btn btn-light">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        @endif
        <button class="btn btn-primary btn-icon icon-left">
            <i class="fas fa-save"></i> Simpan
        </button>
    </div>
</div>
