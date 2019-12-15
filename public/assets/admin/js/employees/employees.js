var Users = (function () {
    var handleTables = function () {
        $('#departments-datatable').DataTable({
            responsive: true
        })
    }

    var handleConfirmation = function () {
        $('[data-confirmation="notie"]').on('click', function () {
            $this = $(this);
            deleteRole($this);

            return false
        })
    }

    var deleteRole = function ($this) {
        var url = $this.attr('href')
        var token = $this.data('token')
        console.log(url)
        $.ajax({
            type: 'POST',
            data: {_method: 'delete', _token: token},
            url: url,
            success: function (data) {
                toastr['success']('Department Deleted', 'Success')
                setTimeout(function () {
                    location.reload();
                }, 500);

            },
            error: function (data) {
                toastr['error']('There was an error', 'Error')
            }
        })
    }


    $('#department').on('change', function (e) {
        var dept_id = e.target.value;
        var url = $(this).data('url');
        $.get(url+'?dept_id=' +dept_id, function (data) {
            console.log(data);
            $('#designation').empty();

            $('#designation').append('<option value="null" disable="true" selected="true"> -- select designation -- </option>');

            $.each(data, function (index, designationObj) {
                $('#designation').append('<option value="'+designationObj.id+'"> '+designationObj.name+' </option>');
            })
        })


    });

    $('#state').on('change', function (e) {
        var state_id = e.target.value;
        var url = $(this).data('url');
        $.get(url+'?state_id=' +state_id, function (data) {
            console.log(data);
            $('#lga').empty();

            $('#lga').append('<option value="null" disable="true" selected="true"> -- select LGA -- </option>');

            $.each(data, function (index, lgaObj) {
                $('#lga').append('<option value="'+lgaObj.id+'"> '+lgaObj.name+' </option>');
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
    Users.init()
})
