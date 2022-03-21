@extends('admin.layout.app')
@section('content')
     <div class="br-mailbox-list">
      <div class="br-mailbox-list-header">
        <a href="#" id="showMailBoxLeft" class="show-mailbox-left hidden-sm-up">
          <i class="fa fa-arrow-right"></i>
        </a>
        <h6 class="tx-inverse mg-b-0 tx-13 tx-uppercase">Claims <span class="tx-roboto">({{$claimCnt}})</span></h6>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-light disabled pd-x-25"><i class="fa fa-angle-left"></i></button>
          <button type="button" class="btn btn-light pd-x-25"><i class="fa fa-angle-right"></i></button>
        </div>
      </div><!-- br-mailbox-list-header  active  unread-->
      <div class="br-mailbox-list-body">
         @if($claimCnt)
          @foreach($claims as $each)
           <?php   $totalChild =  DB::table("claims_assistance")->where('parentId',$each->id)->count();?> 
            <div class="br-mailbox-list-item active">
          <div class="d-flex justify-content-between mg-b-5">
            <div>
              <i class="icon ion-ios-star tx-warning"></i>
              <i class="icon ion-android-attach"></i>
            </div>
            <span class="tx-12">10 hours ago</span>
          </div><!-- d-flex -->
          <h6 class="tx-14 mg-b-10 tx-gray-800">
              {{$each->name}},<span style="color:#ff2222">{{$each->insurance}}</span>
              @if($totalChild)({{$totalChild}})@endif
              <!--Socrates Itumay, me (4)-->
              </h6>
          <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
        </div><!-- br-mailbox-list-item -->
          @endforeach
         @endif
        
      </div><!-- br-mailbox-list-body -->
    </div><!-- br-mailbox-list -->

    <div class="br-mailbox-body">
      <div class="br-msg-header d-flex justify-content-between">
        <div class="media align-items-center">
          <img src="../img/img4.jpg" class="wd-40 rounded-circle" alt="">
          <div class="media-body mg-l-10">
            <p class="tx-inverse tx-medium mg-b-0">Louise Kate Lumaad</p>
            <p class="tx-12 mg-b-0">
              <span>Sep 20, 2017 8:45am</span>
              <a href="#" class="mg-l-5 tx-gray-500"><i class="icon ion-star"></i></a>
              <a href="#" class="mg-l-5 tx-gray-500"><i class="icon ion-android-attach"></i></a>
            </p>
          </div><!-- media-body -->
        </div><!-- media -->
        <nav class="nav nav-inline tx-size-24 mg-b-0 lh-0">
          <a href="#" class="nav-link tx-gray-light hover-inverse pd-x-5"><i class="icon ion-reply"></i></a>
          <a href="#" class="nav-link tx-gray-light hover-inverse pd-x-5"><i class="icon ion-reply-all"></i></a>
          <a href="#" class="nav-link tx-gray-light hover-inverse pd-x-5"><i class="icon ion-printer"></i></a>
          <a href="#" class="nav-link tx-gray-light hover-inverse pd-x-5"><i class="icon ion-android-more-horizontal"></i></a>
          <a id="closeMail" href="#" class="nav-link pd-x-5 mg-l-15 hidden-xl-up">
            <i class="icon ion-close"></i>
          </a>
        </nav>
      </div><!-- br-msg-header -->
      <div class="br-msg-body">
        <h6 class="tx-inverse mg-b-25 lh-4">Message sent via your Envato Market profile from themepixels</h6>

        <p>Hi Isidore,</p>

        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>

        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>

        <p>I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>

        <p>Regards,<br>ThemePixels</p>
      </div><!-- br-msg-body -->

      <div class="pd-x-30 pd-b-30">
        <div class="row flex-row-reverse">
          <div class="col-md-9">
            <textarea class="form-control ht-150" placeholder="Click to write message"></textarea>
          </div><!-- col-9 -->
          <div class="col-md-3 mg-t-30 mg-md-t-0">
            <div class="ht-150 bd bd-dashed d-flex align-items-center justify-content-center rounded bg-gray-300">
              <div class="tx-center wd-60p">
                <i class="icon ion-android-attach tx-32"></i>
                <p class="tx-12">Drag or click to attach a file</p>
              </div>
            </div>
          </div><!-- col-3 -->
        </div><!-- row -->
      </div>
    </div><!-- br-mailbox-body -->

      
@endsection