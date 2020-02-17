var Users = (function () {
  var handleTables = function () {
    $('#release-datatable').DataTable({
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
  $("#release-datatable tbody tr td #release-product ").on('change', function (e) {
    var sell_id = $(this).data('sell');
    var id = $(this).data('id');
    var url = $(this).data('url');
    var value = $(this).data('status');
    //alert(url);

    $.get(url+'?sell_id=' +sell_id+'&prod_id='+id+'&status='+value, function (data) {
      console.log(data);
      toastr['success']('Successfully Updated', 'Success')
      setTimeout(function(){ location.reload(); }, 500);
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
