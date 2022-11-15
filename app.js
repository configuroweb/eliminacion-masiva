var confirmModal = $('#confrimModal')
var checked_ids = []
var total_checks = $('input[name="post_id[]"]').length;
var total_checks_checked = checked_ids.length
var post_to_delete_list = $('#post_to_delete_list')
$(document).ready(function(){
    /**
     * Store Checked Post ID
     */
    
    $('input[name="post_id[]"]').change(function(){
        var id = $(this).val()
        if($(this).is(':checked') === true){
            if(($.inArray(id, checked_ids)) < 0)
            checked_ids.push(id)
        }else{
            checked_ids = checked_ids.filter(e => e != id)
        }
        total_checks_checked = checked_ids.length
        if(total_checks_checked == total_checks){
            $('#selectAll').prop('checked',true)
        }else{
            $('#selectAll').prop('checked',false)
        }
        if(total_checks_checked > 0){
            $("#delete_btn").removeClass('d-none')
        }else{
            $("#delete_btn").addClass('d-none')
        }
    })

    /**
     * Select All Function
     */

    $('#selectAll').change(function(e){
        e.preventDefault()
        var _this = $(this)
        if(_this.is(':checked') === true){
            $('input[name="post_id[]"]').prop('checked', true).trigger('change')
        }else{
            $('input[name="post_id[]"]').prop('checked', false).trigger('change')
        }
    })

    /**
     * Delete Confirmation Function 
     */
    $('#delete_btn').click(function(){
        var to_delete = '';
        checked_ids.map(id => {
            var parent = $(`input[name="post_id[]"][value="${id}"]`).closest('tr')
            console.log(`input[name="post_id[]"][value="${id}"]`)
            var post_title = parent.find('td:nth-child(2)').text()
            to_delete += `<li>${post_title}</li>`;
        })
        post_to_delete_list.html(to_delete)
        confirmModal.modal('show')
    })

    /**
     * Reset Selected List in Confirm Modal
     */

    confirmModal.on('hide.bs.modal', function(e){
        post_to_delete_list.html('')
    })

    /**
     * Delete Confirmed Action
     */

    $('#confirm-deletion').click(function(e){
        e.preventDefault()
        var _this = $(this)
        _this.attr('disabled', true)
        $.ajax({
            url:'delete_posts.php',
            method:'POST',
            data:{ids: checked_ids},
            dataType:'json',
            error:(err)=>{
                console.error(err)
                alert("An error occurred while deleting the post(s) data.")
            },
            success:function(resp){
                if(!!resp.status){
                    if(resp.status == 'success'){
                        alert("Selected Post(s) Data has been deleted successfully.")
                        location.reload()
                    }else if(!!resp.error){
                        alert(resp.error)
                    }else{
                        alert("An error occurred while deleting the post(s) data.")
                    }
                }else{
                    alert("An error occurred while deleting the post(s) data.")
                }
            }
        })
    })

})