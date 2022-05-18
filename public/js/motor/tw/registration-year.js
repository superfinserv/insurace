$(window).on('load', function(){
   
    var twInfo = [];
    if(localStorage.getItem("twInfo")){ 
       twInfo = JSON.parse(localStorage.getItem('twInfo'));
       addedItem = Object.keys(twInfo).length;
       if(addedItem){
           twInfo = JSON.parse(localStorage.getItem('twInfo'));
            if(twInfo.vehicle.isBrandNew=='false'){
              if(twInfo.vehicle.regYear!==undefined && twInfo.vehicle.regYear!==""){
                  $('#regYear').val(twInfo.vehicle.regYear).trigger("change");
              }else{
                   var d = new Date();
                   var y = d.getFullYear();y=y.toString();
                  $('#regYear').val(y).trigger("change");
              }
              $("input[name=policyHolderType][value=" + twInfo.vehicle.policyHolderType + "]").attr('checked', 'checked');
            }else{
                $('.reg-dmy-elem').hide();
                $('#headText').text("Tell us about your 2w Property")
            }
       }
    }
});
$(document).ready(function() {
     var monthMaxDay = [31,28,31,30,31,30,31,31,30,31,30,31];
   $("#regYearForm").validate({
    rules: {
        'regYear': {
             required: {
                        depends: function () { return $('#regYear').length>0; }
                    },
        },
        'regMonth': { 
            required: {
                        depends: function () { return $('#regMonth').length>0; }
                    },
        },
    },
    messages: {
       // 'policyHolderType':{ required: "This field is required!",},
        'regYear':{ required: "Please choose year.",},
        'regMonth':{ required: "Please choose month.",},
    },
    errorPlacement: function(error, element) {
        console.log(element);
        // if (element.attr("id") == "regYear") {
           error.appendTo('#'+element.attr("id")+'-errors');
        //     return;
        // }
    },
    submitHandler: function(form) {
        
        var twInfo = JSON.parse(localStorage.getItem('twInfo'));
        var d = new Date();
        var n = "30";//("0" + (d.getDate())).slice(-2);
        
        if(twInfo.vehicle.isBrandNew=='false'){
            var regYear = $('#regYear').val();
            var regMonth = $('#regMonth').val();
            
            let tD =  parseInt(monthMaxDay[parseInt(regMonth-1)]);
            if(parseInt(n)>tD){
                n =  tD.toString();
            }
            
           // console.log(monthMaxDay[parseInt(regMonth-1)]);
        }else{
            // var regYear = d.getFullYear();
            // var regMonth =d.getMonth()+1;
            
             var regYear = d.getFullYear();regYear=regYear.toString();
             var mn = d.getMonth();
             var regMonth = ("0" + (d.getMonth() + 1)).slice(-2);
             let tD =  parseInt(monthMaxDay[parseInt(mn)]);
             if(parseInt(n)>tD){
                n = tD.toString();
            }
        }
            
         twInfo.vehicle.regDate = n;
         twInfo.vehicle.regYear = regYear;
         twInfo.vehicle.regMonth = regMonth;
         twInfo.vehicle.regDMY = n+'-'+regMonth+'-'+regYear;
         twInfo.vehicle.policyHolder = $("input[name='policyHolderType']:checked").val();
       if(twInfo.vehicle.isBrandNew==="true" && twInfo.vehicle.hasvehicleNumber=="false"){
            localStorage.setItem("twInfo", JSON.stringify(twInfo));
            window.location.href = base_url + "/twowheeler-insurance/ncb-transfer";
         }else{
           localStorage.setItem("twInfo", JSON.stringify(twInfo));
           window.location.href = base_url + "/twowheeler-insurance/expiry-detail";
         }
     }
   });
});


$('body').on('change','#regYear',function(e){
    e.preventDefault();
     var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    var val = parseInt($(this).val());
    $.get(base_url+"/get-months/"+val, function(months) {
                 $("#regMonth").empty();
                     var newState_ = new Option("Select Month", "", false, false);
                      $("#regMonth").append(newState_);//.trigger('change');
                   jQuery.each(months, function (index, item) {
                    var newState = new Option(item['value'], item['key'], false, false);
                      $("#regMonth").append(newState);//.trigger('change');
                   });
       
        if(twInfo.vehicle.regMonth!==undefined && twInfo.vehicle.regMonth!=="") {
           $('#regMonth').val(twInfo.vehicle.regMonth).trigger("change");
        }else{
            var d = new Date();
            var M = ("0" + (d.getMonth() + 1)).slice(-2);
            $('#regMonth').val(M).trigger("change");
        }
    })
    
});

$(document).on('click', '#backmodelYear', function(e) {
    var twInfo = JSON.parse(localStorage.getItem('twInfo'));
    window.location.href = base_url + "/twowheeler-insurance/variant/" + twInfo.vehicle.model.name;
})