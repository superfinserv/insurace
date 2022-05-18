$( document ).ready(function() {
    var postData = JSON.parse(localStorage.getItem('healthInfo'));
    var typ ="FL";
    if(parseInt(postData.total_adult)+parseInt(postData.total_child)==1){
        $("#plan_policy_typ_filter option[value=FL]").attr('disabled', true);
        $("#plan_policy_typ_filter option[value=FL]").prop('disabled', true);
        typ = "IN";
        $("#plan_policy_typ_filter").val("IN");
    }
    var selectedTyp = $("#plan_policy_typ_filter").val();
    typ = selectedTyp;
    getPlans("4-9",typ);
    
    $("div.list-health-plans").randomize(".col-12", ".plan-card");
});

(function($) {
  
  $.fn.randomize = function(tree, childElem) {
    return this.each(function() {
      var $this = $(this);
      if (tree) $this = $(this).find(tree);
      var unsortedElems = $this.children(childElem);
      var elems = unsortedElems.clone();
      
      elems.sort(function() { return (Math.round(Math.random())-0.5); });  

      for(var i=0; i < elems.length; i++)
        unsortedElems.eq(i).replaceWith(elems[i]);
    });    
  };

})(jQuery);

var XHRreligare = null;
var XHRcigna = null;
var XHRfgi = null;
var XHRdigit = null;
var XHRhdfcErgo = null;
var XHRreligareCA = null;


function getPlans(range,pt){
     if(XHRreligare!==null){ XHRreligare.abort();}
     if(XHRcigna!==null){ XHRcigna.abort();}
     if(XHRfgi!==null){ XHRfgi.abort();}
     if(XHRdigit!==null){ XHRdigit.abort();}
     if(XHRhdfcErgo!==null){ XHRhdfcErgo.abort();}
     var postData = JSON.parse(localStorage.getItem('healthInfo'));
     var customer = JSON.parse(localStorage.getItem('customersDetails'));
     var deviceToken = localStorage.getItem('deviceToken');
     loadHeading(postData);
     getDigitsPlansSilver(range,pt,postData,customer,deviceToken);
     getDigitsPlansGold(range,pt,postData,customer,deviceToken);
     getDigitsPlansDiamond(range,pt,postData,customer,deviceToken);
     getCareHealthPlans(range,pt,postData,customer,deviceToken);
     getFgiPlans(range,pt,postData,customer,deviceToken);
     getManipalCignaPlans(range,pt,postData,customer,deviceToken);
     getHdfcErgoSPlans(range,pt,postData,customer,deviceToken);
     getHdfcErgoSSPlans(range,pt,postData,customer,deviceToken);
     getHdfcErgoGSPlans(range,pt,postData,customer,deviceToken);
     getHdfcErgoPSPlans(range,pt,postData,customer,deviceToken);
   //  getReligareCareAdvPlans(pt,postData);
    
}
function loadHeading(res){
    var head="";
      $.each(res.members, function (key, data) {
         //console.log(key,data);
         
          var _typ = data.type;
                if(_typ=='self'){ 
                   head += 'You ('+data.age+' Yrs)';
                }else if(_typ=='wife' || _typ=='husband') {
                    head += ' | Spouse ('+data.age+' Yrs)';
                }else if(_typ=="daughter" || _typ=="son"){ 
                    var str = _typ.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                    head +=' | '+ _typ+' ('+data.age+' Yrs)';
                }else{  
                    var _str = _typ.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                   head +=' | '+ _typ+' ('+data.age+' Yrs)'; 
                }
      });
      //head +='';
      $('#listMembersHead').text(head);
      $('#listMembersHead').append('&nbsp;&nbsp;<a href="'+base_url+'/health-insurance/health-members-age">Edit</a>');
}

function getHdfcErgoSPlans(range,pt,postData,customer,deviceToken){
   
   XHRhdfcErgo = $.post(base_url+"/health-insurance/get-health-plans",{supp:'HDFCERGO',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Silver"},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              
             });
        }
    },'json');
}

