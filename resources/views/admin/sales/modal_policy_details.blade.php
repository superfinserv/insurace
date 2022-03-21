	<?php $pro =  json_decode($res->product_info);
	      $pre =  json_decode($res->premium_info);
	?>
	<div class="table-responsive">
		<table class="table table-border">
			<tbody>
			     
				 <tr>
					<td style="width:40%;" class="text-primary">Policy No</td>
					<td style="width:60%;">{{$res->policy_no}}</td>
				</tr>
				<tr>
					<td style="width:40%;" class="text-primary">Transaction No</td>
					<td style="width:60%;">{{$res->transaction_no}}</td>
				</tr>
				<?php   $supplier  =  ($res->provider)?DB::table("our_partners")->where('shortName','=',$res->provider)->value('name'):"<span class='text-danger'>Not available</span>";?>
				<tr>
					<td style="width:40%;" class="text-primary">Insurer</td>
					<td style="width:60%;">{{$supplier}}</td>
				</tr>
				<?php if(isset($pro->title)){?>
				<tr>
					<td style="width:40%;" class="text-primary">Product</td>
					<td style="width:60%;"><a href="#" class="tx-info tx-12">{{$pro->title}}({{$pro->code}})</a></td>
				</tr>
				<?php } ?>
				 <tr>
					<td style="width:40%;" class="text-primary">Date</td>
					<td style="width:60%;">{{date("jS M Y", strtotime($res->date))}}</td>
				</tr>
				
				<tr>
					<td style="width:40%;" class="text-primary">Sum Insured</td>
					<td style="width:60%;">{{$res->sumInsured}} Lakh</td>
				</tr>
				<tr>
					<td style="width:40%;" class="text-primary">Policy Term</td>
					<td style="width:60%;">{{$res->termYear}} Year</td>
				</tr>
					<?php if(isset($pro->title)){?>
				<tr>
					<td style="width:40%;" class="text-primary">Addons</td>
					<td style="width:60%;">
					    <?php  if(!empty($pre->Addons)){
					        foreach($pre->Addons as $addon){ ?>
					           <a href="#" class="tx-info tx-12">{{$addon->title}}(₹{{$addon->premium}})</a><br/> 
					       <?php };
					    }else{ echo "No addons selcted";} ?>
					    </td>
				</tr>
				<?php } ?>
				<tr>
					<td style="width:40%;" class="text-primary">Amount Paid</td>
					<td style="width:60%;">₹{{$res->amount}}</td>
				</tr>
				<?php if(isset($pro->title)){?>
				<tr>
					<td style="width:40%;" class="text-primary">Zone</td>
					<td style="width:60%;"><a href="#">{{$pro->zone}}</a></td>
				</tr>
				
				
				
				<?php } ?>
				
				@if($res->ecard)
				<tr>
					<td style="width:40%;" class="text-primary">eCard</td>
					<td style="width:60%;"><a href="{{url('/get/download/file/policy-ecard/'.$res->ecard)}}">Download</a></td>
				</tr>
				@endif
				@if($res->proposal)
				<tr>
					<td style="width:40%;" class="text-primary">Proposal</td>
					<td style="width:60%;"><a href="{{url('/get/download/file/policy-proposal/'.$res->proposal)}}">Download</a></td>
				</tr>
				@endif
			</tbody>
		</table>
	</div>