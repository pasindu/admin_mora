@extends('layouts.master')
@section('style')
<link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<style type="text/css">
.page-loading{
    background-image: url('adminlte/dist/img/ring-spinner.gif');
    height: 100%; 
    width: 100%; 
    background-repeat: no-repeat; 
    background-position: center; 
    background-color: white; 
    position: absolute; 
    top:0;
    animation: spin 2s infinite linear;
}
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- Content Wrapper. Contains page content -->
    <h2><img src="{{asset('adminlte/dist/img/company.png')}}" width="25" height="25" alt=""> LEASE COMPANY
    <span class="pull-right">
      <button type="button" class="btn btn-block btn-primary" data-backdrop="static" data-toggle="modal" data-target="#formModal">ADD NEW COMPANY</button>
    </span></h2>
    {{-- <small>All the users in the system</small> --}}
  </div>
</section>
  <div class="page-loading"></div>
<div class="row">
</div>
<!-- Main content -->
<section class="content page-content" style="display: none;">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All the lease companies in the system</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped js-basic-example" style="width: 100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>COMPNAY NAME</th>
                <th>EMAIL</th>
                <th>CONTACT NO</th>
                <th>CREATED_AT</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
                  
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

<!-- /.content -->

@include('lease_company.modal')
@include('lease_company.editmodal')
<section class="content container-fluid">
  
</section>
<!-- /.content -->
@endsection
@section('script')
<!-- DataTables -->
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>



<script type="text/javascript">
    // var ajaxURL = base_url+"/user" 
    var SSPEnable = true
    var opt = {
        processing: true,
        serverSide: true,
        ajax:{
        url:'{{ url('company-all') }}',
        type:'POST',
        dataType: 'JSON',
        beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization');
    }
    },
    columns:[
        {data: 'id' , name: 'id',"visible": false,orderable: true},
        {data: 'company_name' , name: 'company_name'},
        {data: 'email' , name: 'email'},
        {data: 'contact_no' , name: 'contact_no'},
        {data: 'created_at' , name: 'created_at'},
        {data: "action",orderable: false, searchable: false},
        // {data: 'manager_name' , name: 'manager_name',orderable: false, searchable: false},
        // {data: 'updated_at' , name: 'updated_at'},
        // {data: "active",orderable: false, searchable: false},
        // {data: "active" ,orderable: false, searchable: false},
    ],
    }

    $(function () {
      datatabel = $('#example1').DataTable(opt);
    });
</script>


<script type="text/javascript">
  function setModal(data) {

          $('#editformModal input[name="id"]').val(data.id);
          $('#editformModal input[name="c_name"]').val(data.company_name);
          $('#editformModal input[name="c_manager"]').val(data.manager_name);
          $('#editformModal input[name="c_email"]').val(data.email);
          $('#editformModal input[name="contact_no"]').val(data.contact_no);
          $("#editformModal").modal('show');
    }
</script>

<script type="text/javascript">

  $(".btn-submit").click(function(event){
        event.preventDefault();
        $.ajax({
           type:'POST',
           url:"lease_company/create",
           data:$('#formCreate').serialize(),
         })
        .done(function(data) {
          toastr["success"](data.msg);
          loadDatatable(data.msg)
        })
        .fail(function(data) {
          if(data.status == 422){
            errorHandler(data.responseJSON)
          }
        })
  });

    //Delete
$('.js-basic-example').on('click', '.btn-danger', function(event) {
  event.preventDefault();

  if (confirm("Confirm delete?")) {

      id = $(this).data('id')
      url = "lease_company/"+id
      $.ajax({
        url: url,
        type: "DELETE",
        dataType:'JSON',
        sync: true
      })
        .done(function(data) {
          toastr["success"](data.msg);  
          loadDatatable(data.msg)
        })
        .fail(function(data) {
          toastr["error"](data.msg);
        })
      }

  });

function loadDatatable(msg) {
      var table = $('#example1').DataTable();
      table.draw();
      $('#btnSubmit').prop("disabled", false)
      $("#formModal").modal('hide');
      $("#editformModal").modal('hide');
      clearModal();
}

$(document).on('click','.btn-info',function(){
        id = $(this).data('id')
        $.get("lease_company/"+id+"/edit", function (data) {
          //success data
          setModal(data);
        }) 
    });


//Edit/update
$('#editformModal').on('click', '#editbtnSubmit', function(event) {
      event.preventDefault();
        $.ajax({
           type:'PUT',
           url:"lease_company/"+id,
           data: $('#formUpdate').serialize(),
           })
           .done(function(data) {
              toastr["success"](data.msg);
              loadDatatable(data.msg)
            })
            .fail(function(data) {
                            // toastr["error"](data.msg);
            if(data.status == 422){
            errorHandler(data.responseJSON)
          }
        })
  });


    function clearModal() {
      update = 0
      $('#btnSubmit').prop("disabled", false)
      $('#formCreate').find('input').val('')
      $('#formCreate').find('textarea[type="text"]').val('')
      $('#formCreate').find('input[type="checkbox"]').attr({'checked': false})
      $('#formCreate').find('select').selectpicker('val', 0);
      $('input[name="_token"]').val(token)
    }

    $('.close').click(function(event){
        clearModal();
    });



// $("[name='my-checkbox']").bootstrapSwitch();

</script>


@endsection