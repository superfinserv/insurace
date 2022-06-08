var twInfo = [];
$(window).on('load', function(){
    enQId  = $('#enQId').val();
    var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
    getInspectionInfo(enQId);
});

function getInspectionInfo(enQId){
    $.get(base_url+'/car-insurance/get-inspection-info/'+enQId,function(result){
        $('#step1').html(result.data);
         if($.trim(result.BreakInStatus)=='Approved'){
             $("#step1").removeClass('active-step');
             $("#step2").addClass('active-step');
             $("#progress-step-1").removeClass('active').addClass('completed');
             $("#progress-step-2").addClass('active');
             if($.trim(result.provider)=='HDFCERGO'){
                reCalculatePremium(enQId);
             }else{
                window.location.href=base_url+"/car-insurance/plan-summary/"+enQId;
             }
         }
    },'json');
}

function reCalculatePremium(enQId){
    $.get(base_url+'/car-insurance/get-post-inspection-calculate-premimum/'+enQId,function(result){
        $('#step2').html(result.data);
         if($.trim(result.status)=='success'){ 
                $("#step1").removeClass('active-step');
                $("#step2").removeClass('active-step');
                $("#step3").addClass('active-step');
                $("#progress-step-1").removeClass('active').addClass('completed');
                $("#progress-step-2").removeClass('active').addClass('completed');
                $("#progress-step-3").addClass('active');
               reCreateProposal(enQId);
         }
    },'json');
}

function reCreateProposal(enQId){
    $.get(base_url+'/car-insurance/get-post-inspection-create-proposal/'+enQId,function(result){
        $('#step3').html(result.data);
          if($.trim(result.status)=='success'){ 
              window.location.href=base_url+"/car-insurance/plan-summary/"+enQId;
         }
    },'json');
}