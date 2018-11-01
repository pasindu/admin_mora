  <div class="modal fade" id="formModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">LEASE OFFICER REGISTRATION</h4>
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
                    <select name="c_name" class="form-control show-tick">
                        <option value="" class="form-label">Select Company</option>
                        @foreach($leasecompany as $element)
                          <option value="{{$element->id}}">{{$element->company_name}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
             <div class="form-group">
                 <label>Branch District</label>
                  <div class="form-line">
                    <select name="c_distric" class="form-control show-tick">
                        <option value="" class="form-label">Select City</option>
                         @foreach($districts as $district)
                          <option value="{{$district->id}}">{{$district->dname}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
                <div class="form-group">
                 <label>Branch City</label>
                  <div class="form-line">
                    <select name="c_city" class="form-control show-tick">
                        <option value="" class="form-label">Select City</option>
                        @foreach($city as $element)
                          <option value="{{$element->id}}">{{$element->cname}}</option>
                        @endforeach
                    </select>
                </div>
              </div>

                <div class="form-group">
                  <label>Officer Name</label>
                  <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="officer_name"></div>
                </div>

                <div class="form-group">
                  <label>Post</label>
                   <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="officer_post"></div>
                </div>

                <div class="form-group">
                  <label>NIC No.</label>
                  <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="nic_no"></div>
                </div>

                <div class="form-group">
                  <label>Contact No</label>
                   <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="contact_no"></div>
                </div>
                  <div class="form-group">
                  <label>Email</label>
                   <div class="form-line">
                  <input type="text" class="form-control" placeholder="" name="email"></div>
                </div>
<!--                   <div class="form-group">
                  <label>Password</label>
                <div class="form-line">
                  <input type="password"  class="form-control" placeholder="" name="password"></div>
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                <div class="form-line">
                  <input type="password"  class="form-control" placeholder="" name="password_confirmation"></div>
                </div> -->

          {!! Form::close()!!}
   <!--            </form> -->
            </div>
            <!-- /.box-body -->
          </div>
              </div>
                <div class="modal-footer">
                <button type="button" class="btn-submit btn btn-primary" id="btnSubmit">Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>