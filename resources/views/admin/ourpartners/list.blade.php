@extends('admin.layout.app')
@section('content')
       <!--<div class="" >-->
       <!--    <div class="our-partners-notify"></div>-->
       <!--    <form class="form-group" method="post" enctype="multipart/form-data" action="#" id="OurPartnerForm" >-->
       <!--         <input name="_token" type="hidden" value="{{ csrf_token() }}" />-->
            
       <!--     <div class="row mg-b-5">-->
       <!--       <div class="col-lg-4">-->
       <!--             <div class="form-group" style="margin-bottom:0px;">-->
       <!--               <label class="form-control-label">Partner's Name: <span class="tx-danger">*</span></label>-->
       <!--               <input class="form-control" type="text" name="pname" id="pname" placeholder="Enter Partner Name" >-->
       <!--             </div>-->
       <!--       </div>
              
       <!--       <div class="col-lg-2">-->
       <!--             <div class="form-group" style="margin-bottom:0px;">-->
       <!--               <label class="form-control-label">Partner's Logo: <span class="tx-danger">*</span></label>-->
       <!--               <input class="form-control" type="file" name="plogo" id="plogo"  >-->
       <!--             </div>-->
       <!--             <span id="plogo-error" class="error"></span>-->
                    
       <!--       </div><!-- col-3 -->
       <!--        <div class="col-lg-2 pd-t-30">-->
       <!--           <button type="submit" class="btn btn-info btn-block " id="saveOurPartnerInfoBtn" disabled>Submit</button>-->
       <!--       </div><!-- row -->
       <!--     </div>-->
       <!--   </form>-->
       <!-- </div>-->
<div class="card bd-0 ">
    <div class="card-header tx-medium bd-0 tx-white bg-danger">
       Ours Partner's List
    </div><!-- card-header -->
    <div class="card-body bd bd-t-0 rounded-bottom">
         <div class="row mg-b-5" id="row-partners">
             <?php foreach($partners as $row){?>
              <div class="col-lg-2"  id="col-figure-<?=$row->id;?>">
                 
                    <figure class="overlay bd bd-2 <?=($row->status=='ACTIVE')?'bd-success':'bd-danger';?>" style="box-shadow: 0px 0px 6px #ccc;" data-toggle="tooltip" data-placement="top" title="<?=$row->name;?>">
                      <img src="<?=asset('assets/partners/'.$row->logo_image);?>" class="img-fluid" alt="<?=$row->name;?>">
                      <figcaption class="overlay-body d-flex align-items-end justify-content-center">
                       <?php /*
                        <div class="img-option img-option-sm">
                          <a href="#" class="img-option-link btn-delete"  data-toggle="tooltip" data-placement="top" title="Delete" data-id="<?=$row->id;?>" data-name="<?=$row->name;?>"><div><i class="icon ion-ios-trash"></i></div></a>
                          <a href="#" class="img-option-link  btn-status" data-status="<?=$row->status;?>" data-id="<?=$row->id;?>" data-name="<?=$row->name;?>"  data-toggle="tooltip" data-placement="top" title="<?=($row->status=='ACTIVE')?'Click to disable':'Click to enable';?>" ><div><i class="icon ion-android-menu"></i></div></a>
                          
                        </div> */?>
                      </figcaption>
                    </figure>
                    <div class=" d-flex align-items-center justify-content-center">
                    <input type="file" name="makeImage" id="makeImage" data-id="<?=$row->id;?>" class="inputfile" data-multiple-caption="{count} files selected">
                    <label for="makeImage" class="tx-white bg-info">
                      <i class="icon ion-ios-upload-outline tx-24"></i>
                      <span>Choose a file...</span>
                    </label>
                  </div>
                  <br>
                  <div class="progress mg-b-10 ht-10" id="myprogress-container" >
                    <div class="progress-bar myprogress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  
             </div>
             <?php } ?>
           
         </div>
         
         <!--<div class="table-responsive">-->
         <!--    <table class="table table-bordered">-->
         <!--        <thead>-->
         <!--            <tr>-->
         <!--                <th>Icon</th>-->
         <!--                <th>Name</th>-->
         <!--                <th>Short Name</th>-->
         <!--            </tr>-->
         <!--        </thead>-->
         <!--        <tbody>-->
         <!--            <th-->
         <!--        </tbody>-->
         <!--    </table>-->
         <!--</div>-->
     </div><!-- card-body -->
 </div>
         
         

      
@endsection