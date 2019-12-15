var Users = (function () {


    var handleConfirmation = function () {
        $('[data-confirmation="notie"]').on('click', function () {
            $this = $(this);
            deleteRole($this);

            return false
        })
    }

    $('#state').on('change', function (e) {
        var state_id = e.target.value;
        var url = $(this).data('url');
        $.get(url+'?state_id=' +state_id, function (data) {
            console.log('its changed');
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
            handleConfirmation()
        }
    }
})()

jQuery(document).ready(function () {
    Users.init()
})
