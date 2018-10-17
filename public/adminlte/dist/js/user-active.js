$('.js-basic-example').on('click', 'input[type="checkbox"]', function(event) {
  // alert(1);
  id = $(this).val();
  active =  $(this).is(':checked') ? 1 : 0;

  $.ajax({
    url:'/user-active',
    type: 'POST',
    dataType: 'JSON',
    data: {user_id: id,active:active}
  })
  .done(function(data) {
    // $.notify({message: data.msg},{type: 'success',z_index:2000});
    toastr["success"](data.msg);
  })
  .fail(function(data) {

          errorHandler(data.responseJSON)
          
    //$.each(data.responseJSON, function(index, val) {
    //$.notify({message: val},{type: 'danger',z_index:2000});
    // });
  })

});