          <style>
              ul.agent-info-menu li:hover > a >  strong>i.fa ,ul.agent-info-menu li:hover > a > strong{
                  color:#fff
              }
              
              ul.agent-info-menu li:hover{
                      background: #dc3545;
                       /*box-shadow: 4px 0px 0px 0px #AC0F0B;*/
              }
          </style>
           <ul class="list-group agent-info-menu">
                <li class="list-group-item rounded-top-0" style="<?=($subtitle=="Personal Informations")?'background: #dc3545;':'';?>">
                  <a href="{{url('agent/edit/personal/'.$agentData->id)}}" class="mg-b-0">
                    <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Personal Informations")?'color: #fff;':'';?>">
                   <?=($subtitle=="Personal Informations")?'<i class="fa fa-user  mg-r-8" style="color:#fff"></i>':'<i class="fa fa-user tx-info mg-r-8"></i>';?>
                           Personal Info</strong></a>
                </li>
                <li class="list-group-item" style="<?=($subtitle=="Educational Informations")?'background: #dc3545;':'';?>">
                  <a href="{{url('agent/edit/educational/'.$agentData->id)}}" class="mg-b-0">
                    <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Educational Informations")?'color: #fff;':'';?>">
                    <?=($subtitle=="Educational Informations")?'<i class="fa fa-graduation-cap  mg-r-8" style="color:#fff"></i>':'<i class="fa fa-graduation-cap tx-info mg-r-8"></i>';?>
                          Educational Info</strong></a>
                </li>
                <li class="list-group-item" style="<?=($subtitle=="Bank Informations")?'background: #dc3545;':'';?>">
                  <a href="{{url('agent/edit/bank/'.$agentData->id)}}" class="mg-b-0">
                    <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Bank Informations")?'color: #fff;':'';?>">
                          <?=($subtitle=="Bank Informations")?'<i class="fa fa-university  mg-r-8" style="color:#fff"></i>':'<i class="fa fa-university tx-info mg-r-8"></i>';?>
                          Bank Details</strong></a>
                </li>
                <li class="list-group-item" style="<?=($subtitle=="Required Documents")?'background: #dc3545;':'';?>">
                  <a href="{{url('agent/edit/document/'.$agentData->id)}}" class="mg-b-0">
                    <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Required Documents")?'color: #fff;':'';?>">
                    <?=($subtitle=="Required Documents")?'<i class="fa fa-book  mg-r-8" style="color:#fff"></i>':'<i class="fa fa-book tx-info mg-r-8"></i>';?>
                    Required Documents</strong></a>
                </li>
                <li class="list-group-item rounded-bottom-0" style="<?=($subtitle=="Payment Informations")?'background: #dc3545;':'';?>">
                  <a href="{{url('agent/edit/payment/'.$agentData->id)}}" class="mg-b-0">
                     <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Payment Informations")?'color: #fff;':'';?>">
                          <?=($subtitle=="Payment Informations")?'<i class="fa fa-credit-card  mg-r-8" style="color:#fff"></i>':'<i class="fa fa-credit-card tx-info mg-r-8"></i>';?>
                          Payment Info</strong></a>
                </li>
                <li class="list-group-item rounded-bottom-0" style="<?=($subtitle=="Identity Informations")?'background: #dc3545;':'';?>">
                  <a href="{{url('agent/edit/identity/'.$agentData->id)}}" class="mg-b-0">
                    <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Identity Informations")?'color: #fff;':'';?>">
                    <?=($subtitle=="Identity Informations")?'<i class="fa fa-id-card  mg-r-8" style="color:#fff"></i>':'<i class="fa fa-id-card tx-info mg-r-8"></i>';?>
                    Identity Info</strong></a>
                </li>
                
                <li class="list-group-item rounded-bottom-0" style="<?=($subtitle=="Certifications")?'background: #dc3545;':'';?>">
                  <a href="{{url('agent/certificates/'.$agentData->id)}}" class="mg-b-0">
                     <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Certifications")?'color: #fff;':'';?>">
                      <?=($subtitle=="Certifications")?'<i class="fa fa-certificate  mg-r-8" style="color:#fff"></i>':'<i class="fa fa-certificate tx-info mg-r-8"></i>';?>
                         Certificates</strong></a>
                </li>
                <li class="list-group-item rounded-bottom-0" style="<?=($subtitle=="Training Details")?'background: #dc3545;':'';?>">
                  <a href="{{url('agent/edit/otherinfo/'.$agentData->id)}}" class="mg-b-0">
                      
                      <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Training Details")?'color: #fff;':'';?>">
                      <?=($subtitle=="Training Details")?'<i class="fa fa-globe  mg-r-8" style="color:#fff"></i>':'<i class="fa fa-globe tx-info mg-r-8"></i>';?>
                        Training Details</strong></a>
                </li>
                <li class="list-group-item rounded-bottom-0" style="<?=($subtitle=="Activity Log")?'background: #dc3545;':'';?>">
                  <a href="{{url('/agent/activity/log/'.$agentData->id)}}" class="mg-b-0">
                      
                      <strong class="tx-inverse tx-medium" style="<?=($subtitle=="Activity Log")?'color: #fff;':'';?>">
                      <?=($subtitle=="Activity Logs")?'<i class="icon ion-compose  mg-r-8" style="color:#fff"></i>':'<i class="icon ion-compose tx-info mg-r-8"></i>';?>
                        Activity Log</strong></a>
                </li>
               
              </ul>