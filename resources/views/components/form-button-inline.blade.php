<div class="text-right">
    <div class="form-group row mb-4">
        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
        <div class="col-sm-12 col-md-7">
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
</div>
