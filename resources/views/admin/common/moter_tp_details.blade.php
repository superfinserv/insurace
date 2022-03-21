<style>
    .select2-container{
            z-index: 9999999999;
    }
    .form-group {
     margin-bottom: 0px; 
    }
    #TpDetailsForm button{
            padding: 8px 15px;
            font-size: 12px;
            width: 100%;
            background:#AC0F0B;
    }
    #TpDetailsForm button:hover {
          background-color: #AC0F0B;
        }
    /*.tp-title{*/
    /*    color:#AC0F0B;*/
    /*}*/
</style>
<form id="TpDetailsForm">
    <div class="row" style="margin-bottom: 8px;">
        <div class="col-md-12">
            <div class="form-group">
                <h5 style="font-weight: 600;">Third Party Cover Status?</h5>
                <div class="custom-radio " style="padding-left: 1.5rem;display: inline;">
        		  	<input type="radio" class="custom-control-input TPstatus" id="TPstatusExp" name="TPstatus" value="YES">
        		  	<label class="custom-control-label" for="TPstatusExp">Expired</label>
        		</div> <!-- form-check.// -->
        
        		<div class="custom-radio " style="padding-left: 1.5rem;display: inline;">
        		  	<input type="radio" class="custom-control-input TPstatus" id="TPstatusNExp" name="TPstatus" value="NO" checked>
        		 	<label class="custom-control-label" for="TPstatusNExp">Not Expired</label>
        		</div> <!-- form-check.// -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                    <label for="name" style="width: 100%;font-weight: 600;">Third Party Policy Insurer</label>    
                    <select style="margin-bottom:0px;" class="form-control " id="TPInsurer" name="TPInsurer">
                      <option value="">Select</option>
                      <?php foreach ($previous_insurer as  $insurer) { ?>
                        <option value="{{$insurer->id}}">{{$insurer->name}}</option>
                      <?php } ?>
                    </select>
                </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" style="width: 100%;font-weight: 600;">Policy Number</label>    
                <input style="margin-bottom:0px;" type="text" name="TP_policyno" id="TP_policyno" class="form-control word-uppercase" placeholder="Enter Policy Number" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" style="width: 100%;font-weight: 600;">Policy StartDate</label>    
                <input style="margin-bottom:0px;" type="text" name="TPpolicyStartDate" id="TPpolicyStartDate" class="dob form-control dob-mask" placeholder="Policy Start Date" autocomplete="off">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" style="width: 100%;font-weight: 600;">Policy EndDate</label>    
                <input style="margin-bottom:0px;" type="text" name="TPpolicyEndDate" id="TPpolicyEndDate" class="dob form-control dob-mask" placeholder="Policy End Date" autocomplete="off">
            </div>
        </div>
    </div>
    <hr/>
     <div class="row">
           <div class="col-md-6">
            <div class="form-group">
                    <label for="name" style="width: 100%;font-weight: 600;">Prevoius Policy Type</label>    
                    <select style="margin-bottom:0px;" class="form-control " id="prePolicyType" name="prePolicyType">
                      <option value="">Select</option>
                     <option value="1-OD_3-TP">1 Year OD and 1 Year TP</option>
                     <option value="0-OD_1-TP">TP only </option>
                     @if($type=='car')
                     <option value="0-OD_3-TP">3 Year TP only </option>
                     <option value="1-OD_3-TP">1 Year OD and 3 Year TP </option>
                     <option value="3-OD_3-TP">3 Year OD and 3 Year TP </option>
                     @endif
                     @if($type=='bike')
                     <option value="0-OD_3-TP">5 Year TP only </option>
                     <option value="5-OD_5-TP">5 Year OD and 5 year TP</option>
                     <option value="1-OD_5-TP">1 Year OD and 5 Year TP </option>
                     @endif
                    </select>
                </div>
            </div>
     
        <div class="col-md-6">
            <button class="btn btn-danger" type="">Okay</button>
        </div>
     </div>
</form>
<script>
    $('.dob-mask').mask('0000-00-00');
     $(".dob").datepicker({
        format: 'yyyy-mm-dd', autoclose: true,
     });
    $('#TPInsurer').select2({
        placeholder: "Select Policy Insurer",
        allowClear: true
    });
     $("#TpDetailsForm").validate({errorPlacement: function (error, element) {
        error.insertAfter(element.parent('.form-group'));}
      });
</script>