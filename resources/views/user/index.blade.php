@extends('layouts.master')
@section('style')
<link rel="stylesheet" href="{{asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- Content Wrapper. Contains page content -->
    <h2>USER MANAGEMENT
    <span class="pull-right">
      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#formModal">ADD NEW USER</button>
    </span></h2>
    <small>All the users in the system</small>
  </div>
</section>
<div class="row">
</div>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Table With Full Features</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped js-basic-example">
            <thead>
              <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>NIC</th>
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
@include('user.modal')
@include('user.editmodal')
<section class="content container-fluid">
  
</section>
<!-- /.content -->
@endsection
@section('script')
<!-- DataTables -->
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- <script src="{{asset('adminlte/build/js/crud-2.0.js')}}"></script> -->

<script type="text/javascript">
    // var ajaxURL = base_url+"/user" 
    var SSPEnable = true
    var opt = {
        processing: true,
        serverSide: true,
        ajax:{
        url:'{{ url('user-all') }}',
        type:'POST',
        dataType: 'JSON',
        beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization');
    }
    },
    columns:[
        {data: 'id' , name: 'id',"visible": false,orderable: true},
        {data: 'name' , name: 'name'},
        {data: 'email' , name: 'email',orderable: false, searchable: false},
        {data: 'nic' , name: 'nic'},
        {data: 'contact_no' , name: 'contact_no'},
        {data: 'created_at' , name: 'created_at'},
        // {data: 'updated_at' , name: 'updated_at'},
        {data: "action",orderable: false, searchable: false},
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
          $('#editformModal input[name="name"]').val(data.name);
          $('#editformModal input[name="email"]').val(data.email);
          $('#editformModal input[name="nic_no"]').val(data.nic);
          $('#editformModal input[name="contact_no"]').val(data.contact_no);
          $("#editformModal").modal('show');
    }
</script>

<script type="text/javascript">

  $(".btn-submit").click(function(event){
        event.preventDefault();
        var formData = {
         role : $('#formModal select[name=role]').val(),
         name : $('#formModal input[name=name]').val(),
         email : $('#formModal input[name=email]').val(),
         nic_no : $('#formModal input[name=nic_no]').val(),
         contact_no : $('#formModal input[name=contact_no]').val(),
         password : $('#formModal input[name=password]').val(),
         // role : ('select[name="role[]"]').val(),
        }
        $.ajax({
           type:'POST',
           url:"user/create",
           data:formData,
           success:function(data){
              loadDatatable(data.msg)
           }

        });
  });


    //Delete
$('.js-basic-example').on('click', '.btn-danger', function(event) {
  event.preventDefault();

  if (confirm("Confirm delete?")) {

      id = $(this).data('id')
      url = "user/"+id
      $.ajax({
        url: url,
        type: "DELETE",
        // headers: {'X-CSRF-TOKEN':token},
        dataType:'JSON',
        sync: true
      })
        .done(function(data) {
           loadDatatable(data.msg)
        })
        .fail(function(data) {
          alert(data.fail);
        })
      }

  });

function loadDatatable(msg) {
      var table = $('#example1').DataTable();
      table.draw();
      $("#formModal").modal('hide');
      $("#editformModal").modal('hide');
      clearModal();
}

$(document).on('click','.btn-info',function(){
        id = $(this).data('id')
        $.get("user/"+id+"/edit", function (data) {
          //success data
          setModal(data);
        }) 
    });

$('#editformModal').on('click', '#editbtnSubmit', function(event) {
      event.preventDefault();
        var formData = {
         id : $('#editformModal input[name=id]').val(),
         name : $('#editformModal input[name=name]').val(),
         email : $('#editformModal input[name=email]').val(),
         nic_no : $('#editformModal input[name=nic_no]').val(),
         contact_no : $('#editformModal input[name=contact_no]').val(),
         password : $('#editformModal input[name=password]').val(),
         // role : ('select[name="role[]"]').val(),
        }
        $.ajax({
           type:'PUT',
           url:"user/"+id,
           data:formData,
           success:function(data){
              loadDatatable(data.msg)
           }
        });
  });


    function clearModal() {
      update = 0
      $('#btnSubmit').prop("disabled", false)
      $('#formCreate').find('input').val('')
      $('#formCreate').find('input[name="_token"]').val(token)
      $('#formCreate').find('textarea[type="text"]').val('')
      $('#formCreate').find('input[type="checkbox"]').attr({'checked': false})
      $('#formCreate').find('select').selectpicker('val', 0);
      $('input[name="_token"]').val(token)
    }

    $('.close').click(function(event){
        clearModal();
    });

</script>


@endsection