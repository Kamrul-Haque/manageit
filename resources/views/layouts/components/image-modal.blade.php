<div class="modal fade" id="image{{$loop}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="background: transparent; border: 0">
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img src="{{ $slot }}" alt="image" class="rounded-sm mw-100">
                    <div class="d-block">
                        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
