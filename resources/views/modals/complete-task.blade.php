<!-- Complete Task Modal -->
<div class="modal fade" id="complete-task-modal" tabindex="-1" role="dialog" aria-labelledby="complete-task" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Complete Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="complete-task-form" data-action="{{route('complete.task')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-body">
                    <p class="modal-sub-title"> Are you sure you want to Mark this Task as Complete? </p>
                    <input type="hidden" name="id" id="complete-task-id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Yes </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Complete Modal -->

<script type="text/javascript">
    $("#complete-task-form").validate({
        submitHandler: function (form) {
            var formData = $(form).serialize();
            httpPostRequest($(form).data('action'), formData).then(function (response_data) {
                if (response_data.status === true) {
                    showSuccessToast(response_data.response.message);
                    $(form)[0].reset();
                    $("#complete-task-modal").modal('hide');
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
