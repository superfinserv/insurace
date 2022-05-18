 <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="add_editRuleForm" >
    <input name="_token" type="hidden" value="{{ csrf_token() }}" />
    @isset($data)<input name="code"  id="code" type="hidden" value="{{$data->ruleCode}}" />@endisset
    <div class="row">
       <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">Insuer: <span class="tx-danger">*</span></label>
              <select name="insurer" id="insurer" class="form-control">
                  <option value="">Select</option>
                      @isset($partners)
                       @foreach($partners as $partner)
                          <option value="{{$partner->shortName}}" {{(isset($data) && $data->insurer==$partner->shortName)?'selected':''}}>{{$partner->name}}</option>
                       @endforeach
                      @endisset
               </select>
              
            </div>
       </div>
       
       
       <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">Insurance Type: <span class="tx-danger">*</span></label>
                <select name="instype" id="instype" class="form-control">
                  <option value="">Select</option>
                  <option value="HEALTH" {{(isset($data) && $data->type=='HEALTH')?'selected':''}}>Health</option>
                  <option value="MOTOR" {{(isset($data) && $data->type=='MOTOR')?'selected':''}}>Motor</option>
                  <option value="NON_MOTOR" {{(isset($data) && $data->type=='NON_MOTOR')?'selected':''}}>Non-Motor</option>
                </select>
            </div>
       </div>
       
        <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">Policy Type: <span class="tx-danger">*</span></label>
                <select name="policyType" id="policyType" class="form-control">
                  <option value="">Select</option>
                  <option value="COM" {{(isset($data) && $data->policyType=='COM')?'selected':''}}>Comprehensive </option>
                  <option value="TP" {{(isset($data) && $data->policyType=='TP')?'selected':''}}>Third Party</option>
                  <option value="SAOD" {{(isset($data) && $data->policyType=='SAOD')?'selected':''}}>Standalone Own Damage</option>
                  <option value="FL" {{(isset($data) && $data->policyType=='FL')?'selected':''}}>Floater </option>
                  <option value="IN" {{(isset($data) && $data->policyType=='IN')?'selected':''}}>Individual </option> 
                </select>
            </div>
       </div>
       
   </div>
   
   
   <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">Vehicle Type: <span class="tx-danger">*</span></label>
                <select name="vehicleType" id="vehicleType" class="form-control">
                  <option value="">None</option>
                  <option value="TW" {{(isset($data) && $data->vehicleType=='TW')?'selected':''}}>Two wheeler</option>
                  <option value="CAR" {{(isset($data) && $data->vehicleType=='CAR')?'selected':''}}>Pvt Car</option>
                </select>
            </div>
       </div>
       
       <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">Body Type: </label>
                <select name="bodyType" id="bodyType" class="form-control">
                   <option value="">None</option>
                   <option value="Scooter" {{(isset($data) && $data->bodyType=='Scooter')?'selected':''}}>Scooter</option>
                   <option value="Bike" {{(isset($data) && $data->bodyType=='Bike')?'selected':''}}>Bike</option>
                   
                </select>
            </div>
       </div>
       <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">CPA(Yes/No):</label>
                <select name="cpaOpt" id="cpaOpt" class="form-control">
                  <option value="">None</option>
                  <option value="Yes" {{(isset($data) && $data->CPA=='Yes')?'selected':''}}>Yes</option>
                  <option value="No" {{(isset($data) && $data->CPA=='No')?'selected':''}}>No</option>
                </select>
            </div>
       </div>
    </div>
   <div class="row"> 
       
       
       
       <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">From Date <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" required name="fromDate" id="fromDate" value="{{isset($fromDate)?$fromDate:''}}" placeholder="From Date(d/m/Y)">
            </div>
       </div>
       
       <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label class="form-control-label">To date: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" required name="toDate" id="toDate" value="{{isset($toDate)?$toDate:''}}" placeholder="To Date(d/m/Y)">
            </div>
       </div>
       <div class="col-lg-4 col-md-4">
           <div class="form-group">
              <label class="form-control-label">Commision Type: <span class="tx-danger">*</span></label>
                <select name="cTyp" id="cTyp" class="form-control">
                  <option value="">Select</option>
                  <option value="Percent" {{(isset($data) && $data->commisionType=='Percent')?'selected':''}}>Percent(%)</option>
                  <option value="Fixed" {{(isset($data) && $data->commisionType=='Fixed')?'selected':''}}>Fixed</option>
                </select>
            </div>
       </div>
        
   </div>
   
   <div class="row"> 
   <div class="col-lg-3 col-md-3">
            <div class="form-group">
              <label class="form-control-label">On Amount: <span class="tx-danger">*</span></label>
                <select name="onAmt" id="onAmt" class="form-control">
                  <option value="">Select</option>
                  <option value="Net" {{(isset($data) && $data->onAmt=='Net')?'selected':''}}>Net Total</option>
                  <option value="OD" {{(isset($data) && $data->onAmt=='OD')?'selected':''}}>Net OD</option>
                </select>
            </div>
       </div>
       <div class="col-lg-3 col-md-3">
            <div class="form-group">
              <label class="form-control-label">Total <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" required name="totalOut" id="totalOut" value="{{isset($data)?$data->totalIn:''}}" placeholder="Total Outcome">
            </div>
       </div>
       
       <div class="col-lg-3 col-md-3">
            <div class="form-group">
              <label class="form-control-label">POSP <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" required name="pospOut" id="pospOut" value="{{isset($data)?$data->pospIn:''}}" placeholder="POSP ">
            </div>
       </div>
       
       <div class="col-lg-3 col-md-3">
            <div class="form-group">
              <label class="form-control-label">SP: <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" required name="spOut" id="spOut" value="{{isset($data)?$data->spIn:''}}" placeholder="SP">
            </div>
       </div>
   </div>
  <div class="row">
        <div class="col-lg-3 col-md-3">
            <button class="btn btn-info RuleSaveChangeBtn" type="button">Save Change</button>
        </div>
    </div>
 </form>
 <script>
       $("#fromDate").keypress(function(event) {event.preventDefault();});
       $("#toDate").keypress(function(event) {event.preventDefault();});
       $('#fromDate').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy',
        });
         $('#toDate').datepicker({
           changeMonth: true,changeYear: true,dateFormat: 'dd/mm/yy'
        });
        
        
 </script>