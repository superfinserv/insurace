 $(function(){
    'use strict'
    //   ClassicEditor
    //     .create( document.querySelector( '.key-editor' ) )
    //     .catch( error => {
    //         console.error( error );
    //   } );
    
    // var allEditors = document.querySelectorAll('.key-editor');
    //     for (var i = 0; i < allEditors.length; ++i) {
    //       ClassicEditor.create(allEditors[i]);
    //     }
    
    // $('.key-editor--').summernote({
    //     placeholder: 'Enter Key benifits',
    //     tabsize: 2,
    //     height: 50,
    //     toolbar: [
    //       ['style', ['style']],
    //       ['font', ['bold', 'underline']],
    //      // ['fontname', ['fontname']],
    //       ['fontsize', ['fontsize']],
    //       ['color', ['color']],
    //      // ['para', ['ul', 'ol', 'paragraph']],
    //       //['table', ['table']],
    //       //['insert', ['link', 'picture', 'video']],
    //       //['view', ['fullscreen', 'codeview', 'help']]
    //     ]
    //   });
      
      $('.desc-editor').summernote({
        placeholder: 'Enter Plan Description',
        tabsize: 2,
        height: 200,
        // toolbar: [
        //   ['style', ['style']],
        //   ['font', ['bold', 'underline', 'clear']],
        //   ['color', ['color']],
        //  // ['para', ['ul', 'ol', 'paragraph']],
        //   //['table', ['table']],
        //   //['insert', ['link', 'picture', 'video']],
        //   //['view', ['fullscreen', 'codeview', 'help']]
        // ]
      });
      
      
      
      
      
     function validateInput(name){
           if($('#'+name).val()!=""){
               return true;
           }else{
               return false;
           } 
        }
     
     $('body').on('input change','.input-fields', function(e) {     
       $(this).css('border-color','#ced4da');
       var id = $(this).attr('id');
       $('#span-'+id).remove();
     })
     
    
     $('body').on('click','.updateKeybenifits', function(e) { 
       e.preventDefault()
       var _this=$(this);
       var id = $(this).attr('data-id');
       var field = 'key-benifits'+id;
       if(validateInput(field)){
           
              var formData = { id:id,value:$('#'+field).val()};
              $.post(base_url+'/our-partners/plan-benifits/update/',formData,function(result){
                    if($.trim(result.status)=='success'){
                         notification('success',result.message);
                  }else{
                       notification('error',result.message);
                } 
              },'json')
           
       }else{
           $('#'+field).css('border-color','red');
           $('#'+field ).parent().append('<sapn id="span-'+field+'" class="error">This field is required!</span>');
       }
    });
    
     $('body').on('click','.addKeybenifits', function(e) { 
       e.preventDefault()
       var _this=$(this);
       var pId = $('#planID').val();
       var field = 'new-key-benifit';
       if(validateInput(field)){
           
              var formData = { pId:pId,value:$('#'+field).val()};
              $.post(base_url+'/our-partners/plan-benifits/save/',formData,function(result){
                    if($.trim(result.status)=='success'){
                        $('#row-benifits').append(result.data_html);
                        $('#'+field).val('');
                        notification('success',result.message);
                    }else{
                       notification('error',result.message);
                   } 
              },'json')
           
       }else{
           $('#'+field).css('border-color','red');
           $('#'+field ).parent().append('<sapn id="span-'+field+'" class="error">This field is required!</span>');
       }
    });
    
     $('body').on('click', '.deleteKeybenifits', function (e) { 
          e.preventDefault();
        var id =$(this).attr('data-id');
        $.confirm({
          icon:'icon ion-trash-a',
          title: 'Confirmation',
          content: "Sure you want to delete ?",
          type: 'red',
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.post(base_url+"/our-partners/plan-benifits/delete/",{id:id},function(resp) {
                    if($.trim(resp.status)=='success'){
                         $('#row-'+id).remove()
                        
                        notification('success',result.message);
                    }else{
                        notification('error',result.message);
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
      
     $('body').on('click', '#btnupdatePlaninfo', function (e) { 
          e.preventDefault();
          
            var formData = new FormData();
            if($('#policy_brochure').val()!=''){  formData.append('policy_brochure', $('#policy_brochure')[0].files[0]);}
            if($('#policy_wording').val()!=''){   formData.append('policy_wording', $('#policy_wording')[0].files[0]);}
            formData.append('planID', $('#planID').val());
           // formData.append('supp_name', $('#supp_name').val());
            formData.append('plan_name', $('#plan_name').val());
            formData.append('plan_description', $('#plan_description').val());
            
            $(".pk-fields" ).each(function( index ) { 
                formData.append($(this).attr('name'),$(this).val());
            })
            $.ajax({
                url: base_url+'/our-partners/plan-info/update/',
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:"json",
                // this part is progress bar
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            console.log(percentComplete);
                            // if(percentComplete>=50){
                            //     $('.myprogress-'+doc).addClass('bg-success');
                            // }
                            // $('.myprogress-'+doc).text(percentComplete + '%');
                            // $('.myprogress-'+doc).css('width', percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    console.log(data);
                     if($.trim(data.status)=="success"){
                         var res = data.data;
                         $('#file1Area').find('.help-block').text(res.file1);
                         $('#file2Area').find('.help-block').text(res.file2);
                       toastr.success(data.message);
                    }else{
                       toastr.error(data.message);
                    }
                    
                }
            });
    });
    
     
    
    
    if($('#plans-datatable').length){
        var planstable = $('#plans-datatable').DataTable( {
            "scrollX": false,
             bLengthChange: false,
             responsive: true,
            "autoWidth": false,
                    "processing": true,
                    "serverSide": true,
                   "ajax": {
                        "url": base_url+"/our-partners/plans/datatable",
                         "type": "POST",
                    },
                    "columns": [
                        { "data": "sno","orderable":false},
                        {"data" : "plan_name","orderable":false},
                        {"data" : "partner","orderable":false},
                        {"data" : "status","orderable":false},
                        { "data": "action" ,"orderable":false}
                    ],
                    "columnDefs": [
                        { "width": "3%", "targets": 0 },
                        { "width": "42%", "targets": 1 },
                        { "width": "25%", "targets": 2 },
                        { "width": "20%", "targets": 3 },
                        { "width": "10%", "targets": 4 }
                     
                      ],
                } );
     
        $('.search-input-text').on( 'keyup change', function () {   // for text boxes
            var i =$(this).attr('data-column');  // getting column index
            var v =$(this).val();  // getting search input value
            planstable.columns(i).search(v).draw();
       });
       
       planstable.on( 'draw', function () { 
             $('[data-toggle="tooltip"]').tooltip({
                template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
              });
       })
       
       $('body').on('click', '.reload-table', function (e) {
           $(this).find('i').addClass('fa-spin');
            planstable.ajax.reload();
            $(this).find('i').removeClass('fa-spin');
       });
       
        $("body").on('click', '.btn-status', function (e) { 
        var name =$(this).attr('data-plan');
        var id =$(this).attr('data-id');
        
        var msg ="";var status="";var typ="";
        var status =$(this).attr('data-status');
        if(status=="ACTIVE"){
          status ="INACTIVE";typ="red";
          msg = "<p style='color:red;'>Sure you want <strong>"+name+"</strong> is mark as disabled? </p>";
        }else{
          status ="ACTIVE";typ="green";
          msg = "<p style='color:green;'>Sure you want to <strong>"+name+"</strong> is mark as enable? </p>";
        }
       var _this = $(this);
        $.confirm({
          title: 'Confirmation',
          content: msg,
          type: typ,
          typeAnimated: true,
          buttons: {
              confirm: function () {
                $.get(base_url+"/our-partners/plans/update-status/"+id+"/"+status,function(resp) {
                    if(resp.status=='success'){
                            _this.attr('data-status',status);
                             planstable.ajax.reload();
                             if(status=="ACTIVE"){
                                 _this.attr('data-original-title','Click to disable');
                                toastr.success(name+" is marked enabled");
                             }else{
                               _this.attr('data-original-title','Click to enable');
                                toastr.success(name+" is marked as disabled");
                             }
                    }else{
                       toastr.error(resp.message);
                    }
                },'json');
              },
              cancel: function () {
                  // $.alert('Canceled!');
              }
          }
      });
 
    });
    }
      
 })