$(window).on('load', function(){
   
    var twInfo = [];
    if(localStorage.getItem("twInfo")){ 
       twInfo = JSON.parse(localStorage.getItem('twInfo'));
       addedItem = Object.keys(twInfo).length;
       if(addedItem){
           twInfo = JSON.parse(localStorage.getItem('twInfo'));
            
       }
    }
});

$('body').on('click','.hasNcbTransfer',function(e){
    var radioValue = $("input[name='hasNcbTransfer']:checked").val();
   // if(radioValue){ if(radioValue=='Yes'){ hasMedical = 'YES'; } } 
    console.log(radioValue);
    if(radioValue=="Yes"){
        $('.ncbTransferElem').removeClass('display-none');
    }else{
        $('.ncbTransferElem').addClass('display-none');
    }
    
});

$(document).ready(function() {
   $('.dob-mask').mask('00-00-0000');
   $("#ncbCertEfDate").datepicker({
        changeMonth: true, changeYear: true,
        dateFormat: 'dd-mm-yy', autoclose: true,
     });
   $("#ncbTransferForm").validate({
    rules: {
        'ncbCertEfDate': {
             required: {
                        depends: function () { return $("input[name='hasNcbTransfer']:checked").val()=='Yes'; }
                    },
        },
        'ncbPercent': { 
            required: {
                        depends: function () { return $("input[name='hasNcbTransfer']:checked").val()=='Yes'; }
                    },
        },
        'ncbCertIssuer': {
             required: {
                        depends: function () { return $("input[name='hasNcbTransfer']:checked").val()=='Yes'; }
                    },
        },
        'policyNumber': { 
            required: {
                        depends: function () { return $("input[name='hasNcbTransfer']:checked").val()=='Yes'; }
                    },
        },
    },
    messages: {
       // 'policyHolderType':{ required: "This field is required!",},
        'ncbCertEfDate':{ required: "Please Enter NCB Certificate effective date",},
        'ncbPercent':{ required: "Please select Eligible NCB",},
        'ncbCertIssuer':{ required: "Please Select NCB Certificate Issuer name From List",},
        'policyNumber':{ required: "Please Enter Previous Policy Number",},
    },
    errorPlacement: function(error, element) {
        if(element.hasClass('invest-month') && element.next('.select2-container').length) {
          error.insertAfter(element.next('.select2-container'));
        }else{
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        var isNcbTransfer = $("input[name='hasNcbTransfer']:checked").val();
        var ncbCertDate ="";
        var ncb ="ZERO";
        var insurer ="";
        var policyNo ="";
        if($("input[name='hasNcbTransfer']:checked").val()=='Yes'){
            ncbCertDate = $('#ncbCertDate').val();
            ncb = $('#ncbPercent').val();
            insurer = $('#ncbCertIssuer').val();
            policyNo = $('#policyNumber').val();
        }
        
        var twInfo = JSON.parse(localStorage.getItem('twInfo'));
            twInfo.previousInsurance = { 
                       isExp:"",
                       expDate:"",
                       isNcbTransfer :isNcbTransfer,
                       policyCertDate:ncbCertDate,
                       insurer:insurer,
                       policyType:"",
                       hasPreClaim:"no",
                       ncb : ncb,
                       policyNo:policyNo
               }
        localStorage.setItem("twInfo", JSON.stringify(twInfo));
         window.location.href = base_url + "/twowheeler-insurance/plans";
     }
   });
});



$(document).on('click', '#backtoRegYear', function(e) {
    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    window.location.href = base_url + "/twowheeler-insurance/registration-year";
})