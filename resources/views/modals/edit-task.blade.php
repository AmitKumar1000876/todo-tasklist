<!-- Edit Modal -->
<div class="modal fade" data-backdrop="true" id="edit-task-modal" tabindex="-1" role="dialog" aria-labelledby="edit-task" aria-modal="true">

<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form id="edit-task-form" data-action="{{route('edit.task')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="modal-body">
                <div class="form-group">
                    <label for="title-name" class="col-form-label">Title<span class="error">*</span></label>
                    <input type="text" class="form-control" id="edit-task-title" name="task_title" value="">
                </div>
                <div class="form-group">
                    <label for="description-text" class="col-form-label">Description<span class="error">*</span></label>
                    <textarea class="form-control" id="edit-task-description" name="task_description"></textarea>
                </div>
                <input type="hidden" name="id" id="edit-task-id" value="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> Save </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
</div>
<!-- Edit Modal -->

<script type="text/javascript">
    $("#edit-task-form").validate({
        normalizer: function( value ) {
            return $.trim( value );
        },
        rules: {
            task_title: {
                required: true
            },
            task_description: {
                required: true
            }
        },
        messages: {
            task_title:{
                required: "Please enter task title."
            },
            task_description: {
                required: "Please enter task description."
            }
        },
        onkeyup: false,
        onblur: true,
        submitHandler: function (form) {
            var formData = $(form).serialize();
            httpPutRequest($(form).data('action'), formData).then(function (response_data) {
                if (response_data.status === true) {
                    showSuccessToast(response_data.response.message);
                    $(form)[0].reset();
                    $("#edit-task-modal").modal('hide');
                    $("#task_list").load(window.location + " #task_list");
                    setTimeout(function () { 
                      location.reload();
                    }, 50);
                } else {
                    showErrorToast(response_data.response.responseJSON.message);
                }
            });
        }
    });
</script>
