var Users = (function () {
  var handleTables = function () {
    $('#roles-datatable').DataTable({
      responsive: true
    })
  }

  var handleConfirmation = function () {
    $('[data-confirmation="notie"]').on('click', function () {
      $this = $(this);
      deleteRole($this);
      // notie.confirm('Are you sure?', 'Yes! Delete this User', 'Cancel', function () {
      //   toastr['success']('Role Deleted', 'Success')
      //   //deleteRole($this)
      // })
      // notie.confirm({
      //   text: 'Are you sure?',
      //   submitText: 'Yes! Delete this Roles', // optional, default = 'Yes'
      //   cancelText: 'Cancel', // optional, default = 'Cancel'
      //   position: 'top', // optional, default = 'top', enum: ['top', 'bottom']
      //   submitCallback: function () {
      //     toastr['success']('Role Deleted', 'Success')
      //     //deleteRole($this)
      //   },// optional
      //   cancelCallback: Function // optional
      // }, submitCallbackOptional(), cancelCallbackOptional());

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
        toastr['success']('Role Deleted', 'Success')
        //Window.setTimeout('location.reload()', 500)
        setTimeout(function(){ location.reload(); }, 500);

      },
      error: function (data) {
        toastr['error']('There was an error', 'Error')
      }
    })
  }

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
