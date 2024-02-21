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
    swal(showProgressAlert("Processing...", "Please wait"));
    $.ajax({
        url: base_path + "admin/get-user-subsctiptions/" + user_id,
        type: "GET",
        data: {_token:$('meta[name="csrf-token"]').attr('content') },
        success: function(response){
            swal.close();
            $("#subscriptionTable").empty();
            $('#subscriptionTable').append(response);
            $('#subscriptionsModal').modal('toggle'); 
        }
    });
}

function closeModal(){
    $('#subscriptionsModal').modal('toggle'); 
}

/* add dynamic row to candidate calender*/
function addCalendarRow(rowId){
    $('#'+rowId+'-row').after(`
      <tr>
        <td><input type="checkbox" checked disabled></td>
        <td class="text-capitalize">`+rowId+`</td>
        <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="`+rowId+`[start_time][]" value=""></td>
        <td>to</td>
        <td><input type="text" onfocus="(this.type='time')" onblur="(this.type='text')" placeholder="Add Time" name="`+rowId+`[end_time][]" value=""></td>
        <td onclick="removeCalendarRow(event)">
          <a href="javaScript:;" class="btn add-btn icon">
            <i class="fa fa-trash"></i>
          </a>
        </td>
      </tr>
    `);
  }
  
  /* remove calender row */
  function removeCalendarRow(event){
    event.target.closest('tr').remove();
  }

  /* initialize daterange picker */
  $('input[name="daterange[]"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });