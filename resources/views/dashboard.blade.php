{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.master')

@section('style')

@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
{{--                 <span class="pull-right">
                  <a class="btn bg-teal waves-effect" href="">Button</a>
                  <button type="button" class="btn bg-brown waves-effect" data-target="#filterPanel" data-toggle="collapse">Button</button>
                  </span> --}}
                    <h2>
                       Dashboard<br>
                        <small>System Details</small>
                    </h2>
                </div>
                <div class="body">

                </div>
            </div>
        </div>
</section>

{{-- <section class="content container-fluid">

</section> --}}
<!-- /.content -->
@endsection

@section('script')

@endsection