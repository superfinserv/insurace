$(window).on('load', function(){
   
    var carInfo = [];
    if(localStorage.getItem("carInfo")){ 
       carInfo = JSON.parse(localStorage.getItem('carInfo'));
       addedItem = Object.keys(carInfo).length;
       if(addedItem){
           carInfo = JSON.parse(localStorage.getItem('carInfo'));
            if(carInfo.vehicle.isBrandNew=='false'){
              if(carInfo.vehicle.regYear!==undefined && carInfo.vehicle.regYear!==""){
                  $('#regYear').val(carInfo.vehicle.regYear).trigger("change");
              }else{
                   var d = new Date();
                   var y = d.getFullYear();y=y.toString();
                  $('#regYear').val(y).trigger("change");
              }
              $("input[name=policyHolderType][value=" + carInfo.vehicle.policyHolderType + "]").attr('checked', 'checked');
            }else{
                $('.reg-dmy-elem').hide();
                $('#headText').text("Tell us about your Car Property")
            }
       }
    }
});

 function getStateCity(){
     var pincode =  $('#pincode').val();
     var _getStateCity = function () {
            var tmp = null;
            $.ajax({
                'async': false,
                'type': "GET", 
                'global': false,
                'dataType': 'json',
                'url':base_url+"/get-city-sate-by-pincode/"+pincode,   
                'success': function (result) { 
                    tmp = (result.data);
                    console.log(tmp);
                }
            });
            return tmp;
        }(); // 
      return _getStateCity;
   }
$(document).ready(function() {
   $("#regYearForm").validate({
    rules: {
        'pincode': {
             required: {
                        depends: function () { return $('#pincode').length>0; }
                    },
            number:true,
            minlength:6,
            maxlength:6
           
        },
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
        'pincode':{ required: "Please enter pincode.",},
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
        
        var carInfo = JSON.parse(localStorage.getItem('carInfo'));
        var d = new Date();
           //  d.setDate( d.getDate() - 11 );
        var n = ("0" + (d.getDate())).slice(-2);
        
        if(carInfo.vehicle.isBrandNew=='false'){
            var regYear = $('#regYear').val();
            var regMonth = $('#regMonth').val();
        }else{
            // var regYear = d.getFullYear();
            // var regMonth =d.getMonth()+1;
            
             var regYear = d.getFullYear();regYear=regYear.toString();
             var regMonth = ("0" + (d.getMonth() + 1)).slice(-2);
            
        }
            
         carInfo.vehicle.regDate = n;
         carInfo.vehicle.regYear = regYear;
         carInfo.vehicle.regMonth = regMonth;
         carInfo.vehicle.regDMY = n+'-'+regMonth+'-'+regYear;
         carInfo.vehicle.policyHolder = $("input[name='policyHolderType']:checked").val();
         carInfo.vehicle.regPincode  = $('#pincode').val();
         var _adr = getStateCity();
         //console.log(_adr);
            var address = {}
            address.addressLine= "";
            address.pincode = $('#pincode').val();
            address.city = _adr.city;
            address.state = _adr.state;
            carInfo.address   = address;   
           
       if(carInfo.vehicle.isBrandNew==="true" && carInfo.vehicle.hasvehicleNumber=="false"){
            localStorage.setItem("carInfo", JSON.stringify(carInfo));
            window.location.href = base_url + "/car-insurance/ncb-transfer";
         }else{
           localStorage.setItem("carInfo", JSON.stringify(carInfo));
           window.location.href = base_url + "/car-insurance/expiry-detail";
         }
     }
   });
});


  

$('body').on('change','#regYear',function(e){
    e.preventDefault();
     var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    var val = parseInt($(this).val());
    $.get(base_url+"/get-months/"+val, function(months) {
                 $("#regMonth").empty();
                     var newState_ = new Option("Select Month", "", false, false);
                      $("#regMonth").append(newState_);//.trigger('change');
                   jQuery.each(months, function (index, item) {
                    var newState = new Option(item['value'], item['key'], false, false);
                      $("#regMonth").append(newState);//.trigger('change');
                   });
       
        if(carInfo.vehicle.regMonth!==undefined && carInfo.vehicle.regMonth!=="") {
           $('#regMonth').val(carInfo.vehicle.regMonth).trigger("change");
        }else{
            var d = new Date();
            var M = ("0" + (d.getMonth() + 1)).slice(-2);
            $('#regMonth').val(M).trigger("change");
        }
    })
    
});

$(document).on('click', '#backmodelYear', function(e) {
    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    window.location.href = base_url + "/car-insurance/variant/" + carInfo.vehicle.model.name;
})