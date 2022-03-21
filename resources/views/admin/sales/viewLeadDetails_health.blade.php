<?php //print_r(json_decode($lead->param));
$param = json_decode($lead->param);?>
<table class="table table-bordered table-condensed table-striped">
    <tbody>
    <tr>
        <th>Name</th>
        <td><?=$lead->name;?></td>
    </tr>
    <tr>
        <th>Mobile Number</th>
        <td><?=$lead->mobile;?></td>
    </tr>
    <tr>
        <th>Proposer Name</th>
        <td><?=(($param->selfFname)?$param->selfFname:'')." ".(($param->selfLname)?$param->selfLname:'');?></td>
    </tr>
    <tr>
        <th>Proposer Name</th>
        <td><?=($param->selfEmail)?$param->selfEmail:'';?></td>
    </tr>
   <?php $state = isset($param->address->state)?explode('-',$param->address->state)[1]:"";
         $city = isset($param->address->city)?explode('-',$param->address->city)[1]:"";?>
    <tr>
        <th>Address Details</th>
        <td><?=$city.",".$state;?></td>
    </tr>
    <tr>
        <th>Insurance For</th>
        <td><?="ADULT:- ".(($param->total_adult)?$param->total_adult:'0')." ,CHILD:-".(($param->total_child)?$param->total_child:'0');?></td>
    </tr>
</tbody></table>