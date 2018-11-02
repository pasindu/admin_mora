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
    <h2><img src="{{asset('adminlte/dist/img/lease.png')}}" width="25" height="25" alt=""> ADD USER REQUEST (LEASE)
    <span class="pull-right">
    </span></h2>
    {{-- <small>All the users in the system</small> --}}
  </div>
</section>
  <div class="page-loading"></div>
<div class="row">
</div>
<!-- Main content -->

    <!-- Main content -->
    <section class="content"> 
          <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-group">
                <label>Name</label>
                <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="name">
                </div>
              </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <div class="form-group">
                  <label>NIC</label>
                  <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="nic">
                </div>
              </div>
              </div>

                <div class="form-group">
                  <div class="form-group">
                  <label>Location</label>
                  <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="location">
                </div>
              </div>
              </div>

                <div class="form-group">
                  <div class="form-group">
                  <label>Contact No</label>
                  <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="contactno">
                </div>
              </div>
              </div>

                <div class="form-group">
                  <div class="form-group">
                  <label>Email</label>
                  <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="email">
                </div>
              </div>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-group">
                <label>BR No</label>
                <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="brno">
                </div>
              </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <div class="form-group">
                <label>Businuess Name</label>
                <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="businessname">
                </div>
              </div>
              </div>

               <div class="form-group">
                <div class="form-group">
                <label>Monthly Income</label>
                <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="income">
                </div>
              </div>
              </div>

              <div class="form-group">
                <div class="form-group">
                <label>Vehical Type</label>
                <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="vehicalType">
                </div>
              </div>
              </div>

              <div class="form-group">
                <div class="form-group">
                <label>Vehical No</label>
                <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="vehicalNo">
                </div>
              </div>
              </div>

               <div class="form-group">
                <div class="form-group">
                <label>Vehical Photo</label>
                <div class="form-line">
                  <input type="file" class="form-control" placeholder="" name="vehicalPhoto">
                </div>
              </div>
              </div>
              <!-- /.form-group -->
            </div>
                <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn-submit btn btn-primary btn-lg" id="btnSubmit">Submit</button>
              </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </div>

    </section>

<!-- /.content -->

@endsection
@section('script')
<!-- DataTables -->
<script src="{{asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>






@endsection