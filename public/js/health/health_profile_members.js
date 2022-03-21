var healthInfo = [];
$(window).on('load', function(){
    if(localStorage.getItem("healthInfo")){ 
       healthInfo = JSON.parse(localStorage.getItem('healthInfo'));
       console.log("healthInfo",healthInfo);
       addedItem = Object.keys(healthInfo).length;
       if(addedItem){
           if(healthInfo.gender=="MALE"){
               $('.self-rel').html("");
               $('.self-rel').html('<label class="control control--checkbox">Wife'
                                      +'<input type="checkbox"  name="f-members-wife" value="wife" class="f-members"/>'
                                      +'<div class="control__indicator"></div>'
                                    +'</label>');
          }else{
               $('.self-rel').html("");
               $('.self-rel').html('<label class="control control--checkbox">Husband'
                                      +'<input type="checkbox"  name="f-members-husband" value="husband" class="f-members"/>'
                                      +'<div class="control__indicator"></div>'
                                    +'</label>');
          }
          
          if(healthInfo.members){
              $.each(healthInfo.members, function (key, data) {
                  console.log(key,data);
                  if(data.type=="daughter" || data.type=="son"){
                        $('.count-'+data.type).show();
                        $('.'+data.type+'-counter-val').text(data.value);
                    }
                    var field = 'input[name="f-members-'+data.type+'"]';
                    $(field).attr('checked', true);
                    $(field).prop('checked', true);
                    
              });
          }
       }
    }
});





function getFormData(){
    var members = [];
   
    if($('input[name="f-members-self"]').is(':checked')){ members.push({type :"self",value :1,age:"",status:true}); }
    if(healthInfo.gender=="MALE"){
         if($('input[name="f-members-wife"]').is(':checked')){ members.push({type :"wife",value :1,age:"",status:true}); }
    }
    if(healthInfo.gender=="FEMALE"){ 
        if($('input[name="f-members-husband"]').is(':checked')){ members.push({type :"husband",value :1,age:"",status:true});}
    }
    if($('input[name="f-members-father"]').is(':checked')){ members.push({type :"father",value :1,age:"",status:true});}
    if($('input[name="f-members-mother"]').is(':checked')){ members.push({type :"mother",value :1,age:"",status:true});}
    if($('input[name="f-members-daughter"]').is(':checked')){
        var daughterCount = $('.daughter-counter-val').text();
        if(daughterCount>0){
             for(var i=1;i<=daughterCount;i++){  members.push({type :"daughter",value :i,age:"",status:true});}
         }
      }
    if($('input[name="f-members-son"]').is(':checked')){
       var sonCount = $('.son-counter-val').text();
       if(sonCount>0){
            for(var s=1;s<=sonCount;s++){  members.push({type :"son",value :s,age:"",status:true}); } 
       }
    }
    //console.log(members)
    healthInfo.members =  members;
    localStorage.setItem("healthInfo", JSON.stringify(healthInfo)); 
    window.location.href = base_url + "/health-insurance/health-members-age";
}

