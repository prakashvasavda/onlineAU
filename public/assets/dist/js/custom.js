/*change user status function*/
function changeUserStatus(user_id, role=null){
    event.preventDefault();
    var status = $("#status_checkbox"+user_id).is(":checked") ? 1 : 0;
    var token = $('meta[name="csrf-token"]').attr('content');

    swal({
        title: "Are you sure?",
        text: "Do you want to change the status for this user",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, Change',
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
            swal(showProgressAlert("Processing...", "Please wait"));
            $.ajax({
                url: base_path + "admin/change-user-status", //base_path is defined in the app layouts folder
                type: "POST",
                data: {_token: token, status:status, id:user_id },
                success: function(response){
                    if(response.status == 200){
                        swal("Success", "Status changed successfully!", "success");
                    }
                }
            });
        } else {
            $('.table').DataTable().ajax.reload();
            swal("Cancelled", "Status change canceled!", "error");
        }
    });
}

function showProgressAlert(title, text){
    return {
        title: title,
        text: text,
        imageUrl: "https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/AjaxLoader.gif",
        showConfirmButton: false,
        allowOutsideClick: false
    };
}

/*view user subscriptions*/
function viewSubscriptions(user_id, role){
    event.preventDefault();
    $.ajax({
        url: base_path + "admin/get-user-subsctiptions/" + user_id,
        type: "GET",
        data: {_token:$('meta[name="csrf-token"]').attr('content') },
        success: function(response){
            $("#subscriptionTable").empty();
            $('#subscriptionTable').append(response);
            $('#subscriptionsModal').modal('toggle'); 
        }
    });
}

function closeModal(){
    $('#subscriptionsModal').modal('toggle'); 
}