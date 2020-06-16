var Profile = (function () {

    var handleConfirmation = function () {
        $('[data-confirmation="notie"]').on('click', function () {
            $this = $(this);
            deleteRole($this);

            return false
        })
    }

    $("#changePassword").on('click', function (e) {
        var passowrd = $('#profile_pwd').val();
        var confirm_passowrd = $('#profile_conf_pwd').val();
        var url = $('#url').val();
         if(passowrd !== confirm_passowrd){
             toastr['error']('Password doesn\'t match', 'Error')
         }

        $.get(url + '?password=' + passowrd, function (data) {
            console.log(data);
            toastr['success']('Password Successfully changed', 'Success')
            setTimeout(function () {
                location.reload();
            }, 500);
        })


        console.log(url)
        // $.ajax({
        //     type: 'POST',
        //     data: {_method: 'delete', _token: token, passowrd: passowrd, confirm_passowrd: confirm_passowrd},
        //     url: url,
        //     success: function (data) {
        //         toastr['success']('Department Deleted', 'Success')
        //         setTimeout(function () {
        //             location.reload();
        //         }, 500);
        //
        //     },
        //     error: function (data) {
        //         toastr['error']('There was an error', 'Error')
        //     }
        // })
    });


    // var changePassword = function ($this) {
    //
    //   toastr['success']('This is working', 'Success')
    //   // var url = $this.attr('href')
    //   // var token = $this.data('token')
    //   // console.log(url)
    //   // $.ajax({
    //   //   type: 'POST',
    //   //   data: {_method: 'delete', _token: token},
    //   //   url: url,
    //   //   success: function (data) {
    //   //     toastr['success']('Department Deleted', 'Success')
    //   //     setTimeout(function(){ location.reload(); }, 500);
    //   //
    //   //   },
    //   //   error: function (data) {
    //   //     toastr['error']('There was an error', 'Error')
    //   //   }
    //   // })
    // }
    $("#audits-datatable tbody tr td #audit-change ").on('change', function (e) {
        var audit_id = $(this).data('audit');
        var id = $(this).data('id');
        var url = $(this).data('url');
        var value = $(this).data('balance');
        //alert(url);

        $.get(url + '?audit_id=' + audit_id + '&prod_id=' + id + '&balance=' + value, function (data) {
            console.log(data);
            toastr['success']('Successfully Updated', 'Success')
            setTimeout(function () {
                location.reload();
            }, 500);
        })
    });


    $("#audits-datatable tbody tr td #audit-report").on('click', function (e) {
        var audit_id = $(this).data('audit');
        var id = $(this).data('id');
        var url = $(this).data('url');

        $(this).closest('tr').find('#report-input').each(function () {
            var missing = $(this).val();
            $.get(url + '?audit_id=' + audit_id + '&prod_id=' + id + '&missing=' + missing, function (data) {
                console.log(data);
                toastr['success']('Successfully Updated', 'Success')
                setTimeout(function () {
                    location.reload();
                }, 500);
            })
        })


    });
    return {
        // main function to initiate the module
        init: function () {
            handleTables()
            handleConfirmation()
        }
    }
})()

jQuery(document).ready(function () {
    Profile.init()
})
