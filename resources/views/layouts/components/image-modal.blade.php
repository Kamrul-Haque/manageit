<div class="modal fade" id="image{{$loop}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body text-danger font-weight-bold">
                <img src="{{ $slot }}" alt="image" class="rounded-sm mw-100">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
