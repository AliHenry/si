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
