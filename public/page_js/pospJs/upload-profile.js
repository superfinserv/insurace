$(document).ready(function(){
    'use strict';
     var _token = $('meta[name="csrf-token"]').attr('content'); 
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': _token
        }
    });
    
    function addSpinner(el, static_pos){
      var spinner = el.children('.spinner');
      if (spinner.length && !spinner.hasClass('spinner-remove')) return null;
      !spinner.length && (spinner = $('<div class="spinner' + (static_pos ? '' : ' spinner-absolute') + '"/>').appendTo(el));
      animateSpinner(spinner, 'add');
    }
    
    function removeSpinner(el, complete){
      var spinner = el.children('.spinner');
      spinner.length && animateSpinner(spinner, 'remove', complete);
    }
    
    function animateSpinner(el, animation, complete){
      if (el.data('animating')) {
        el.removeClass(el.data('animating')).data('animating', null);
        el.data('animationTimeout') && clearTimeout(el.data('animationTimeout'));
      }
      el.addClass('spinner-' + animation).data('animating', 'spinner-' + animation);
      el.data('animationTimeout', setTimeout(function() { animation == 'remove' && el.remove(); complete && complete(); }, parseFloat(el.css('animation-duration')) * 1000));
    }
    
    var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,    
            viewport: { // Default { width: 100, height: 100, type: 'square' } 
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });
    
   $("#upload-profile-button").on('click', function() {
      $(".file-upload").click();
    });
    
    
     $(".file-upload").on('change', function(){ 
         var reader = new FileReader();
            reader.onload = function (e) {
              resize.croppie('bind',{
                url: e.target.result
              }).then(function(){
                console.log('jQuery bind complete');
              });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
     })
     
     $('.crop_image').click(function(event){
        //var formData = new FormData();
        addSpinner($('.p-image'));
        var formv = $('#upload-customer-profile')[0];
        var formData = new FormData(formv);
        resize.croppie('result', {type: 'blob', format: 'png'}).then(function(blob) {
        formData.append('cropped_image', blob);
        ajaxFormPost(formData, '/profile/updateprofile/'); /// Calling my ajax function with my blob data passed to it
    });
    $('#uploadimageModal').modal('hide');
});
/// Ajax Function
function ajaxFormPost(formData, actionURL){
    console.log(formData);
    $.ajax({
        url: actionURL,
        type: 'POST',
        data: formData,
        cache: false,
        async: true,
        processData: false,
        contentType: false,
        timeout: 5000,
         dataType:'json',
        beforeSend: function(){
        },
        success: function(resp) {
            var st = $.trim(resp.status);
            alertconfig(resp.data.iscomplete,"profile");
            if (st === 'success') {
                toastr.success(resp.msg);
                $('#cover_image').val("");
                $('.customerProfileImage').attr('src', resp.url);
                 removeSpinner($('.p-image'))
            } else {
               toastr.error(resp.msg);
                removeSpinner($('.p-image'))
            }
        },
        complete: function(){
        }
    });
}
});