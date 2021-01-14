<!-- Delete Task Modal -->
<div class="modal fade" id="delete-task-modal" tabindex="-1" role="dialog" aria-labelledby="delete-task" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="delete-task-form" data-action="{{route('delete.task')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-body">
                    <p class="modal-sub-title"> Are you sure you want to Delete this Task? </p>
                    <input type="hidden" name="id" id="delete-task-id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Yes </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Delete Task Modal -->

<script type="text/javascript">
    $("#delete-task-form").validate({
        submitHandler: function (form) {
            var formData = $(form).serialize();
            httpDeleteRequest($(form).data('action'), formData).then(function (response_data) {
                if (response_data.status === true) {
                    showSuccessToast(response_data.response.message);
                    $(form)[0].reset();
                    $("#delete-task-modal").modal('hide');
                    $("#task_list").load(window.location + " #task_list");
                    setTimeout(function () { 
                      location.reload();
                    }, 50);
                } else {
                    showErrorToast(response_data.response.responseJSON.message, errors, 'error', '#a94442');
                }
            });
        }
    });
</script>
