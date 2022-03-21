     @extends('admin.layout.app')
     @section('content')
     <style>
         .has-error::-webkit-input-placeholder { /* Edge */
          color: red;
        }
        
        .has-error:-ms-input-placeholder { /* Internet Explorer 10-11 */
          color: red;
        }
        
       .has-error::placeholder {
          color: red;
        }
     </style>
        <div class="card bd-0">
                  <div class="card-header d-flex  align-items-center justify-content-between pd-y-5">
                  <h6 class="mg-b-0 tx-14 tx-inverse"> Social Media Settings</h6>
                   <div class="card-option tx-24">
                        <a id="btnClearCache" class="btn btn-dark active btn-sm" href="#">Clear Cache</a>
                    </div>
                </div><!-- card-header -->
                <div class="card-body bd bd-t-0 rounded-bottom">
                    <form method="POST" id="settingsFormData">
                     <div class="form-layout form-layout-6">
                         @foreach($results as $row)
                            <div class="row no-gutters">
                              <div class="col-5 col-sm-4" style="padding: 2px 20px;">
                                {{$row->label}}:
                              </div><!-- col-4 -->
                              <div class="col-7 col-sm-8" style="padding: 2px 20px;">
                                <input class="form-control @if($row->inputType=='text') site-settings @endif" value="{{$row->value}}" type="{{$row->inputType}}" id="{{$row->key_name}}" name="{{$row->key_name}}" placeholder="Enter  {{$row->label}}">
                              </div><!-- col-8 -->
                            </div><!-- row -->
                        @endforeach
                       
                        <div class="form-layout-footer bd pd-20 bd-t-0">
                          <button class="btn btn-info" id="btnSaveSettingsiNfo">Submit Form</button>
                          <a  href="{{url('/settings')}}" class="btn btn-secondary">Cancel</a>
                        </div>
                     </div>
                   </form>
                </div>
        </div>
    @endsection