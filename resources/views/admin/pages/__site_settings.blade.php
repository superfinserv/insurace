 @extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card bd-0 ">
            <div class="card-header bg-danger d-flex  align-items-center justify-content-between pd-y-5">
              <h6 class="mg-b-0 tx-14 tx-white"> Site Settings</h6>
               <div class="card-option tx-24">
                    <a id="btnClearCache" class="btn btn-dark active btn-sm" href="#">Clear Cache</a>
                </div>
            </div><!-- card-header -->
            <div class="card-body bd bd-t-0 rounded-bottom">
               
                 <div class="">
                     <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="siteSettingsForm" >
                       <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                     @foreach($data as $row)
                         
                            <div class="row mg-t-20">
                              <label class="col-2 col-sm-2 form-control-label">
                               {{$row->label}}:
                              </label><!-- col-4 -->
                              <div class="col-7 col-sm-7 mg-t-10 mg-sm-t-0">
                                <input class="form-control input-fields" type="{{$row->inputType}}" name="{{$row->key_name}}"  id="{{$row->key_name}}" placeholder="Enter {{$row->label}}" value="{{$row->value}}">
                                <small id="help-block-{{$row->key_name}}" class="form-text text-muted">Updated on {{createFormatDate($row->updated_on,'Y-m-d H:i:s','d/m/Y  \a\t g:ia')}}</small>
                              @if($row->inputType=='file')
                              <img id="src-path-{{$row->key_name}}" src="{{asset($row->upload_path.'/'.$row->value)}}" style="width: 100%;"/>
                              @endif
                              </div><!-- col-8 -->
                              <div class="col-2 col-sm-2 mg-t-10 mg-sm-t-0">
                                  <button type="button" data-type="{{$row->inputType}}" data-key="{{$row->key_name}}" class="btn btn-sm btn-success btn-update-site-settings" >update</button>
                              </div>
                            </div><!-- row -->
                        
                    @endforeach
                     </form>
                  </div>
             </div><!-- card-body -->
            <!-- <div class="card-footer tx-right">-->
            <!--   <a href="#" class="btn btn-info btn-update-site-settings">update Settings</a>-->
            <!--</div>-->
         </div>
         
   </div>
    <div class="col-md-4">
        <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">UAT White List IP address</h6>
                <span class="tx-12 tx-uppercase">Your IP : {{$_SERVER['REMOTE_ADDR']}}</span>
              </div><!-- card-header -->
              <div class="card-body d-xs-flex justify-content-between align-items-center">
                  <div class="row">
                    <div class="col-md-12">
                       <form action="#" id="ipForm">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
                        <div class="d-flex wd-300">
                          <div class="form-group mg-b-0">
                            <label>White List IP address: <span class="tx-danger">*</span></label>
                            <input type="text" id="ip_address" name="ip_address" class="form-control wd-150 wd-xs-250" placeholder="Enter IP address" required="">
                          </div><!-- form-group -->
                          <div class="mg-l-10 mg-t-25 pd-t-4">
                            <button type="submit" class="btn btn-info tx-11 pd-y-12 tx-uppercase tx-spacing-2">ADD</button>
                          </div>
                        </div>
                      </form>
                  </div>
                   <div class="col-md-12">
                       <hr>
                      <table class="table table-bordered">
                      <thead>
                          <tr>
                            <th style="border-top: 1px solid #ccc;">#</th>
                            <th style="border-top: 1px solid #ccc;">IP address</th>
                            <th style="border-top: 1px solid #ccc;">Action</th>
                          <tr>
                      </thead>
                      <tbody class="ip-tbody-inner">
                          <?php $in=1;?>
                          @foreach($ips as $r)
                          <tr id="tr{{$r->id}}">
                             <td style="padding:12px 12px;"><span class="ipTr-span">{{$in}}</span></td>
                            <td style="padding:12px 12px;">{{$r->ip_address}}</td>
                            <td style="padding:12px 12px;">
                                <a class="btn-delete-ip" data-ip="{{$r->ip_address}}"
                                   style="color:red;font-size: 20px;" href="#" 
                                   data-id="{{$r->id}}"><i class="icon ion-ios-trash"></i></a></td>
                           </tr>
                           <?php $in++;?>
                          @endforeach
                          
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div><!-- card-body -->
            </div>
    </div>
</div>
       

      
@endsection