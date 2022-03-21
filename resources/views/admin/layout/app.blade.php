<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="shortcut icon" href="{{asset('admin/images/favicon.png')}}" >
 
    <title>Administrator-Home</title>

    <!-- vendor css -->
    <link href="{{asset('admin/lib/%40fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css" rel="stylesheet">
    <link href="{{asset('admin/lib/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    <link  href="{{asset('admin/lib/loading/loading.css')}}"  rel="stylesheet" type="text/css"/>
    <link  href="{{asset('admin/lib/confirm/css/jquery-confirm.css')}}"  rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/lib/toastr/toastr.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/lib/summernote/summernote-bs4.css')}}" rel="stylesheet">
    <link href="{{asset('admin/lib/spinkit/css/spinkit.css')}}" rel="stylesheet">
     <link href="{{asset('admin/lib/chartist/chartist.min.css')}}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link  href="{{asset('admin/css/bracket.css')}}" rel="stylesheet">
    <style>
        .error{
            color: red;
            font-size: 12px;
        }
        
        .select2 {
            width:100%;
        }
        .agent-info-menu .list-group-item{
            cursor:pointer;
        }
        
        .jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-content {
            overflow: auto;
            overflow-x: hidden;
        }
    </style>
    
  


<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "4e1174c0-be7d-43d7-a934-b56456fd8668",
    });
  });
</script>
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    
     @include('admin.layout.sidebar')
     <!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
      @include('admin.layout.header')
    <!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
      <!-- not inclided*/
    <!-- br-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->
      <div class="br-mainpanel">
        
      <?php if($title!='Home'){ ?>
       <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">{{$title}}</a>
          <a class="breadcrumb-item active" href="#">{{$subtitle}}</a>
        </nav>
      </div><!-- br-pageheader -->
      <?php  } ?>
      <div class="br-pagebody">
        @yield('content')
      </div><!-- br-pagebody -->
      <footer class="br-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; {{date('Y')}}. Super Finserv Private Limited. All Rights Reserved.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Developed By:</span>
          <a target="_blank" class="pd-x-5" href="#">Super Finserv Private Limited</a>
         </div>
      </footer>
    </div>
    <!-- ########## START: MAIN PANEL ########## -->
    <!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{asset('admin/lib/jquery/jquery.min.js')}}"></script>
     <script src="{{asset('admin/lib/validation/jquery.validate.min.js')}}"  type="text/javascript"></script>
     <script src="{{asset('admin/lib/validation/validated.js')}}"  type="text/javascript"></script>
     <script src="{{asset('admin/lib/jquery-ui/ui/jquery-ui.js')}}"></script>
    <script src="{{asset('admin/lib/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <script src="{{asset('admin/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('admin/lib/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('admin/lib/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('admin/lib/rickshaw/vendor/d3.min.js')}}"></script>
    <script src="{{asset('admin/lib/rickshaw/vendor/d3.layout.min.js')}}"></script>
    <script src="{{asset('admin/lib/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{asset('admin/lib/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('admin/lib/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('admin/lib/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('admin/lib/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('admin/lib/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('admin/lib/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('admin/lib/editors/ckeditor5-build-classic/ckeditor.js')}}"></script>
    <script src="{{asset('admin/lib/summernote/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('admin/lib/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('admin/lib/highlightjs/highlight.pack.min.js')}}"></script>
    <script src="{{asset('admin/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="{{asset('admin/js/bracket.js')}}"></script>
    <script src="{{asset('admin/js/tooltip-colored.js')}}"></script>
    <script src="{{asset('admin/js/popover-colored.js')}}"></script>
    <script src="{{asset('admin/js/ResizeSensor.js')}}"></script>
    <script src="{{asset('admin/lib/confirm/js/jquery-confirm.js')}}"  type="text/javascript"></script>
    <script src="{{asset('admin/lib/loading/loading.js')}}"  type="text/javascript"></script>
    <script src="{{asset('admin/lib/loading-btn/jquery.loadButton.js')}}"  type="text/javascript"></script>
    <script src="{{asset('admin/lib/toastr/toastr.min.js')}}"  type="text/javascript"></script>
    <script src="{{asset('admin/lib/input-mask/jquery.mask.js')}}"  type="text/javascript"></script>
 
    <script> var base_url = "{{url('/')}}"; </script>  
    <script> var assetUrl = "https://supersolutions.in/insassets/agents/";</script>
       @isset($scripts)
         @foreach($scripts as $_script)
            <script src="{{$_script}}" ></script> 
         @endforeach
        @endisset
    <script>
    //   $(function(){
    //     'use strict'

    //     // FOR DEMO ONLY
    //     // menu collapsed by default during first page load or refresh with screen
    //     // having a size between 992px and 1299px. This is intended on this page only
    //     // for better viewing of widgets demo.
    //     $(window).resize(function(){
    //       minimizeMenu();
    //     });

    //     minimizeMenu();

    //     function minimizeMenu() {
    //       if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
    //         // show only the icons and hide left menu label by default
    //         $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
    //         $('body').addClass('collapsed-menu');
    //         $('.show-sub + .br-menu-sub').slideUp();
    //       } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
    //         $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
    //         $('body').removeClass('collapsed-menu');
    //         $('.show-sub + .br-menu-sub').slideDown();
    //       }
    //     }
    //   });
    </script>
  </body>
</html>
