 <div class="modal fade" id="LoginForm" tabindex="-1" aria-labelledby="LoginForm-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded shadow border-0">
        <form action="" method="POST" class="">
            @csrf
            {{method_field('DELETE')}}
            <div class="modal-header border-bottom">
                <h5 class="modal-title" id="LoginForm-title">Are You Sure !</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body">
                <div class="bg-white p-3 rounded box-shadow">
                                                                 
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-danger">No</button>
            </div>
        </form>
        </div>
    </div>
</div>