function getHdfcErgoSSPlans(range,pt,postData,customer,deviceToken){
   
   XHRhdfcErgo = $.post(base_url+"/health-insurance/get-health-plans",{supp:'HDFCERGO',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"SilverSmart"},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              
             });
        }
    },'json');
}

function getHdfcErgoGSPlans(range,pt,postData,customer,deviceToken){
   
   XHRhdfcErgo = $.post(base_url+"/health-insurance/get-health-plans",{supp:'HDFCERGO',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"GoldSmart"},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              
             });
        }
    },'json');
}

function getHdfcErgoPSPlans(range,pt,postData,customer,deviceToken){
    
   XHRhdfcErgo = $.post(base_url+"/health-insurance/get-health-plans",{supp:'HDFCERGO',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"PlatinumSmart"},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              
             });
        }
    },'json');
}

function getCareHealthPlans(range,pt,postData,customer,deviceToken){
   
   XHRreligare = $.post(base_url+"/health-insurance/get-health-plans",{supp:'CARE',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:'ALL'},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              //console.log("i val",i);
             });
        //   for(var k=i;k<=10;k++){
        //       // console.log("K val",k);
        //       $('#element-'+k).remove();
        //   }
        }
    },'json');
}

function getFgiPlans(range,pt,postData,customer,deviceToken){
    XHRfgi =  $.post(base_url+"/health-insurance/get-health-plans",{supp:'FGI',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              //console.log("i val",i);
             });
        //   for(var k=i;k<=10;k++){
        //       // console.log("K val",k);
        //       $('#element-'+k).remove();
        //   }
        }
    },'json');
}

function getManipalCignaPlans(range,pt,postData,customer,deviceToken){
    XHRcigna =  $.post(base_url+"/health-insurance/get-health-plans",{supp:'MANIPAL_CIGNA',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              //console.log("i val",i);
             });
        //   for(var k=i;k<=10;k++){
        //       // console.log("K val",k);
        //       $('#element-'+k).remove();
        //   }
        }
    },'json');
}

function getDigitsPlansSilver(range,pt,postData,customer,deviceToken){
     XHRdigit = $.post(base_url+"/health-insurance/get-health-plans",{supp:'DIGIT',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Silver"},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              //console.log("i val",i);
             });
        //   for(var k=i;k<=10;k++){
        //       // console.log("K val",k);
        //       $('#element-'+k).remove();
        //   }
        }
    },'json');
}

function getDigitsPlansGold(range,pt,postData,customer,deviceToken){
     XHRdigit = $.post(base_url+"/health-insurance/get-health-plans",{supp:'DIGIT',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Gold"},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              //console.log("i val",i);
             });
        //   for(var k=i;k<=10;k++){
        //       // console.log("K val",k);
        //       $('#element-'+k).remove();
        //   }
        }
    },'json');
}

function getDigitsPlansDiamond(range,pt,postData,customer,deviceToken){
     XHRdigit = $.post(base_url+"/health-insurance/get-health-plans",{supp:'DIGIT',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Diamond"},function(result){
        //console.log(result);
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addElements(key,data)
              }, 1000 * i);
              i++; 
              //console.log("i val",i);
             });
        //   for(var k=i;k<=10;k++){
        //       // console.log("K val",k);
        //       $('#element-'+k).remove();
        //   }
        }
    },'json');
}

function getReligareCareAdvPlans(pt,postData){
   
   XHRreligareCA = $.post(base_url+"/health-insurance/get-health-plans",{supp:'CARE',range:'25-100',pln:"CARE_ADVANTAGE",policytyp:pt,params:postData},function(result){
        if($.trim(result.status)=='success' && result.plans.length>0){
            var i=0;
            $.each(result.plans, function(key,data){
                setTimeout(function(){
                    addAddtionalElements(key,data)
              }, 1000 * i);
              i++; 
             });
        }
    },'json');
}


