$(document).on("click", "#delete-task", function () {
    var taskId = $(this).data('id');
    $("#delete-task-id").val( taskId );
    $('#delete-task-modal').modal('show');
});

$(document).on("click", "#complete-task", function () {
    var taskId = $(this).data('id');
    $("#complete-task-id").val( taskId );
    $('#complete-task-modal').modal('show');
});

$(document).on("click", "#edit-task", function () {
    var taskId = $(this).data('id');
    var title = $(this).data('title');
    var description = $(this).data('description');

    $("#edit-task-id").val( taskId );
    $("#edit-task-title").val(title);
    $("#edit-task-description").val(description);
    $('#edit-task-modal').modal('show');
});


$(document).ready(function () {
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {

        }
    });
    setInterval(function () {
        $(".alert").hide('300');
    }, 3000);

});

$(document).ajaxComplete(function () {
    try {
        $.unblockUI();
    } catch (err) {
        console.log(err);
    }
});

function showSuccessToast(message) {
    try {
        toastr.success(message);
    } catch (err) {
        console.log(err);
    }
}

function showErrorToast(message) {
    try {
        toastr.error(message);
    } catch (err) {
        console.log(err);
    }
}

function httpPostRequest(Url, data) {
    var promise = $.Deferred();
    $.ajax({
        type: 'POST',
        url: Url,
        data: data,
        dataType: 'json',
        encode: true,
        success: function (response) {

            promise.resolve({
                'status': true,
                'response': response
            });
        },
        error: function (error) {
            $.unblockUI();
            promise.resolve({
                'status': false,
                'response': error
            });
        }

    });
    return promise;
}

function httpPutRequest(Url, data) {
    var promise = $.Deferred();
    $.ajax({
        type: 'PUT',
        url: Url,
        data: data,
        dataType: 'json',
        encode: true,
        success: function (response) {

            promise.resolve({
                'status': true,
                'response': response
            });
        },
        error: function (error) {
            $.unblockUI();
            promise.resolve({
                'status': false,
                'response': error
            });
        }

    });
    return promise;
}

function httpGetRequest(Url, data) {
    var promise = $.Deferred();
    $.ajax({
        type: 'GET',
        url: Url,
        data: data,
        dataType: 'json',
        encode: true,
        success: function (response) {
            promise.resolve({
                'status': true,
                'response': response
            });
        },
        error: function (error) {
            $.unblockUI();
            promise.resolve({
                'status': false,
                'response': error
            });
        }
    });
    return promise;
}

function httpDeleteRequest(Url, data) {
    var promise = $.Deferred();
    $.ajax({
        type: 'DELETE',
        url: Url,
        data: data,
        dataType: 'json',
        encode: true,
        success: function (response) {

            promise.resolve({
                'status': true,
                'response': response
            });
        },
        error: function (error) {
            $.unblockUI();
            promise.resolve({
                'status': false,
                'response': error
            });
        }

    });
    return promise;
}
