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
    var user_status = $("#status_checkbox"+user_id).is(":checked") ? 1 : 0;

    swal({
        title: "Are you sure?",
        text: "Do you want to change the status for this user",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: "No, cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
            $.ajax({
                url: "{{url('admin/change-user-status')}}",
                type: "POST",
                data: {_token: '{{csrf_token()}}', user_status:user_status, user_id:user_id },
                success: function(response){
                    //if(response.status == 200){
                        //$('#familyTable').DataTable().ajax.reload();
                        swal("Deleted", "Status changed successfully!", "success");
                    //}
                }
            });
        } else {
            swal("Cancelled", "Your data safe!", "error");
        }
    });
}