$(document).ready(function() {
   
    $("body").on('click','.btnTable2',function(e){
        $('.error-elem').hide();$('.error-message').text("");
        var len = $('.f-members:checked').length;
         if(len){
              var hasChildcheked =false;
             
              if($('input[name="f-members-daughter"]').is(':checked')){ hasChildcheked = true;}
              if($('input[name="f-members-son"]').is(':checked')){ hasChildcheked = true; }
              if(hasChildcheked){
                  var hasParentChecked =false;
                  if(healthInfo.gender=="MALE"){ if($('input[name="f-members-wife"]').is(':checked')){ hasParentChecked = true; }}
                  if(healthInfo.gender=="FEMALE"){ if($('input[name="f-members-husband"]').is(':checked')){ hasParentChecked = true; }}
                  if($('input[name="f-members-self"]').is(':checked')){ hasParentChecked = true; }
                  getFormData();
                //   if(hasParentChecked){
                //       getFormData();
                //   }else{
                //       $('.error-elem').show();
                //       $('.error-message').text("Cannot insure child without parent!");
                //   }
              }else{
                  getFormData();
              }
         }else{
             $('.error-elem').show();
             $('.error-message').text("Select atleast one member to be insurer!");
         }
    });
     $("body").on('click','input[name="f-members-son"]',function(e){
        //e.preventDefault();
            var sonCount = 0;  var daughterCount = 0;
            if($('input[name="f-members-daughter"]').is(':checked')){ daughterCount = $('.daughter-counter-val').text();}
            if($('input[name="f-members-son"]').is(':checked')){ sonCount = $('.son-counter-val').text();}
            var TOTAL = parseInt(sonCount)+parseInt(daughterCount);  
            if($(this).is(':checked')) {
                if(parseInt(TOTAL)<4){ $('.son-counter-val').text(1);}else{ $('.son-counter-val').text(0); }
              $('.count-son').css('display','block');
            }else{
               $('.son-counter-val').text(1);
               $('.count-son').css('display','none'); 
            }
     });
     
     $("body").on('click','input[name="f-members-daughter"]',function(e){
            var sonCount = 0;  var daughterCount = 0;
            if($('input[name="f-members-daughter"]').is(':checked')){ daughterCount = $('.daughter-counter-val').text();}
            if($('input[name="f-members-son"]').is(':checked')){ sonCount = $('.son-counter-val').text();}
            var TOTAL = parseInt(sonCount)+parseInt(daughterCount); 
            if($(this).is(':checked')) {
               if(parseInt(TOTAL)<4){ $('.daughter-counter-val').text(1);}else{ $('.daughter-counter-val').text(0); }
              $('.count-daughter').css('display','block');
            }else{
                 $('.daughter-counter-val').text(1);
                 $('.count-daughter').css('display','none');  
            }
     });
     
    $("body").on('click','.daughter-counter',function(e){
         var count = $('.daughter-counter-val').text();
         var sonCount = 0;
         if($('input[name="f-members-son"]').is(':checked')){ sonCount = $('.son-counter-val').text();}
         if($(this).hasClass('_minus')){
           if(count>0 && count==1){
              $('.count-daughter').css('display','none');
              $('input[name="f-members-daughter"]').attr('checked', false);
              $('input[name="f-members-daughter"]').prop('checked', false);
            }else if(count>1){
                count--;
                $('.daughter-counter-val').text(count);
            }else{
                $('.count-daughter').css('display','none');
                $('input[name="f-members-daughter"]').attr('checked', false);
                $('input[name="f-members-daughter"]').prop('checked', false);
            } 
        }else  if($(this).hasClass('_plus')){
            var TOTAL = parseInt(count)+parseInt(sonCount);
            if(parseInt(TOTAL)<4){
                    count++;
                    $('.daughter-counter-val').text(count);
            }
        }
        
    });
    
    $("body").on('click','.son-counter',function(e){
         var count = $('.son-counter-val').text();
         var daughterCount = 0;
         if($('input[name="f-members-daughter"]').is(':checked')){ daughterCount = $('.daughter-counter-val').text();}
         if($(this).hasClass('_minus')){
           if(count>0 && count==1){
              $('.count-son').css('display','none');
              $('input[name="f-members-son"]').attr('checked', false);
              $('input[name="f-members-son"]').prop('checked', false);
            }else if(count>1){
                count--;
                $('.son-counter-val').text(count);
            }else{
              $('.count-son').css('display','none');
              $('input[name="f-members-son"]').attr('checked', false);
              $('input[name="f-members-son"]').prop('checked', false);
            }  
        }else  if($(this).hasClass('_plus')){
           var TOTAL = parseInt(count)+parseInt(daughterCount);
           if(parseInt(TOTAL)<4){
                count++;
                $('.son-counter-val').text(count);
            }   
        }
        
    });
});