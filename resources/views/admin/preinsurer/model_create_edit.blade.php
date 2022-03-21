 <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="add_editInsrerForm" >
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
    @isset($data)<input name="insurerID"  id="insurerID" type="hidden" value="{{$data->id}}" />@endisset
    <div class="row">
       <div class="col-lg-12 col-md-12">
            <div class="form-group">
              <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" required id="insurer_name" value="{{isset($data)?$data->name:''}}" name="insurer_name"  placeholder="Enter Insurer Name">
            </div>
       </div>
       
       
   </div>
   
   
   <div class="row">
       <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">Digit code <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" required name="insurer_digit_code" id="insurer_digit_code" value="{{isset($data)?$data->digit_code:''}}" placeholder="Digit Code">
            </div>
       </div>
       <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">Type: <span class="tx-danger">*</span></label>
                <select name="insurer_type" id="insurer_type" class="form-control">
                  <option value="">Select</option>
                  <option value="HEALTH" {{(isset($data) && $data->type=='HEALTH')?'selected':''}}>HEALTH</option>
                  <option value="GENERAL" {{(isset($data) && $data->type=='GENERAL')?'selected':''}}>GENERAL</option>
                </select>
            </div>
       </div>
       
        <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">Status<span class="tx-danger">*</span></label>
              <select name="insurer_status" id="insurer_status" class="form-control">
                  <option value="">Select</option>
                  <option value="ACTIVE" {{(isset($data) && $data->status=='ACTIVE')?'selected':''}}>ACTIVE</option>
                  <option value="INACTIVE" {{(isset($data) && $data->status=='INACTIVE')?'selected':''}}>INACTIVE</option>
                </select>
            </div>
       </div>
   </div>
  <div class="row">
        <div class="col-lg-3 col-md-3">
            <button class="btn btn-info insurerSaveChangeBtn" type="button">Save Change</button>
        </div>
    </div>
 </form>