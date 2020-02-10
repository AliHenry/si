var Users = (function () {
  var handleTables = function () {
    $('#sells-datatable').DataTable({
      responsive: true
    })
    $('#cart-datatable').DataTable({
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
  $("#sells-datatable tbody tr td #add-cart ").on('click', function (e) {
    //var audit_id = $(this).data('audit');
    var id = $(this).data('id');
    var url = $(this).data('url');
    var price = $(this).data('price');
    var name = $(this).data('name');
    //alert(id);

    $.get(url+'?prod_id='+id+'&name='+name+'&price='+price, function (data) {
      console.log(data);
      toastr['success']('Successfully Updated', 'Success')
      setTimeout(function(){ location.reload(); }, 500);
    })
  });

  $("#cart-datatable tbody tr td #delete-cart ").on('click', function (e) {
    var id = $(this).data('id');
    var url = $(this).data('url');


    $.get(url+'?row_id='+id, function (data) {
      console.log(data);
      toastr['success']('Successfully Deleted', 'Success')
      setTimeout(function(){ location.reload(); }, 500);
    })
  });

  $("#cart-datatable tbody tr td #change_qty").on('change', function (e) {
    var id = $(this).data('id');
    var url = $(this).data('url');
    var qty = $(this).val();


    $.get(url+'?row_id='+id+'&qty='+qty, function (data) {
      console.log(data);
      toastr['success']('Successfully Updated', 'Success')
      setTimeout(function(){ location.reload(); }, 500);
    })
  });

  $('#js-example-basic-single').select2({
    placeholder: 'Select an option'
  });

  $('#payment-type').on('change', function (e) {
    //alert(this.value == '1');
    if(this.value == "2"){
      $('#customer-users').show()
      $('#customer-name').hide()
      $('#pos-code').hide()
      $('#received-payment').hide()
      $('#payment-change').hide()
    }
    if(this.value == "1"){
      $('#customer-users').hide()
      $('#customer-name').show()
      $('#pos-code').hide()
      $('#received-payment').show()
      $('#payment-change').show()
    }
    if(this.value == "3"){
      $('#customer-name').show()
      $('#pos-code').show()
      $('#customer-users').hide()
      $('#received-payment').hide()
      $('#payment-change').hide()
    }
  });

  $('#pay').on('change', function () {
    //alert(this.value);
    var total = $(this).data('total');
    var result = this.value - total;
    $('h4.change').text('₦ '+result);
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
