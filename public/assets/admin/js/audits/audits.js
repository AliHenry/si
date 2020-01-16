var Users = (function () {
  var handleTables = function () {
    $('#audits-datatable').DataTable({
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
  $("#audits-datatable tbody tr td #audit-change ").on('change', function (e) {
    var audit_id = $(this).data('audit');
    var id = $(this).data('id');
    var url = $(this).data('url');
    var value = $(this).data('balance');
    //alert(url);

    $.get(url+'?audit_id=' +audit_id+'&prod_id='+id+'&balance='+value, function (data) {
      console.log(data);
      toastr['success']('Successfully Updated', 'Success')
      setTimeout(function(){ location.reload(); }, 500);
    })
  });



  $("#audits-datatable tbody tr td #audit-report").on('click', function (e) {
    var audit_id = $(this).data('audit');
    var id = $(this).data('id');
    var url = $(this).data('url');

    $(this).closest('tr').find('#report-input').each(function () {
      var missing = $(this).val();
      $.get(url+'?audit_id=' +audit_id+'&prod_id='+id+'&missing='+missing, function (data) {
        console.log(data);
        toastr['success']('Successfully Updated', 'Success')
        setTimeout(function(){ location.reload(); }, 500);
      })
    })


    // const classup = document.querySelectorAll('.btn btn-danger');
    //
    // classup.forEach((element, key) => element.addEventListener('click', function () {
    //   event.preventDefault();
    //   const id = element.getAttribute('data-id');
    //   const classinput = document.querySelectorAll('.audit-input');
    //   //classinput[key].value = ++classinput[key].value;
    //
    //   alert(classinput[key].value);
    //   // update(id, classinput[key].value)
    // }));



    // $.get(url+'?audit_id=' +audit_id+'&prod_id='+id+'&balance='+value, function (data) {
    //   console.log(data);
    //   toastr['success']('Successfully Updated', 'Success')
    //   setTimeout(function(){ location.reload(); }, 500);
    // })
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
