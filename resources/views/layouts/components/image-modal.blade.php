<div class="modal fade" id="image{{$loop}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title">Image</p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body text-danger font-weight-bold">
                <img src="{{ $slot }}" alt="image" class="rounded-sm mw-100" width="inherit">
            </div>
        </div>
    </div>
</div>
