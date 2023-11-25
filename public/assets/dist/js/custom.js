$(document).ready(function(){
    $('.assign').click(function(){
        alert('in');
        var user_id = $(this).attr('uid');
        var url = $(this).attr('url');
        var l = Ladda.create(this);
        l.start();
        $.ajax({
            url: url,
            type: "post",
            data: {'id': user_id},
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            success: function(data){
                l.stop();
                $('#assign_remove_'+user_id).show();
                $('#assign_add_'+user_id).hide();
            }
        });
    });
    $('.unassign').click(function(){
        alert('out');
        var user_id = $(this).attr('ruid');
        var url = $(this).attr('url');
        var l = Ladda.create(this);
        l.start();
        $.ajax({
            url: url,
            type: "post",
            data: {'id': user_id,'_token' : $('meta[name=_token]').attr('content') },
            success: function(data){
                l.stop();
                $('#assign_remove_'+user_id).hide();
                $('#assign_add_'+user_id).show();
            }
        });
    });
});


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
            $.ajax({
                url: "change-user-status",
                type: "POST",
                data: {_token: token, status:status, id:user_id },
                success: function(response){
                    if(response.status == 200){
                        swal("Deleted", "Status changed successfully!", "success");
                    }
                }
            });
        } else {
            $('.table').DataTable().ajax.reload();
            swal("Cancelled", "Status change canceled!", "error");
        }
    });
}