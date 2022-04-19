var  enQId;
$(window).on('load', function(){
    enQId  = $('#enQId').val();
    $.get(base_url+'/get-enquiry-details/'+enQId,function(result){
        //var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
        localStorage.setItem("healthInfo", JSON.stringify(result.data));
        
    },'json');
    // var pageURL = $(location).attr("href");
    //   //alert(pageURL);
    //   var parts = pageURL.split("/");
    //   var enqid = parts[parts.length-1];
    //   enqid  = enqid.replace('#', '');
    //   console.log(enqid,parts);
       //var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
    //     console.log(healthInfo);
    //   healthInfo.enq = enQId;//enqid;
    //   healthInfo.AddOns ="";
    //   localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
});


// $("body").on("click","#testJson",function() {
//         $.get(base_url + "/test-json/", function (resp) {
              
//         },'json');
//     });

$('.dmy-mask').mask('00/00/0000');
$(".dmy-mask").datepicker({changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', autoclose: true});
function _setProgressBar(step){
  for(var i=1;i<=5;i++){
      if(i<=step){
          $('#progress-step-'+i).addClass('active');
      }else{
          $('#progress-step-'+i).removeClass('active');
      }
  }
}
//$('input[name="hasAnyMedical"]').click(function(){
$('body').on('click','.hasAnyMedical',function(e){
     var radioValue = $("input[name='hasAnyMedical']:checked").val();
       if(radioValue){
          // console.log("Your are a - " + radioValue);
           if(radioValue=='Yes'){
               $('.questionList').css('display','block');
           }else{
               $('.questionList').css('display','none');
               $('.error-medical').text("");
           }
        }else{
            $('.questionList').css('display','none');
            $('.error-medical').text("");
        }
})


$('body').on('change','.medi_since_mm',function(e){
    e.preventDefault();
    var val = $(this).val();
    var _thiselmId =  $(this).attr('id');
    var elemArr = _thiselmId.split('_');
    var yearBoxId = elemArr[0]+"_"+elemArr['1']+"_yy_"+elemArr[3]+"_"+elemArr[4];
    
    var today = new Date();
    var month = parseInt(today.getMonth())+1;
    var year = today.getFullYear();
    
    if(val>=month){
        $("#"+yearBoxId+" option[value="+year+"]").attr('disabled', true);
        $("#"+yearBoxId+" option[value="+year+"]").prop('disabled', true);
    }else{
        $('#'+yearBoxId+' option').prop('disabled',false)
        $('#'+yearBoxId+' option').attr('disabled',false)
    }
    
})

$('body').on('change','.medi_since_yy',function(e){
    e.preventDefault();
    var val = parseInt($(this).val());
    var _thiselmId =  $(this).attr('id');
    var elemArr = _thiselmId.split('_');
    var monthBoxId = elemArr[0]+"_"+elemArr['1']+"_mm_"+elemArr[3]+"_"+elemArr[4];
    
    var today = new Date();
    var month = parseInt(today.getMonth())+1;
    var year = parseInt(today.getFullYear());
    console.log(val,year)
    if(val>=year){
        
        var i;
        for (i = month; i < 13; i++) {
            i = (i<10)?"0"+i:i;
          $("#"+monthBoxId+" option[value="+i+"]").attr('disabled', true);
          $("#"+monthBoxId+" option[value="+i+"]").prop('disabled', true);
        }
        
    }else{
        $('#'+monthBoxId+' option').prop('disabled',false)
        $('#'+monthBoxId+' option').attr('disabled',false)
    }
    
});



// $('body').on('change','dd',function(e){ 
//   e.preventDefault();
//     var val = parseInt($(this).val()); 
//     var _thiselmId =  $(this).attr('data-name');
//     var elemArr = _thiselmId.split('-');
//     var mmBox = elemArr[0]..""
//     var M30 = [01,03,05,07,09,11];
//     var M31 = [04,06,08,10,12];
//     if(val>30){
//         var m;
//         $.each(M30, function( index, value ) {
//           //  value = (value<10)?"0"+value:value;
//           $("#"+mmBoxId+" option[value="+value+"]").attr('disabled', true);
//           $("#"+mmBoxId+" option[value="+value+"]").prop('disabled', true);
//         });
//     }else if(val==31){
        
//     }
// });


function _loadNextStep(step,enq){
    var url = "";
    if(step=='proposerInfo'){       url = base_url+"/health-insurance/table-proposer/"+enq; _setProgressBar(1);
    }else if(step=='insurerInfo'){  url = base_url+"/health-insurance/table-insurer/"+enq;  _setProgressBar(2);
    }else if(step=='addressInfo'){  url = base_url+"/health-insurance/table-address/"+enq;  _setProgressBar(3);
    }else if(step=='medicalInfo'){  url = base_url+"/health-insurance/table-medical/"+enq;  _setProgressBar(4);
    }else if(step=='reviewInfo'){   url = base_url+"/health-insurance/table-review/"+enq;   _setProgressBar(5);
    } 
    
    
    if(url!==""){
       
        $.get(url,function(result){
             $('.proposalInfoBox').empty();
             $('.proposalInfoBox').html(result);
            if(step=='insurerInfo'){
               $(".btn-next-proposal").loadButton('off'); 
               $('.proposalFooter').append('<button type="button" class="btn btn-ss btn-pre btn-pre-insurer"><i class="left fa fa-chevron-left "></i> Previous </button>');
               $('.proposalFooter').find('.btn-next').removeClass('btn-next-proposal');
               $('.proposalFooter').find('.btn-next').addClass('btn-next-insurer');
               
            }else if(step=='addressInfo'){
               $(".btn-next-insurer").loadButton('off');
               $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-insurer');
               $('.proposalFooter').find('.btn-pre').addClass('btn-pre-address');
                $('.proposalFooter').find('.btn-next').removeClass('btn-next-insurer');
               $('.proposalFooter').find('.btn-next').addClass('btn-next-address');
            }else if(step=='medicalInfo'){
               $(".btn-next-address").loadButton('off');
               $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-address');
               $('.proposalFooter').find('.btn-pre').addClass('btn-pre-medical');
               $('.proposalFooter').find('.btn-next').removeClass('btn-next-address');
               $('.proposalFooter').find('.btn-next').addClass('btn-next-medical');
               $('.dmy-mask').mask('00/00/0000');
                $(".dmy-mask").datepicker({changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', autoclose: true,maxDate:0});
            }else if(step=='reviewInfo'){
               $(".btn-next-medical").loadButton('off');
               $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-medical');
               $('.proposalFooter').find('.btn-pre').addClass('btn-pre-review');
               $('.proposalFooter').find('.btn-next').removeClass('btn-next-medical');
               $('.proposalFooter').find('.btn-next').addClass('btn-next-review');
            }
             $('html, body').animate({ scrollTop: 0 }, 1200);
        
        });
    }
}

function _loadPreStep(step,enq){
    var url = "";
    if(step=='proposerInfo'){  url = base_url+"/health-insurance/table-proposer/"+enq; _setProgressBar(1);
    }else if(step=='insurerInfo'){  url = base_url+"/health-insurance/table-insurer/"+enq; _setProgressBar(2);
    }else if(step=='addressInfo'){  url = base_url+"/health-insurance/table-address/"+enq; _setProgressBar(3);
    }else if(step=='medicalInfo'){  url = base_url+"/health-insurance/table-medical/"+enq; _setProgressBar(4);
    }else if(step=='reviewInfo'){  url = base_url+"/health-insurance/table-review/"+enq;   _setProgressBar(5);
    }
    
    if(url!=""){
       $.get(url,function(result){
             $('.proposalInfoBox').empty();
             $('.proposalInfoBox').html(result);
            if(step=='proposerInfo'){
               $(".btn-pre-insurer").loadButton('off');
               $('.proposalFooter').find('.btn-pre').remove();
               $('.proposalFooter').find('.btn-next').removeClass('btn-next-insurer');
               $('.proposalFooter').find('.btn-next').addClass('btn-next-proposal');
            }else  if(step=='insurerInfo'){
               $(".btn-pre-address").loadButton('off');
               $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-address');
               $('.proposalFooter').find('.btn-pre').addClass('btn-pre-insurer');
               $('.proposalFooter').find('.btn-next').removeClass('btn-next-address');
               $('.proposalFooter').find('.btn-next').addClass('btn-next-insurer');
            }else  if(step=='addressInfo'){
               $(".btn-pre-medical").loadButton('off');
               $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-medical');
               $('.proposalFooter').find('.btn-pre').addClass('btn-pre-address');
               $('.proposalFooter').find('.btn-next').removeClass('btn-next-medical');
               $('.proposalFooter').find('.btn-next').addClass('btn-next-address');
            }else  if(step=='medicalInfo'){
               $(".btn-pre-review").loadButton('off');
               $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-review');
               $('.proposalFooter').find('.btn-pre').addClass('btn-pre-medical');
               $('.proposalFooter').find('.btn-next').removeClass('btn-next-review');
               $('.proposalFooter').find('.btn-next').addClass('btn-next-medical');
                   $('.dmy-mask').mask('00/00/0000');
                   $(".dmy-mask").datepicker({changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', autoclose: true,});
            }
            
        });
    }
}

$('body').on('click','.btn-edit-link',function(e){ 
         e.preventDefault();
        var step = $.trim($(this).attr('data-step'));
        var url = "";
        //var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
        var enq = enQId;//$('#enQId').val();//healthInfo.enq;
        
        if(step=='proposerInfo'){       url = base_url+"/health-insurance/table-proposer/"+enq; _setProgressBar(1);
        }else if(step=='insurerInfo'){  url = base_url+"/health-insurance/table-insurer/"+enq;  _setProgressBar(2);
        }else if(step=='addressInfo'){  url = base_url+"/health-insurance/table-address/"+enq;  _setProgressBar(3);
        }else if(step=='medicalInfo'){  url = base_url+"/health-insurance/table-medical/"+enq;  _setProgressBar(4);
        }else if(step=='reviewInfo'){   url = base_url+"/health-insurance/table-review/"+enq;   _setProgressBar(5);
        }
    
    if(url!=""){
        //console.log(step); 
       $.get(url,function(result){
             $('.proposalInfoBox').empty();
             $('.proposalInfoBox').html(result);
            if(step=='proposerInfo'){
                   $('.proposalFooter').find('.btn-pre').remove();
                   $('.proposalFooter').find('.btn-next').addClass('btn-next-proposal');
            }else  if(step=='insurerInfo'){
                   $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-review');
                   $('.proposalFooter').find('.btn-pre').addClass('btn-pre-insurer');
                   $('.proposalFooter').find('.btn-next').removeClass('btn-next-review');
                   $('.proposalFooter').find('.btn-next').addClass('btn-next-insurer');
            }else  if(step=='addressInfo'){
                   $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-review');
                   $('.proposalFooter').find('.btn-pre').addClass('btn-pre-address');
                   $('.proposalFooter').find('.btn-next').removeClass('btn-next-review');
                   $('.proposalFooter').find('.btn-next').addClass('btn-next-address');
            }else  if(step=='medicalInfo'){
                   $('.proposalFooter').find('.btn-pre').removeClass('btn-pre-review');
                   $('.proposalFooter').find('.btn-pre').addClass('btn-pre-medical');
                   $('.proposalFooter').find('.btn-next').removeClass('btn-next-review');
                   $('.proposalFooter').find('.btn-next').addClass('btn-next-medical');
                   $('.dmy-mask').mask('00/00/0000');
                   $(".dmy-mask").datepicker({changeMonth: true, changeYear: true,dateFormat: 'dd/mm/yy', autoclose: true,});
             }
       });
    }
});

$('body').on('click','.btn-pre-insurer',function(e){
    // var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
    // var enqId =healthInfo.enq;
     $('.btn-pre-insurer').loadButton('on',{
                faClass:'fa',
                faIcon:'fa-spinner',
                doSpin:true,
                loadingText:'Loading...',
              });
    _loadPreStep("proposerInfo",enQId);
});

$('body').on('click','.btn-pre-address',function(e){
    // var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
    // var enqId =healthInfo.enq;
     $('.btn-pre-address').loadButton('on',{
                faClass:'fa',
                faIcon:'fa-spinner',
                doSpin:true,
                loadingText:'Loading...',
              });
    _loadPreStep("insurerInfo",enQId);
});

$('body').on('click','.btn-pre-medical',function(e){
    // var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
    // var enqId =healthInfo.enq;
     $('.btn-pre-medical').loadButton('on',{
                faClass:'fa',
                faIcon:'fa-spinner',
                doSpin:true,
                loadingText:'Loading...',
              });
    _loadPreStep("addressInfo",enQId);
});

$('body').on('click','.btn-pre-review',function(e){
    // var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
    // var enqId =healthInfo.enq;
     $('.btn-pre-review').loadButton('on',{
                faClass:'fa',
                faIcon:'fa-spinner',
                doSpin:true,
                loadingText:'Loading...',
              });
    _loadPreStep("medicalInfo",enQId);
});

function checkValidate(formData,localData){
        var mArr =  localData.members;
        if( mArr.some(item => item.type === 'wife')){
            if(formData.self_mstatus=="Single"){
               return "One of insurer has spouse, can't choose single"; 
            }else{
                return "";
            }
        }else{
            return "";
        }
    }

$('body').on('click','.btn-next-proposal',function(e){
       e.preventDefault();
      var healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
      $('.dob-error').remove(); $('.height-error').remove();
        var cls =  $(this).attr('data-ref');
        var form = $("#proposerInfo-Form");
        form.validate({
            errorElement: 'span',
            errorClass: 'span-error error',
            rules: {
                self_fname: { required: true,},
                self_lname: { required: true,},
                self_email: { required: true,},
                self_mobile: { required: true,number:true,minlength:10,maxlength:10},
                self_mstatus: { required: true,},
                self_gender: { required: true,},
                self_dd: { required: true,},
                self_mm: { required: true,},
                self_yy: { required: true,},
                self_feet: { required: true,},
                self_inch: { required: true,},
                self_weight: { required: true,max:150,min:5},
                nominee_name: { required: true,fullname:true},
                nominee_relation: { required: true,},
                nominee_dd: { required: true,},
                nominee_mm: { required: true,},
                nominee_yy: { required: true,},
            },
            errorPlacement: function(error, element) {
                
                if(element.attr('id')=='self_dd' || element.attr('id')=='self_mm' || element.attr('id')=='self_yy' || element.attr('id')=='nominee_dd' || element.attr('id')=='nominee_mm' || element.attr('id')=='nominee_yy'){
                    $('.dob-error').remove();
                    element.parent().parent().parent('.media-input-container').after("<span class='span-error dob-error'>Date of birth is required.</span>");
                }else if(element.attr('id')=='self_feet' || element.attr('id')=='self_inch'){
                    $('.height-error').remove();
                    element.parent().parent().parent('.media-input-container').after("<span class='span-error height-error'>Height is required.</span>");
                }else{
                   error.insertAfter(element.parent().parent().parent());
                }
            },
        });
        var table1 = form.serializeObject();
        var age = calculateAge(table1.self_mm+"/"+table1.self_dd+"/"+table1.self_yy);
        if(parseInt(age)>=18){
          if (form.valid() === true) {
             $('.btn-next-proposal').loadButton('on',{
                faClass:'fa',
                faIcon:'fa-spinner',
                doSpin:true,
                loadingText:'Loading...',
              });
            var _age = calculateAge(table1.self_mm+"/"+table1.self_dd+"/"+table1.self_yy);
            var errorMsg = checkValidate(table1,healthInfo);
            if(errorMsg===""){
                healthInfo.selfAge = _age; 
                healthInfo.gender = table1.self_gender;
                healthInfo.selfFname = table1.self_fname.toUpperCase();
                healthInfo.selfLname = table1.self_lname.toUpperCase();
                healthInfo.selfName = table1.self_fname+" "+table1.self_lname;
                healthInfo.selfEmail = table1.self_email;
                healthInfo.selfMobile = table1.self_mobile;
                healthInfo.selfDob = table1.self_yy+"-"+table1.self_mm+"-"+table1.self_dd;
                healthInfo.selfdd = table1.self_dd;
                healthInfo.selfmm = table1.self_mm;
                healthInfo.selfyy = table1.self_yy; 
                healthInfo.selfHeight = table1.self_feet+"-"+table1.self_inch;
                healthInfo.selfFeet = table1.self_feet;
                healthInfo.selfInch = table1.self_inch;
                healthInfo.selfMstatus = table1.self_mstatus;
                healthInfo.selfWeight = table1.self_weight;
                healthInfo.nomineename = table1.nominee_name.toUpperCase();
                healthInfo.nomineerelation = table1.nominee_relation;
                healthInfo.nomineedd = table1.nominee_dd;
                healthInfo.nomineemm = table1.nominee_mm;
                healthInfo.nomineeyy = table1.nominee_yy; 
                healthInfo.enq  =  enQId;
               
                localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
                var postData = JSON.parse(localStorage.getItem('healthInfo'));
                var enqId =healthInfo.enq; 
                
                $.post(base_url+"/health-insurance/update-proposal",{enqId:enqId,param:postData,step:'proposer'},function(result){ 
                    if($.trim(result.status)=='success'){
                        _loadNextStep('insurerInfo',enqId);
                        
                    }
                }); 
            }else{
                toastr.error(errorMsg);
                $('.btn-next-proposal').loadButton('off');
            }
        }
        }else{
            toastr.error("Proposer Age should be greater than or equal to 18");
            //$.alert("Proposer Age should be greater than or equal to 18");
        }
       
    });
     
$('body').on('click','.btn-next-insurer',function(e){
       e.preventDefault();
       
      var healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
             $("#insurerInfo-Form").validate({errorElement: "span",errorClass: "span-error error",
                  errorPlacement: function(error, element) {
                    if(element.hasClass('insurer-dd') || element.hasClass('insurer-yy') || element.hasClass('insurer-mm')){
                        //$('.dob-error').remove();
                        //element.parent().parent().parent('.media-input-container').after("<span class='span-error dob-error'>Date of birth is required.</span>");
                    }else if(element.attr('id')=='self_feet' || element.attr('id')=='self_inch'){
                        //$('.height-error').remove();
                        //element.parent().parent().parent('.media-input-container').after("<span class='span-error height-error'>Height is required.</span>");
                    }else{
                       error.insertAfter(element.parent().parent().parent());
                    }
                }
             });
             $('.insurer-fname').each(function() {
                 $(this).rules("add", {required: true, });
            });
             $('.insurer-lname').each(function() {
                $(this).rules("add", {required: true, });
            });
             $('.insurer-dd').each(function() {
                $(this).rules("add", { required: true, });
            });
            $('.insurer-mm').each(function() {
                $(this).rules("add", { required: true, });
            });
            $('.insurer-yy').each(function() {
                $(this).rules("add", { required: true, });
            });
            $('.insurer-feet').each(function() {
                $(this).rules("add", { required: true, });
            });
            $('.insurer-inch').each(function() {
                $(this).rules("add", { required: true, });
            });
            $('.insurer-weight').each(function() {
                $(this).rules("add", { required: true,number:true,min:1, max:150});
            });
            //  $('.insurer-relation').each(function() {
            //     $(this).rules("add", { required: true, });
            // });
               $('.insurer-gender').each(function() {
                $(this).rules("add", { required: true, });
            });
            
            if ($("#insurerInfo-Form").valid() === true) {
                    
                     var hasValid = true;
                     $('.insurer-age-error').remove();
                     $.each(healthInfo.members, function (key, data) {
                         //console.log(key,data)
                         if(data.type!="self"){
                             var _age = calculateAge($('#'+key+'_mm').val()+"/"+$('#'+key+'_dd').val()+"/"+$('#'+key+'_yy').val());
                             if(_age<=90){
                                 healthInfo.members[key].age = _age;//$('#'+key+'_fname').val();
                                 healthInfo.members[key].fname = $('#'+key+'_fname').val();
                                 healthInfo.members[key].lname = $('#'+key+'_lname').val();
                                 healthInfo.members[key].dd = $('#'+key+'_dd').val();
                                 healthInfo.members[key].mm = $('#'+key+'_mm').val();
                                 healthInfo.members[key].yy = $('#'+key+'_yy').val();
                                // healthInfo.members[key].relation = $('#'+key+'_relation').val();
                                 healthInfo.members[key].gender = $('#'+key+'_gender').val();
                                 healthInfo.members[key].feet =  $('#'+key+'_feet').val();
                                 healthInfo.members[key].inch =  $('#'+key+'_inch').val();
                                 healthInfo.members[key].weight = $('#'+key+'_weight').val();
                                 healthInfo.members[key].relation = $('#'+key+'_relation').val();
                                 healthInfo.members[key].medical =[];
                             }else{
                               hasValid =   false;
                               $('#'+key+'_mm').parent().parent().parent('.media-input-container').after("<span class='span-error insurer-age-error'>Age should be upto 90 Years.</span>");
                             }
                         }else{
                              healthInfo.members[key].medical =[];
                         }
                     });
                    if(hasValid){
                         $('.btn-next-insurer').loadButton('on',{
                            faClass:'fa',
                            faIcon:'fa-spinner',
                            doSpin:true,
                            loadingText:'Loading...',
                          });
                        localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
                        var postData = JSON.parse(localStorage.getItem('healthInfo'));
                        var enqId =healthInfo.enq; 
                         //console.log(healthInfo);
                        $.post(base_url+"/health-insurance/update-proposal",{enqId:enqId,param:postData,step:'insurer'},function(result){ 
                            if($.trim(result.status)=='success'){
                                _loadNextStep('addressInfo',enqId);
                               
                            }
                        });
                    }else{
                        $.alert("All field should be validated.");
                    }
            
            }
              
     
});

$('body').on('click','.btn-next-address',function(e){
       e.preventDefault();
       
      var healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
             $("#addressInfo-Form").validate({errorElement: "span",errorClass: "span-error error",
                  errorPlacement: function(error, element) {
                        if(element.hasClass('dd') || element.hasClass('yy') || element.hasClass('mm')){
                         $('.docDMY-error').remove();
                         element.parent().parent().parent('.media-input-container').after("<span class='span-error docDMY-error'>Document issue date is required.</span>");
                        }else{
                           error.insertAfter(element.parent().parent().parent());
                        }
                   }
             });
             $('#house_no').each(function() {
                 $(this).rules("add", {required: true,maxlength:20 });
            });
             $('#street').each(function() {
                $(this).rules("add", {required: true,maxlength:40});
            });
             $('#pincode').each(function() {
                $(this).rules("add", { required: true,number:true,minlength:6,maxlength:6 });
            });
            $('#state_id').each(function() {
                $(this).rules("add", { required: true, });
            });
            $('#city_id').each(function() {
                $(this).rules("add", { required: true, });
            });
            $('#documentType').each(function() {
                $(this).rules("add", { required: true, });
            });
            $('#documentId').each(function() {
                $(this).rules("add", { required: true, });
            });
            
   
          
    if ($("#addressInfo-Form").valid() === true) {
        var docid =  $('#documentId').val();
              docid =  docid.toUpperCase();
        var isDocidValid =docIdvalid($('#documentId'),$('#documentType').val(),docid);
        if(isDocidValid){
            var isvalidDate = true;
            //var GivenDate = $('#docIssue_yy').val()+'-'+$('#docIssue_mm').val()+'-'+$('#docIssue_dd').val();
            var CurrentDate = new Date();
            var GivenDate = new Date($('#docIssue_yy').val(),$('#docIssue_mm').val(),$('#docIssue_dd').val());
            
            if(GivenDate > CurrentDate){
                isvalidDate =  false;
            }
            if(isvalidDate){
                     $('.btn-next-address').loadButton('on',{
                        faClass:'fa',
                        faIcon:'fa-spinner',
                        doSpin:true,
                        loadingText:'Loading...',
                      });
                      var address = {}
                            address.street= $('#street').val();
                            address.house_no= $('#house_no').val();
                            address.pincode = $('#pincode').val();
                            address.city = $('#city_id').val();
                            address.state = $('#state_id').val();
                           
                     var _document = {}
                        _document.documentType = $('#documentType').val();
                        _document.documentId   =  docid;
                        _document.documentdd   = $('#docIssue_dd').val(); 
                        _document.documentmm   = $('#docIssue_mm').val(); 
                        _document.documentyy   = $('#docIssue_yy').val(); 
                    healthInfo.address = address;
                    healthInfo.document = _document;
                    localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
                    var postData = JSON.parse(localStorage.getItem('healthInfo'));
                    var enqId =healthInfo.enq; 
                     //console.log(healthInfo);
                    $.post(base_url+"/health-insurance/update-proposal",{enqId:enqId,param:postData,step:'address'},function(result){ 
                        if($.trim(result.status)=='success'){
                            _loadNextStep('medicalInfo',enqId);
                            
                        }
                    }); 
             }else{
                  $(".btn-next-address").loadButton('off');
                 toastr.error("Invalid Document issue Date");
             }
        }else{
            toastr.error("Invalid PAN Number");
            
        }
     }        
     
});

// $('body').on('click','#btnUpdateZone',function(e){
//       var healthInfo = JSON.parse(localStorage.getItem('healthInfo')); 
    
//       $('.btn-next').actionOnAttr(true,'disabled');
//       $('.btn-pre').actionOnAttr(true,'disabled');
//       var enq =healthInfo.enq;
//       var zone = $('#input-zone').val();
//       $('#'+enq+'-premium-amount').html('<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>');
//       $('#page-proposal').loading({
//           theme: 'dark',
//           message: 'Loading...'
//         });
//     $.post(base_url + "/health-insurance/update-zone-quick-quote",{enq:enq,zone:zone}, function (resp) {
//             $('#page-proposal').loading('stop');
//             $('.btn-next').actionOnAttr(false,'disabled');
//             $('.btn-pre').actionOnAttr(false,'disabled');
//               if(resp.status=='success'){
//                   $('#'+enq+'-premium-amount').text(resp.data.amount);
//               }else{
//                   toastr.error(resp.message);
                   
//               }
//     },'json')
// })

$("body").on("change","#state_id",function() {
       var state = $(this).val();
       var stateID = state.split('-');
        $.get(base_url + "/get-cities/"+stateID[0], function (resp) {
              if(resp.status=='success'){
                 var citydata =resp.data;
                 $("#city_id").empty();
                  var newState_ = new Option("select", "", false, false);
                  $("#city_id").append(newState_);//.trigger('change');
                  jQuery.each(citydata, function (index, item) {
                    var newState = new Option(item['value'], item['id'], false, false);
                      $("#city_id").append(newState);//.trigger('change');
                   });
                  $('#city_id').val('').trigger("change");
                
              }
        });
    });
    
$("body").on('click','.medical_que',function(e){
       var val = $(this).val();
     if($(this).is(':checked')){ $('.question_desc_'+val).css('display','block');}
     else{ $('.question_desc_'+val).css('display','none');}
     
    //e.preventDefault();
 });
 
$("body").on('click','.ins-members',function(e){
       var val = $(this).val();
     if($(this).is(':checked')){ $('.insurer-medical-info-'+val).css('display','block');}
     else{ $('.insurer-medical-info-'+val).css('display','none');}
     
    //e.preventDefault();
 });
 
$('body').on('click','.btn-next-medical',function(e){
       e.preventDefault();
      // var medicalInfo = {};
       var hasMedical = 'NO';
       var radioValue = $("input[name='hasAnyMedical']:checked").val();
       if(radioValue){ if(radioValue=='Yes'){ hasMedical = 'YES'; } } 
      
       var error = 0;
       var healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
     
       var checkedNum = $('input:checkbox.medical_que:checked').length;
       $('.users-span-error').text(""); $('.span-error').text("");$('.error-medical').text("");
       var questionsArr = {};
      // questionsArr = (healthInfo.medical)?healthInfo.medical:questionsArr;
       
       if(hasMedical=='YES'){
           if(checkedNum){
               $(".medical_que" ).each(function( index ) {
                  if($(this).is(":checked")){
                        var queId =  $(this).val();
                        var childQ =  parseInt($(this).attr('data-child'));
                        var hasChild  =(childQ>0)?childQ:0;
                        var queTitle  =  $(this).attr('data-title');
                        var usercheckedNum = $('input:checkbox.ins-members-'+queId+':checked').length;
                           if(usercheckedNum){
                             $(".ins-members-"+queId ).each(function( index ){
                                if($(this).is(":checked")){
                                     var q_uid = $(this).val();
                                     var mkey =  $(this).attr('data-key');
                                     var username =  $(this).attr('data-username');
                                     var childArr = [];
                                     if(hasChild>0){
                                         $(".child-input-"+queId+'-'+mkey).each(function( index ){ 
                                             var _chId    =  $(this).attr('data-id');
                                             
                                             if($('#medi_'+_type+'_'+_chId+'_'+mkey).val()!=""){
                                                 var QData = $(".child-Que-"+_chId+'-'+mkey);
                                                
                                                var Qtitle   = QData.text();
                                                var _type =     $(this).attr('data-type');
                                                // var _boolean = ($(this).attr('data-bool')=='YES')?true:false;
                                                // var _since   = ($(this).attr('data-since')=='YES')?true:false;
                                                // var _text    = ($(this).attr('data-text')=='YES')?true:false;
                                                var _ans = $('#medi_'+_type+'_'+_chId+'_'+mkey).val();
                                                // if(_boolean){
                                                //      _ans = $('#medi_boolean_'+_chId+'_'+mkey).val();
                                                // }else if(_since){
                                                //      _ans = $('#medi_since_mm_'+_chId+'_'+mkey).val()+'/'+$('#medi_since_yy_'+_chId+'_'+mkey).val();
                                                // }else if(_text){
                                                //      _ans = $('#medi_text_'+_chId+'_'+mkey).val();
                                                // }
                                                childArr.push({Qid: _chId,parentId:queId,boolean:false,text:false,since:false,type:_type,title:Qtitle,answer:_ans});
                                              }
                                            });
                                       }
                                     if(healthInfo['members'][mkey]["medical"].length){
                                         var medi  =  healthInfo['members'][mkey]["medical"];
                                         var _index = medi.map(e => e.queId).indexOf(queId);
                                        
                                         if(_index<0){
                                            healthInfo['members'][mkey]["medical"].push({queId: queId,boolean:true,title:queTitle,hasChildQuestions:(hasChild>0)?true:false,childQuestions:childArr});
                                         }else{
                                            healthInfo['members'][mkey]["medical"][_index].childQuestions=childArr;
                                         }
                                     }else{
                                       healthInfo['members'][mkey]["medical"].push({queId: queId,boolean: true,title:queTitle,hasChildQuestions:(hasChild>0)?true:false,childQuestions:childArr}); 
                                     }
                                 }else{
                                     if(healthInfo['members'][$(this).attr('data-key')]["medical"].length){
                                            var medi = healthInfo['members'][$(this).attr('data-key')]["medical"];
                                            var _index = medi.map(e => e.queId).indexOf(queId);
                                            if(_index>=0){medi.splice(_index,  1);}
                                             healthInfo['members'][$(this).attr('data-key')]["medical"] = medi;
                                        }
                                 }
                             })
                          }else{
                                error++;
                                $('.error-select-user-'+queId).text("Choose a member who is suffering from "+queTitle);
                          }
                  }else{
                      var _Qval = $(this).val();
                       $(".ins-members-"+_Qval ).each(function( index ){ 
                            var mkey =  $(this).attr('data-key');
                            if( healthInfo['members'][mkey]["medical"].length){
                                
                                 var medi = healthInfo['members'][mkey]["medical"];
                                var _index = medi.map(e => e.queId).indexOf(_Qval);
                                if(_index>=0){ medi.splice(_index,  1);}
                                 healthInfo['members'][mkey]["medical"] = medi;
                                 
                            }
                       })
                  }
                }); 
               
           }else{ error = 1;  $('.error-medical').text("Choose a medical any pre-existing diseases.");}
       }else{
         error = 0; $('.error-medical').text("");
       }
       //healthInfo.medical = '',//questionsArr;
       healthInfo.hasMedical = hasMedical;
       //console.log("-healthInfo",healthInfo);
          if(error==0){
                  $('.btn-next-medical').loadButton('on',{
                    faClass:'fa',
                    faIcon:'fa-spinner',
                    doSpin:true,
                    loadingText:'Loading...',
                  });
                    console.log("healthInfo",healthInfo);
                localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
                var postData = JSON.parse(localStorage.getItem('healthInfo'));
                var enqId =healthInfo.enq; 
                $.post(base_url+"/health-insurance/update-proposal",{enqId:enqId,param:postData,step:'medical'},function(result){ 
                    if($.trim(result.status)=='success'){
                         _loadNextStep('reviewInfo',enqId);
                    }
                }); 
          }
});

$('body').on('click','.btn-next-review',function(e){
    e.preventDefault();
            $('.btn-next-review').loadButton('on',{
                faClass:'fa',
                faIcon:'fa-spinner',
                doSpin:true,
                loadingText:'Fetching Details...',
              });
       var insurerInfo = JSON.parse(localStorage.getItem('healthInfo'));
       var customerData = JSON.parse(localStorage.getItem('customersDetails'));
       var deviceToken = localStorage.getItem('deviceToken');
       $.post(base_url + "/health-insurance/create-premium",{deviceToken:deviceToken,enq:insurerInfo.enq,customerData:customerData}, function (resp) {
           //console.log(resp);
           var status = $.trim(resp.status);
           if(status=='success'){
               insurerInfo.enq = resp.data.enq;
               insurerInfo.proposalNo =resp.data.proposalNum;
               localStorage.setItem("healthInfo", JSON.stringify(insurerInfo));
               window.location.href = base_url+"/health-insurance/declaration/"+resp.data.enq
           }else{
                toastr.error(resp.message);
                $('.btn-next-review').loadButton('off');
           }
       },'json').fail(function() {
            $('.btn-next-review').loadButton('off');
             toastr.error("Internal server error");
           });
});

$("body").on('click','#backToProductDeatils',function(e){ 
    e.preventDefault();
    var enQId=$('#enQId').val();
    window.location.href = base_url+"/health-insurance/product-detail/"+enQId
})


// $('body').on('click','.addon-label',function(e){
        
//         if($(".addon-label").length>0){
//               var healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
//               var enqId =healthInfo.enq; 
//               var amt =  $('.'+enqId+'-premium-amount').text();
//              $('.btn-next').loadButton('on',{
//                 faClass:'fa',
//                 faIcon:'fa-spinner',
//                 doSpin:true,
//                 loadingText:'Calculating...',
//               });
//               $('#'+healthInfo.enq+'-premium-amount').html('<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>');
//               //$('.btnPaynow').actionOnAttr(true,'disabled');
//               var AddOns = "";
              
//               $(".addon-label" ).each(function( index ) {
//                   if($(this).prop("checked") == true){
//                     AddOns = (AddOns!="")?AddOns+","+ $(this).val(): $(this).val();
//                   }
//               });
           
//             healthInfo.AddOns = AddOns;
//             localStorage.setItem("healthInfo", JSON.stringify(healthInfo));
//             // var postData = JSON.parse(localStorage.getItem('healthInfo'));
           
            
//             $.post(base_url+"/health-insurance/update-quick-quote-with-addons",{enqId:enqId,addons:AddOns},function(result){ 
//                 console.log(result);
//                 if($.trim(result.status)=='success'){
//                     // $('#declearationInfoFormBox').empty();
//                     // getPaymentForm(enqId);
//                      $('#'+enqId+'-premium-amount').text(result.amount);
//                       $('.btn-next').loadButton('off');
//                 }else{
//                     // $('.btnPaynow').actionOnAttr(false,'disabled');
//                       $('#'+enqId+'-premium-amount').text(result.amount);
//                         $('.btn-next').loadButton('off');
//                 }
               
//             },'json'); 
//       }
// });
 
 