//  +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Copay:0% <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
// +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Room rent : Single Private AC Room <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
// +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Waiting period : 4 year <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
// +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Renewal Bonus : 10.0% <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
// +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Health Checkup : Available <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'

function addElements(key,data){
    var title = (data.title === undefined || data.title === null)?data.supp_name:data.title;
     var deductable = "";
    if(data.hasOwnProperty('deductable')){
      deductable = '<div class="com-name"  data-toggle="tooltip" title="Deductable:'+data.deductable+' Lakh">Deductable:'+data.deductable+' Lakh</div>';
    }
    var _feature ="";
      if(data.features === undefined || data.features === null){ 
          _feature = "";
      }else{
        $.each(data.features, function(i, item) {
           // console.log(item._key);
            _feature += '<li><i  class="hand-icon fa fa-hand-o-right"></i> '+item._key+':'+item._val+' <span data-toggle="tooltip" data-toggle="tooltip" title="'+item._desc+'" class="right-tooltip" ><i class="fa fa-question-circle"></i></span></li>';
           
        })
      }
     //console.log(_feature);
    let sumInsured = parseFloat(data.sumInsured);
    if(sumInsured>99){
        sumInsured = "1 Cr";
    }else{
        sumInsured = (sumInsured==1)?data.sumInsured+" Lakh":data.sumInsured+" Lakhs";
        
    }
    var _html='<div class="col-12 col-md-6 col-lg-4 col-sm-12 elem-plan elem-'+data.id+'-'+data.supplier+'" data-sumInsured="'+data.sumInsured+'">'
                             +'<div class="card plan-card">'
						      	+'<div class="card-header plan-card-header" >'
						      	    +'<div class="supp-company">'
						      	        +'<img class="com-logo" src="'+data.supp_logo+'"/>'
						      	        +'<div class="com-name" data-toggle="tooltip" data-toggle="tooltip" title="'+title+'">'+title+'</div>'
						      	         +deductable
						      	    +'</div>'
						      	    +'<ul class="plan-header-right">'
						      	        +'<li class="info-box">'
						      	            +'<h4>Sum Insured</h4>'
						      	            +'<span data-val="'+data.sumInsured+'" class="plan-premium-amount'+data.id+'-'+data.supplier+'">₹ '+sumInsured+'</span>'
						      	        +'</li>'
						      	        +'<li class="info-box">'
						      	             +'<h4>Premium/Yr</h4>'
						      	            +'<span  data-val="'+data.amount+'" class="plan-amount'+data.id+'-'+data.supplier+'">₹ '+data.amount+'</span>'
						      	        +'</li>'
						      	    +'</ul>'
						      	+'</div>'
								+'<div class="card-body plan-desc-body">'
								    +'<div class="feature-title">Main Features</div>'
								    +'<ul class="plan-feature-list">'
                                      +_feature
								    +'</ul>'
								+'</div>'
							
								+'<div class="card-footer plan-card-footer">'
								    +'<ul>'
								        +'<li class="cols-1">'
								            +'<a href="#" class="btn-SeeDetails" data-supp="'+data.supplier+'" data-group="'+data.id+'-'+data.supplier+'" >See Details</a>'
								        +'</li>'
								        +'<li class="cols-2">'
								            +'<a href="#" class="btn-buynow create-enquiry" data-supp="'+data.supplier+'" data-group="'+data.id+'-'+data.supplier+'">Buy Now</a>'
								        +'</li>'
								    +'</ul>'
								+'</div>'
							+'</div>'
                         +'</div>';
                 $('.ph-elements').remove();
     //$('.list-health-plans').find('#element-'+key).append(_html);
     $('.list-health-plans').append(_html);
      sortElem();
      $('[data-toggle="tooltip"]').tooltip();
}

