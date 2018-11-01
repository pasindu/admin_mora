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
    <h2><img src="{{asset('adminlte/dist/img/lease.png')}}" width="25" height="25" alt=""> LEASE OFFICER MANAGEMENT
    <span class="pull-right">
      <button type="button" class="btn btn-block btn-primary" data-backdrop="static" data-toggle="modal" data-target="#formModal" id="addOfficer">ADD NEW OFFICER</button>
    </span></h2>
    {{-- <small>All the users in the system</small> --}}
  </div>
</section>
  <div class="page-loading"></div>
<div class="row">
</div>
<!-- Main content -->

</section>
<section class="content page-content" style="display: none;">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All the lease companies in the system</h3>
        </div
        <!-- /.box-header -->
        <div class="box-body">
          <table id="dt_basic" class="table table-bordered table-striped js-basic-example" style="width: 100%">
            <thead>
              <tr>
                <!-- <th>ID</th> -->
                <th>COMPANY NAME</th>
                <th>BRANCH DISTRICT</th>
                <th>BRANCH LOCATION</th>
                <th>NAME</th>
                <th>POST</th>
                <th>NIC</th>
                <th>EMAIL</th>
                <th>CONTACT NO</th>
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

@include('lease_officer.modal')
@include('lease_officer.create')

  
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
        url:'{{ url('officer-all') }}',
        type:'POST',
        dataType: 'JSON',
        beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization');
    }
    },
    columns:[
        // {data: 'id' , name: 'id',"visible": false,orderable: true},
        {data: 'leasecompanies.company_name' , name: 'leasecompanies.company_name'},
        {data: 'districts.dname' , name: 'districts.dname',orderable: false, searchable: false},
        {data: 'city.cname' , name: 'city.cname'},
        {data: 'officer_name' , name: 'officer_name'},
        {data: 'designation' , name: 'designation'},
        {data: 'nic' , name: 'nic'},
        {data: 'email' , name: 'email'},
        {data: 'contact_no' , name: 'contact_no'},
        {data: "action",orderable: false, searchable: false},
        // {data: 'created_at' , name: 'created_at'},

    ],
    }

    
</script>


<script type="text/javascript">

    $(function () {
      datatabel = $('#dt_basic').DataTable(opt);
          // alert(1);
    });
</script>

<script type="text/javascript">

  $(".btn-submit").click(function(event){
        event.preventDefault();

        $.ajax({
           type:'POST',
           url:"lease_officer/create",
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
      url = "lease_officer/"+id
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
      var table = $('#dt_basic').DataTable();
      table.draw();
      $('#btnSubmit').prop("disabled", false)
      $("#formModal").modal('hide');
      $("#editformModal").modal('hide');
      clearModal();
}

$(document).on('click','.btn-info',function(){
        id = $(this).data('id')
  // alert(id);
        
        $.get("lease_officer/"+id+"/edit", function (data) {
          //success data
          console.log(data);
          $('#leaseOfficerEditContent').html(data);
          $("#editformModal").modal('show');

        }) 
    });


$(document).on('click','#addOfficer',function(){
        // id = $(this).data('id')
        $("#formModal").modal('show');
  // alert(1);
        

    });


//Edit/update
$('#editformModal').on('click', '#editbtnSubmit', function(event) {
  // alert(1);
      event.preventDefault();

        $.ajax({
           type:'PUT',
           url:"lease_officer/"+id,
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


</script>


@endsection