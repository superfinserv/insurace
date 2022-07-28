$(function(){
    'use strict';
   
	var customSelect = $('select.custom-select');
	// FIRST, create the custom select menus from the existing select
	customSelect.each(function() {
		var that = $(this);
		var listID = that.attr('id'),
		groups = that.children('optgroup'),
			theOptions = "",
			startingOption = "",
			customSelect = "";
		//check if there are option groups 
		if(groups.length) {
			groups.each(function() {
				var curGroup = $(this);
				var	curName = curGroup.attr('label');
				//Open the option group
				theOptions += '<li class="optgroup">' + curName + '</li>';
				//get the options
				curGroup.children('option').each(function() {
					var curOpt = $(this);
					var curVal = curOpt.attr('value'),
						curHtml = curOpt.html(),
						isSelected = curOpt.attr('selected');
					if(isSelected === 'selected') {
						startingOption = curHtml;
						theOptions += '<li class="selected" data-value="' + curVal + '">' + curHtml + '</li>';
					}else {
						theOptions += '<li data-value="' + curVal + '">' + curHtml + '</li>';
					}
				});
				//Close the option group
				//theOptions += '<li class="optgroup-close"></li>';
			});
			//add options not in a group to the top of the list
			that.children('option').each(function() {
				var curOpt = $(this);
				var curVal = curOpt.attr('value'),
					curHtml = curOpt.html(),
					isSelected = curOpt.attr('selected');
				if(isSelected === 'selected') {
					startingOption = curHtml;
					theOptions = '<li class="selected" data-value="' + curVal + '">' + curHtml + '</li>' + theOptions;
				}else {
					theOptions = '<li data-value="' + curVal + '">' + curHtml + '</li>' + theOptions;
				}
			});
		} else {
			that.children('option').each(function() {
				var curOpt = $(this);
				var curVal = curOpt.attr('value'),
					curHtml = curOpt.html(),
					isSelected = curOpt.attr('selected');
				if(isSelected === 'selected') {
					startingOption = curHtml;
					theOptions += '<li class="selected" data-value="' + curVal + '">' + curHtml + '</li>';
				}else {
					theOptions += '<li data-value="' + curVal + '">' + curHtml + '</li>';
				}
			});
		}
		//build the custom select
		customSelect = '<div class="dropdown-container"><div class="dropdown-select entypo-down-open-big"><span>' + startingOption + '</span></div><ul class="dropdown-select-ul" data-role="' + listID +'">' + theOptions + '</ul></div> <!-- .custom-select-container -->';
		//append it after the actual select
		$(customSelect).insertAfter(that);
	});
	
	var	selectdd = $('.dropdown-select'),
		selectul = $('.dropdown-select-ul'),
		selectli = $('.dropdown-select-ul li');
	//THEN make them work
	selectdd.on('click',function(){
		$(this).parent('.dropdown-container').toggleClass('active');
	});
	//Hide it on mouseleave
	selectul.on('mouseleave',function(){
		$(this).parent('.dropdown-container').removeClass('active');
	});
	//select the option
	selectli.on('click',function(){
		var that = $(this);
		//ensure clicking group labels does not cause change
		if(!that.hasClass('optgroup')) {
			var	parentUl = that.parent('ul'),
				thisdd = parentUl.siblings('.dropdown-select'),
				lihtml = that.html(),
				livalue = that.attr('data-value'),
				originalSelect = '#' + parentUl.attr('data-role');
			//close the dropdown
			parentUl.parent('.dropdown-container').toggleClass('active');
			//remove selected class from all list items
			that.siblings('li').removeClass('selected');
			//add .selected to clicked li
			that.addClass('selected');
			//set the value of the hidden input
			$(originalSelect).val(livalue);
			//change the dropdown text
			thisdd.children('span').html(lihtml);
			
			 var range =  $('#plan_cover_filter').val();
             var Plantype =  $('#plan_policy_typ_filter').val();
             //console.log(range,Plantype);
             $('.col-content').empty();
			 getPlans(range,Plantype);
		}
	});


     var loader = '<span class="inline-loader"><span class="inline-loader-box"></span><span class="inline-loader-box"></span><span class="inline-loader-box"></span></span>';
    // var range = 
    // var pt = "FL";
 
  
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
  


     const configElem  ={ 
         addElements: function(elem,result){
               let sumInsured = parseFloat(result.sumInsured);
                if(sumInsured>99){
                    sumInsured = (sumInsured==100)?"1 Cr":"2 Cr";
                }else{
                    sumInsured = (sumInsured==1)?result.sumInsured+" Lakh":result.sumInsured+" Lakhs";
                    
                }
                
                var _feature ="";
                  if(result.features === undefined || result.features === null){ 
                      _feature = "";
                  }else{
                    $.each(result.features, function(i, item) {
                        //console.log(item._key);
                        _feature += '<li>'+item._key+':'+item._val+'</li>';
                       
                    })
                  }
              let supp =  result.supplier;
              let supTxt = supp.toLowerCase();
              var _html =  '<div class="row health-card '+supTxt+'-card elem-'+result.id+'-'+result.supplier+'" data-amount="'+result.amount+'">'
                                    +'<div class="col-md-8">'
                                           +'<div class="card left-card">'
                                              +'<div class="card-header">'+result.title+'</div>'
                                               +'<div class="card-body">'
                                                   +'<ul class="health-card-features">'
                                                       +'<li>Single pvt AC Room</li>'
                                                       +'<li>Restoration of cover</li>'
                                                       +'<li>Free health checkup</li>'
                                                       +'<li>Existing Illness cover</li>'
                                                       +'<li>More Features</li>'
                                                   +'</ul>'
                                              +'</div>'
                                            +'</div>'
                                    +'</div>'
                                    +'<div class="col-md-4 ">'
                                        +'<div class="card right-card">'
                                            +'<ul class="health-card-premium">'
                                                +'<li>'
                                                    +'<span>Sum Insured</span>'
                                                    +'<h4 class="h4-amt plan-premium-amount'+result.id+'-'+result.supplier+'" data-val="'+result.sumInsured+'">₹'+sumInsured+'</h4>'
                                                +'</li>'
                                                +'<li>'
                                                    +'<span>Premium/Yr</span>'
                                                    +'<h4 class="h4-amt plan-amount'+result.id+'-'+result.supplier+'" data-val="'+result.amount+'" >₹'+result.amount+'</h4>'
                                                +'</li>'
                                            +'</ul>'
                                            +'<button class="btnSF btn-red btn-radius-10 create-enquiry" data-supp="'+result.supplier+'" data-group="'+result.id+'-'+result.supplier+'" style="line-height: 35px;font-weight: 700;">Buy Now</button>'
                                        +'</div>'
                                    +'</div>'
                                    +'<div class="col-md-4">'
                                      +'<div class="custom-control custom-checkbox plan_check">'
                            		  	+'<input type="checkbox" class="custom-control-input addtoCampre" id="'+result.id+'-addtoCampre" data-supp="'+result.supplier+'" value="'+result.id+'-'+result.supplier+'" name="'+result.id+'-addtoCampre">'
                            		  	+'<label class="custom-control-label" style="font-weight: 600;" for="'+result.id+'-addtoCampre">Add to Compare</label>'
                            		+'</div>'
                                    +'</div>'
                                    //   +'<div class="col-md-3">'
                                    //   +'<a href="#" class="downloadLink txt-blue">Policy Wording <span class="fa fa-arrow-down"></span></a>'
                                    //  +'</div>'
                                      +'<div class="col-md-4">'
                                       //+'<a href="#" class="downloadLink txt-blue">Policy Brochure <span class="fa fa-arrow-down"></span></a>'
                                     +'</div>'
                                     
                                     +'<div class="col-md-4">'
                                       +'<a href="#" class="downloadLink downloadQuoteLink txt-blue" data-supp="'+result.supplier+'" data-group="'+result.id+'-'+result.supplier+'">Download Quote <span class="fa fa-cloud-download"></span></a>'
                                     +'</div>'
                               +'</div>';
                               
                             elem.append(_html);
                             $('[data-toggle="tooltip"]').tooltip();
               
         },
         
         addLoaders:function(){
             var skalton = '<div class="ph-elements">'
                              +'<div class="ph-item">'
                                  
                                +'<div class="ph-col-7">'
                                   +'<div class="ph-row">'
                                     +'<div class="ph-col-10"></div>'
                                     +'<div class="ph-col-2 empty"></div>'
                                +'</div>'
                                    +'<div class="ph-row">'
                                        +'<div class="ph-col-3"></div>'
                                        +'<div class="ph-col-1 empty"></div>'
                                        +'<div class="ph-col-3"></div>'
                                        +'<div class="ph-col-1 empty"></div>'
                                        +'<div class="ph-col-3"></div>'
                                         
                               +'</div>'
                                    +'<div class="ph-row">'
                                        +'<div class="ph-col-3"></div>'
                                        +'<div class="ph-col-1 empty"></div>'
                                        +'<div class="ph-col-4"></div>'
                                        +'<div class="ph-col-1 empty"></div>'
                                        +'<div class="ph-col-2 empty"></div>'
                                         
                                +'</div>'
                                    
                                    +'<div class="ph-row" style="margin-top: 43px">'
                                      +'<div class="ph-col-1 big"></div>'
                                      +'<div class="ph-col-1 empty"></div>'
                                      +'<div class="ph-col-3 big"></div>'
                                       +'<div class="ph-col-1 big"></div>'
                                      +'<div class="ph-col-4 empty"></div>'
                                +'</div>'
                                   
                                +'</div>'
                                +'<div class="ph-col-4">'
                                    +'<div class="ph-row">'
                                      +'<div class="ph-col-4"></div>'
                                      +'<div class="ph-col-2 empty"></div>'
                                      +'<div class="ph-col-4"></div>'
                                +'</div>'
                                     +'<div class="ph-row">'
                                      +'<div class="ph-col-4 big"></div>'
                                      +'<div class="ph-col-2 empty"></div>'
                                      +'<div class="ph-col-4 big"></div>'
                                +'</div>'
                                    +'<div class="ph-row">'
                                        +'<div class="ph-col-12 bigger"></div>'
                                +'</div>'
                                    +'<div class="ph-row">'
                                         +'<div class="ph-col-2 empty"></div>'
                                      +'<div class="ph-col-4"></div>'
                                    +'</div>'
                                +'</div>'
                             +'</div>'
                            +'</div>';
               if($('.elem-digit-health').find('.ph-elements').length==0){ $('.elem-digit-health').html(skalton); };
               if($('.elem-hdfcergo-health').find('.ph-elements').length==0){ $('.elem-hdfcergo-health').html(skalton); };
               if($('.elem-manipal_cigna-health').find('.ph-elements').length==0){  $('.elem-manipal_cigna-health').html(skalton); };
               if($('.elem-care-health').find('.ph-elements').length==0){  $('.elem-care-health').html(skalton); };
               
            }
     }
     
      const HdfcErgoLib = { 
           
          OptimaSecure: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'HDFCERGO',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"OptimaSecure"},
                  success: function (data, status, jqXHR) {
                     if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          }
      } 
     const DigitLib = { 
           
          Silver: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'DIGIT',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Silver"},
                  success: function (data, status, jqXHR) {
                     if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          },
          
          Gold: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'DIGIT',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Gold"},
                  success: function (data, status, jqXHR) {
                     if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          },
          
          Diamond: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'DIGIT',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Diamond"},
                  success: function (data, status, jqXHR) {
                       if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          }
      }
      
     const ManipalCignaLib = { 
           
          Protect: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'MANIPAL_CIGNA',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Protect"},
                  success: function (data, status, jqXHR) {
                     if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          },
          
          Plus: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'MANIPAL_CIGNA',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Plus"},
                  success: function (data, status, jqXHR) {
                     if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          },
          
          Prime: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'MANIPAL_CIGNA',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Prime"},
                  success: function (data, status, jqXHR) {
                       if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          }
      }
      
     const CareLib = { 
           
          Basic: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'CARE',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Basic"},
                  success: function (data, status, jqXHR) {
                     if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          },
          
          Classic: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'CARE',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Classic"},
                  success: function (data, status, jqXHR) {
                     if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          },
          
          Advantage: function(elemCls,range,pt){
              var postData = JSON.parse(localStorage.getItem('healthInfo'));
              var customer = JSON.parse(localStorage.getItem('customersDetails'));
              var deviceToken = localStorage.getItem('deviceToken');
             $.ajax({
                  url: base_url + "/health-insurance/get-health-plans/table",
                  type: "POST",
                  dataType: "json",
                  data:{supp:'CARE',range:range,policytyp:pt,params:postData,customer:customer,deviceToken:deviceToken,pln:"Advantage"},
                  success: function (data, status, jqXHR) {
                       if(data.plans.length>0 && data.status=="success"){
                           var results = data.plans;
                           $.each(results, function(key,row){
                               configElem.addElements(elemCls,row);
                           })
                      }
                  },
                  error: function (jqXHR, status, err) {
                        
                  },
                  complete: function (data,jqXHR, status) {
                    
                  }
             })
          }
      }
     
     
     const planLib = {
         
         HdfcErgo: function(range,pt){   
             var elemCls = $('.elem-hdfcergo-health');
            // elemCls.empty();
             HdfcErgoLib.OptimaSecure(elemCls,range,pt);
             setTimeout(function() { 
                elemCls.find('.ph-elements').remove();
             }, 3000);
             
         },
        
         Digit: function(range,pt){   
             var elemCls = $('.elem-digit-health');
            // elemCls.empty();
             DigitLib.Silver(elemCls,range,pt);
             DigitLib.Gold(elemCls,range,pt);
             DigitLib.Diamond(elemCls,range,pt);
             setTimeout(function() { 
                elemCls.find('.ph-elements').remove();
             }, 3000);
             
         },
         
         ManipalCigna: function(range,pt){ 
             var elemCls = $('.elem-manipal_cigna-health');
             //elemCls.empty();
             ManipalCignaLib.Protect(elemCls,range,pt);
             ManipalCignaLib.Plus(elemCls,range,pt);
             ManipalCignaLib.Prime(elemCls,range,pt);
              setTimeout(function() { 
                elemCls.find('.ph-elements').remove();
             }, 3000);
             
         },
         Care: function(range,pt){ 
             var elemCls = $('.elem-care-health');
            // elemCls.empty();
             CareLib.Basic(elemCls,range,pt);
             CareLib.Classic(elemCls,range,pt);
             CareLib.Advantage(elemCls,range,pt);
             setTimeout(function() { 
                elemCls.find('.ph-elements').remove();
             }, 3000);
         }
         
         
     }
     
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
        getPlans("4",typ);
     
     
     
     function getPlans(Range,Plantype){
           $('.digit-partner-row').removeAttr('style');
           $('.hdfcergo-partner-row').removeAttr('style');
           $('.manipal_cigna-partner-row').removeAttr('style');
           $('.care-partner-row').removeAttr('style');
           
           configElem.addLoaders();
          planLib.HdfcErgo(Range,Plantype);
          planLib.Digit(Range,Plantype);
          planLib.ManipalCigna(Range,Plantype);
          planLib.Care(Range,Plantype);
          
        //   setTimeout(function() { 
        //         if($('.digit-card').length==0){ $('.digit-partner-row').css('display','none');}
        //         if($('.hdfcergo-card').length==0){ $('.hdfcergo-partner-row').css('display','none');}
        //       if($('.manipal_cigna-card').length==0){ $('.manipal_cigna-partner-row').css('display','none');}
        //       if($('.care-card').length==0){ $('.care-partner-row').css('display','none'); }
        //   }, 4000);
     }
     
     
     
    //  $('body').on('change','.plan-filter',function(e){ 
         
    //      e.preventDefault();
    //      getPlans(range,Plantype);
    //  });
     
    $('body').on('click','.show-more-plans',function(e){
        e.preventDefault();
        var _this = $(this);
         var pqrtnerCls = _this.attr('data-partner');
        if(_this.hasClass('more')){
            _this.removeClass('more').addClass('less');
            _this.find('.show-more-txt').text('Hide');
           $('.'+pqrtnerCls+'-card').css('display','inline-flex');
        }else{
           _this.removeClass('less').addClass('more');
             let len = $('.'+pqrtnerCls+'-card').length;
             len  = (len>1)?parseInt(len-1):len;
           _this.find('.show-more-txt').text(len+' More Plans ');
           $('.'+pqrtnerCls+'-card').css('display','none');
           //$('.elem-'+pqrtnerCls+'-health').find(':first-child').css('display','inline-flex');
           $(".elem-"+pqrtnerCls+"-health div:first").css('display','inline-flex');
        }
        
      
    })
    $('body').on('click','.addtoCampre',function(e){
        e.preventDefault();
        let _this = $(this);
        if(_this.is(':checked')){ // addto compare
           let val  = _this.val();
           let sumIns = $('.plan-premium-amount'+val).attr('data-val');
        }else{ //remove from Compare
        }
    
    });
    
    
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
   });
   
   $('body').on('click','.downloadQuoteLink',function(e){
            e.preventDefault();
           var str = $(this).attr('data-group');
            var _this = $(this);
            var clone =  _this.clone();
          _this.attr('disabled',true);
          _this.prop('disabled',true);
          var _html = _this.html();
          _this.html(loader);
           if(str!=""){
               var grp = str.split('-');
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
                 
                   var status = $.trim(resp.status);
                   if(status=='success'){
                       insurerInfo.enq = resp.data.enq;
                       if(resp.data.addon  !== "undefined" ){
                           insurerInfo.addOn = resp.data.addon; 
                       }
                       localStorage.setItem("healthInfo", JSON.stringify(insurerInfo));
                        _this.attr('disabled',false);
                        _this.prop('disabled',false);
                        _this.html(_html);
                       window.location.href=base_url+"/download-quote/health-insurance/"+resp.data.enq;
                   }else{
                       _this.attr('disabled',false);
                        _this.prop('disabled',false);
                        _this.html(_html);
                       toastr.error(resp.message);
                   }
               });
           }else{
               _this.attr('disabled',false);
                _this.prop('disabled',false);
                _this.html(_html);
                 toastr.error("Sorry! we are unable to download quote");
           }
   });
   
})