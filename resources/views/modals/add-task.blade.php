<!-- Add New Task Modal -->
<div class="modal fade" id="add-new-task-modal" tabindex="-1" role="dialog" aria-labelledby="add-task" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="add-task-form" data-action="{{route('add.task')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="modal-body">
                        <div class="form-group">
                            <label for="title-name" class="col-form-label">Title<span class="error">*</span></label>
                            <input type="text" class="form-control" id="task-title", name="task_title">
                        </div>
                        <div class="form-group">
                            <label for="description-text" class="col-form-label">Description<span class="error">*</span></label>
                            <textarea class="form-control" id="task-description" name="task_description"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> Save </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add New Task Modal -->

<script type="text/javascript">
    $("#add-task-form").validate({
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
            httpPostRequest($(form).data('action'), formData).then(function (response_data) {
                if (response_data.status === true) {
                    showSuccessToast(response_data.response.message);
                    $(form)[0].reset();
                    $("#add-new-task-modal").modal('hide');
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
