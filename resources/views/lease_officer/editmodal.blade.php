       <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
            <!-- <form role="form"> -->
                <!-- text input -->
          {!! Form::open(['id' => 'formUpdate'])!!}
          {{ csrf_field()}}

            <div class="form-group">
               <label>Company Name</label>
                <div class="form-line">
                  <select name="c_name" class="form-control show-tick">
                      <option value="" class="form-label">Select Company</option>
                      @foreach($leasecompany as $element)
                        <option value="{{$element->id}}" {{ $leaseofficer->company_id == $element->id ? 'selected' : '' }}>{{$element->company_name}}</option>
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
                          <option value="{{$district->id}}" {{ $leaseofficer->district_id == $district->id ? 'selected' : '' }}>{{$district->dname}}</option>
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
                          <option value="{{$element->id}}" {{ $leaseofficer->city_id == $element->id ? 'selected' : '' }}>{{$element->cname}}</option>
                        @endforeach
                    </select>
                </div>
              </div>

                <div class="form-group">
                  <label>Officer Name</label>
                  <div class="form-line">
                  <input type="text" value="{{$leaseofficer->officer_name}}" class="form-control" placeholder="" name="officer_name"></div>
                </div>

                <div class="form-group">
                  <label>Post</label>
                   <div class="form-line">
                  <input type="text" value="{{$leaseofficer->designation}}" class="form-control" placeholder="" name="officer_post"></div>
                </div>

                <div class="form-group">
                  <label>NIC No.</label>
                  <div class="form-line">
                  <input type="text" value="{{$leaseofficer->nic}}" class="form-control" placeholder="" name="nic_no"></div>
                </div>

                <div class="form-group">
                  <label>Contact No</label>
                   <div class="form-line">
                  <input type="text" value="{{$leaseofficer->contact_no}}" class="form-control" placeholder="" name="contact_no"></div>
                </div>
                  <div class="form-group">
                  <label>Email</label>
                   <div class="form-line">
                  <input type="text" value="{{$leaseofficer->email}}" class="form-control" placeholder="" name="email"></div>
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
           <!-- </form> -->
            </div>
            <!-- /.box-body -->
          </div>