function addAddtionalElements(key,data){
    var title = (data.title === undefined || data.title === null)?data.supp_name:data.title;
   
    var _html='<div class="col-12 col-md-6 col-lg-4 col-sm-12 elem-plan elem-'+data.id+'_'+data.supplier_id+'" data-sumInsured="'+data.sumInsured+'">'
                             +'<div class="card plan-card">'
						      	+'<div class="card-header plan-card-header" >'
						      	    +'<div class="supp-company">'
						      	        +'<img class="com-logo" src="'+data.supp_logo+'"/>'
						      	        +'<div class="com-name" data-toggle="tooltip" title="'+title+'">'+title+'</div>'
						      	       
						      	    +'</div>'
						      	    +'<ul class="plan-header-right">'
						      	        +'<li class="info-box">'
						      	            +'<h4>Sum Insured</h4>'
						      	            +'<span data-val="'+data.sumInsured+'" class="plan-premium-amount'+data.id+'_'+data.supplier_id+'">₹ '+data.sumInsured+'Lakh</span>'
						      	        +'</li>'
						      	        +'<li class="info-box">'
						      	             +'<h4>Premium/Yr</h4>'
						      	            +'<span  data-val="'+data.amount+'" class="plan-amount'+data.id+'_'+data.supplier_id+'">₹ '+data.amount+'</span>'
						      	        +'</li>'
						      	    +'</ul>'
						      	+'</div>'
								+'<div class="card-body plan-desc-body">'
								    +'<div class="feature-title">Main Features</div>'
								    +'<ul class="plan-feature-list">'
								        +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Copay:0% <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
								        +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Room rent : Single Private AC Room <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
								        +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Waiting period : 4 year <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
								        +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Renewal Bonus : 10.0% <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
								        +'<li><i  class="hand-icon fa fa-hand-o-right"></i> Health Checkup : Available <span class="right-tooltip"><i class="fa fa-question-circle"></i></span></li>'
								    +'</ul>'
								+'</div>'
							
								+'<div class="card-footer plan-card-footer">'
								    +'<ul>'
								        +'<li class="cols-1">'
								            +'<a href="#" class="btn-SeeDetails" data-supp="'+data.supplier+'" data-group="'+data.id+'_'+data.supplier_id+'" >See Details</a>'
								        +'</li>'
								        +'<li class="cols-2">'
								            +'<a href="#" class="btn-buynow create-enquiry" data-supp="'+data.supplier+'" data-group="'+data.id+'_'+data.supplier_id+'">Buy Now</a>'
								        +'</li>'
								    +'</ul>'
								+'</div>'
							+'</div>'
                         +'</div>';
            
       $('.list-additional-plans').append(_html);
      $('[data-toggle="tooltip"]').tooltip();
}

$('body').on('change','.plan-filter',function(e){
    e.preventDefault();
    var range =  $('#plan_cover_filter').val();
    var pt =  $('#plan_policy_typ_filter').val();
    $('.list-health-plans').empty();
    for(var x=0;x<=10;x++){
      var html = ' <div class="col-12 col-md-4 col-lg-4 col-sm-12  ph-elements" id="element-'+x+'">'
                              +'<div class="ph-item">'
                                +'<div class="ph-col-12">'
                                  +'<div class="ph-picture"></div>'
                                  +'<div class="ph-row">'
                                    +'<div class="ph-col-4"></div>'
                                    +'<div class="ph-col-8 empty"></div>'
                                    +'<div class="ph-col-12"></div>'
                                  +'</div>'
                               +' </div>'
                                
                                +'<div>'
                                  +'<div class="ph-row">'
                                    +'<div class="ph-col-12"></div>'
                                    +'<div class="ph-col-2"></div>'
                                    +'<div class="ph-col-10 empty"></div>'
                                    +'<div class="ph-col-8 big"></div>'
                                    +'<div class="ph-col-4 big empty"></div>'
                                  +'</div>'
                                +'</div>'
                              +'</div>'
                          +'</div>';
    $('.list-health-plans').append(html);
    
     }
    getPlans(range,pt);
});


