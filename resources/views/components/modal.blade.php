<div tabindex="-1" class="modal fade" id="{{ $id }}" role="dialog">
    <div class="modal-dialog {{ $msize }}" role="document" id="modal-dialog">
        <div class="modal-content">
            @if ($title)
                <div class="modal-header">
                    <h3 class="modal-title">{{ $title }}</h3>
                    <div class="close" data-dismiss="modal" aria-label="Close" onclick="DRSKMODAL.hide()">
                        <span arial-hidden="true">
                            x
                        </span>
                    </div>
                    <!--end::Close-->
                </div>
            @endif


            <div class="modal-body">
                {!! $slot !!}
            </div>

            @if ($modalFooter)
                <div class="modal-footer">
                    @if ($modalFooter === true)
                        @if ($btnclose)
                            <button type="button" class="btn btn-secondary" btnModalClose
                                data-dismiss="modal">{!! $btnclose === true ? 'Tutup' : trim($btnclose) !!}</button>
                        @endif
                        @if ($btndone)
                            <button type="button" class="btn btn-primary" btnModalDone>{!! $btndone === true ? 'Simpan' : trim($btndone) !!}</button>
                        @endif
                    @else
                        {!! $modalFooter !!}
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
