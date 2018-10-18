        <div class="modal fade" id="formModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LEASE COMPANY REGISTRATION</h4>
              </div>
              <div class="modal-body">
                <div class="box box-primary">

            <!-- /.box-header -->
            <div class="box-body">
 <!--              <form role="form"> -->
                <!-- text input -->
          {!! Form::open(['id' => 'formCreate'])!!}
          {{ csrf_field()}}

                <div class="form-group">
                  <label>Company Name</label>
                <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="c_name"></div>
                </div>


<!--                 <div class="form-group">
                  <label>Branch Manager</label>
                  <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="c_manager"></div>
                </div> -->
 
                <div class="form-group">
                  <label>Email</label>
                  <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="c_email"></div>
                </div>
                <div class="form-group">
                  <label>Contact No</label>
                   <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="contact_no"></div>
                </div>

          {!! Form::close()!!}
   <!--            </form> -->
            </div>
            <!-- /.box-body -->
          </div>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn-submit btn btn-primary" id="btnSubmit">Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>