function sortElem(){
// $(".list-health-plans .elem-plan").sort(function (a, b) {
//     return parseInt(a.id) > parseInt(b.id);
// }).each(function () {
//     var elem = $(this);
//     elem.remove();
//     $(elem).appendTo(".list-health-plan");
// });

var plans = $(".list-health-plans .elem-plan");
var temp = plans.sort(function(a,b){
    //console.log(parseInt($(b).attr("data-sumInsured")) - parseInt($(a).attr("data-sumInsured")));
  return parseFloat($(a).attr("data-sumInsured")) - parseFloat($(b).attr("data-sumInsured"));
});
$(".list-health-plans").html(temp);
}


$('body').on('click','.btn-SeeDetails',function(e){
    e.preventDefault();
   var str = $(this).attr('data-group');
   if(str!=""){
       var grp = str.split('-');
       $('.elem-'+str).loading();
        var pamt = $('.plan-premium-amount'+str).attr('data-val');
        var amt = $('.plan-amount'+str).attr('data-val');
       var _insurerInfo = JSON.parse(localStorage.getItem('healthInfo'));
        _insurerInfo.plan =grp[0];_insurerInfo.supplier =grp[1];
         _insurerInfo.amount = amt;
         _insurerInfo.sumInsured = pamt;
       localStorage.setItem("healthInfo", JSON.stringify(_insurerInfo));
       var insurerInfo = JSON.parse(localStorage.getItem('healthInfo'));
       var customerData = JSON.parse(localStorage.getItem('customersDetails'));
       var deviceToken = localStorage.getItem('deviceToken');
       $.post(base_url + "/health-insurance/create-enquiry",{provider:grp[1],deviceToken:deviceToken,insurerInfo:insurerInfo,customerData:customerData}, function (resp) {
          // console.log(resp);
           var status = $.trim(resp.status);
           if(status=='success'){
               insurerInfo.enq = resp.data.enq;
               $('.elem-'+str).loading('stop');
               localStorage.setItem("healthInfo", JSON.stringify(insurerInfo));
               //window.location.href = base_url+"/health-insurance/proposal/"+resp.data.enq
               window.location.href = base_url+"/health-insurance/product-info/"+resp.data.enq
           }else{
              $('.elem-'+str).loading('stop');
              // $('.elem-'+grp[0]+'_'+grp[1]).loading('stop');
               toastr.error(resp.message);
           }
       });
   }
})


$('body').on('click','.create-enquiry',function(e){
    e.preventDefault();
   var str = $(this).attr('data-group');
   if(str!=""){
       var grp = str.split('-');
        var pamt = $('.plan-premium-amount'+str).attr('data-val');
        var amt = $('.plan-amount'+str).attr('data-val');
        $('.elem-'+str).loading();
       var _insurerInfo = JSON.parse(localStorage.getItem('healthInfo'));
       _insurerInfo.plan =grp[0];_insurerInfo.supplier =grp[1];
         _insurerInfo.amount = amt;
         _insurerInfo.sumInsured = pamt;
       localStorage.setItem("healthInfo", JSON.stringify(_insurerInfo));
       var insurerInfo = JSON.parse(localStorage.getItem('healthInfo'));
       var customerData = JSON.parse(localStorage.getItem('customersDetails'));
       var deviceToken = localStorage.getItem('deviceToken');
       $.post(base_url + "/health-insurance/create-enquiry",{provider:grp[1],deviceToken:deviceToken,insurerInfo:insurerInfo,customerData:customerData}, function (resp) {
          // console.log(resp);
           var status = $.trim(resp.status);
           if(status=='success'){
               insurerInfo.enq = resp.data.enq;
               if(resp.data.addon  !== "undefined" ){
                   insurerInfo.addOn = resp.data.addon; 
               }
               $('.elem-'+str).loading('stop');
               localStorage.setItem("healthInfo", JSON.stringify(insurerInfo));
               //window.location.href = base_url+"/health-insurance/proposal/"+resp.data.enq
              window.location.href = base_url+"/health-insurance/product-detail/"+resp.data.enq
           }else{
               $('.elem-'+str).loading('stop');
              // $('.elem-'+grp[0]+'_'+grp[1]).loading('stop');
               toastr.error(resp.message);
           }
       });
   }
})