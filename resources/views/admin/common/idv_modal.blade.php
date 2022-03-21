<style>
    .slider-color {
      -webkit-appearance: none;
      width: 100%;
      height: 6px;
      border-radius: 3px;
      background: #294b7c;
      outline: none;
      opacity:1;
      -webkit-transition: opacity .15s ease-in-out;
      transition: opacity .15s ease-in-out;
    }
    .slider-color:hover {
      opacity:1;
    }
    .slider-color::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #ac0f0a;
      cursor: pointer;
    }
    .slider-color::-moz-range-thumb {
      width: 20px;
      height: 20px;
      border: 0;
      border-radius: 50%;
      background: #ac0f0a;
      cursor: pointer;
    }
  
.table-idv tr td,.table-idv tr th{
      border: 1px solid #ac0f09;
   vertical-align: middle;
}

.table-idv tr th{
    font-size: 12px;
    font-weight: 400;
    text-align:center;
    padding:5px;
}
.table-idv tr th .min-idv,.table-idv tr th .max-idv{
    color:#ac0f0a; 
    font-weight: 600;
}
.idv-popup .inputGroup {
	 background-color: #b9b9b9;
	 display: block;
	 margin: 10px 0;
	 position: relative;
}
.idv-popup .inputGroup label {
	 padding: 12px 30px;
	 width: 100%;
	 display: block;
	 text-align: left;
	 color: #3c454c;
	 cursor: pointer;
	 position: relative;
	 z-index: 2;
	 transition: color 200ms ease-in;
	 overflow: hidden;
}
.idv-popup .inputGroup label:before {
	 width: 10px;
	 height: 10px;
	 border-radius: 50%;
	 content: '';
	 background-color: #294b7c;
	 position: absolute;
	 left: 50%;
	 top: 50%;
	 transform: translate(-50%, -50%) scale3d(1, 1, 1);
	 transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
	 opacity: 0;
	 z-index: -1;
}
 .idv-popup .inputGroup label:after {
	 width: 32px;
	 height: 32px;
	 content: '';
	 border: 2px solid #d1d7dc;
	 background-color: #fff;
	 background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
	 background-repeat: no-repeat;
	 background-position: 2px 3px;
	 border-radius: 50%;
	 z-index: 2;
	 position: absolute;
	 right: 10px;
	 top: 50%;
	 transform: translateY(-50%);
	 cursor: pointer;
	 transition: all 200ms ease-in;
}
.idv-popup .inputGroup input:checked ~ label {
	 color: #fff;
}
.idv-popup .inputGroup input:checked ~ label:before {
	 transform: translate(-50%, -50%) scale3d(56, 56, 1);
	 opacity: 1;
}
.idv-popup .inputGroup input:checked ~ label:after {
	    background-color: #ac0f09;
    border-color: #ac0f09;
}
.idv-popup .inputGroup input {
	 width: 32px;
	 height: 32px;
	 order: 1;
	 z-index: 2;
	 position: absolute;
	 right: 30px;
	 top: 50%;
	 transform: translateY(-50%);
	 cursor: pointer;
	 visibility: hidden;
}
#inputIdvValue{
    font-weight: 700;
}

.note{
    border: 1px dashed #ac0f09;
    padding: 6px;
    font-size: 12px;
    background: #ac0f0945;
    color: #ac0f09;
}
.note p{
        margin-bottom: 1px;
}
#error-text{
    color:red;
        font-size: 11px;
}

.btn-update-idv{
    width: 100%;
    padding: 8px;
    background: #ac0f09;
    color: #fff;
    font-size: 13px;
    font-weight: 800;
    text-shadow: unset;
}
.btn-update-idv:hover,.btn-update-idv:active{
    background: #d61811;
    color: #fff;
}
 </style>
<div class="idv-popup">
    <div class="row" style="margin-top: 25px;">
        <div class="col-md-12">
            <table class="table table-idv">
                    <tbody>
                        <tr>
                            <th style="width:20%">Min Idv<br/><span class="min-idv"><?=$idv->minval;?></span></th>
                            <th style="width:60%"><input type="range" min="<?=$idv->minval;?>" max="<?=$idv->maxval;?>" value="<?=$idv->maxval;?>" class="slider-color" id="idvRange"></th>
                            <th style="width:20%"> Max Idv<br/><span class="max-idv"><?=$idv->maxval;?></span></th>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="inputGroup">
                <input id="idvlowest" class="idvRadio" value="LOWEST" name="idvRadio" type="radio" checked/>
                <label for="idvlowest">Set As lowest price</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="inputGroup ">
                <input id="idvown" class="idvRadio" value="OWN" name="idvRadio" type="radio"/>
                <label for="idvown">Set your own idv price</label>
           </div>
       </div>
       <div class="col-md-4"></div>
       <div class="col-md-4">
           <div class="form-group">
                <input type="text" name="inputIdvValue" id="inputIdvValue" class="form-control number-only" placeholder="" value="<?=$idv->minval;?>">
                 <span id="error-text"></span>
            </div>
            
       </div>
       <div class="col-md-4">
           <button class="btn btn-update-idv">UPDATE IDV</button>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="note"><p>Your IDV should be 10% less than Previous Year Policy or as per depreciation norms of Indian Motor Tariff. Insurers consider the same during payment of a Total loss claim.</p></div>
        </div>
        
    </div>
</div>

<?php if($typ=="BIKE"){?>
<script>
    var bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
    if(bikeInfo.idv!=null){
        if(bikeInfo.idv.isLowest=="YES"){
            $('#idvlowest').prop('checked',true);
            $('#idvown').prop('checked',false);
            $('#idvRange').val($('#idvRange').attr('min'))
            $('#inputIdvValue').val($('#idvRange').attr('min'))
        }else{
            $('#idvlowest').prop('checked',false);
            $('#idvown').prop('checked',true);
            $('#idvRange').val(bikeInfo.idv.value)
            $('#inputIdvValue').val(bikeInfo.idv.value)
        }
    }else{
        
       bikeInfo.idv = {isLowest:"YES",value:$('#idvRange').attr('min')} ;
       localStorage.setItem("bikeInfo", JSON.stringify(bikeInfo));
           
    }
     bikeInfo = JSON.parse(localStorage.getItem('bikeInfo'));
 </script>
<?php } ?>
 
<?php if($typ=="CAR"){?>
 <script>
    var carInfo = JSON.parse(localStorage.getItem('carInfo'));
    if(carInfo.idv!=null){
        if(carInfo.idv.isLowest=="YES"){
            $('#idvlowest').prop('checked',true);
            $('#idvown').prop('checked',false);
            $('#idvRange').val($('#idvRange').attr('min'))
            $('#inputIdvValue').val($('#idvRange').attr('min'))
        }else{
            $('#idvlowest').prop('checked',false);
            $('#idvown').prop('checked',true);
            $('#idvRange').val(carInfo.idv.value)
            $('#inputIdvValue').val(carInfo.idv.value)
        }
    }else{
        
       carInfo.idv = {isLowest:"YES",value:$('#idvRange').attr('min')} ;
       localStorage.setItem("carInfo", JSON.stringify(carInfo));
           
    }
    carInfo = JSON.parse(localStorage.getItem('carInfo'));
</script>
<?php } ?>
<?php if($typ=="BUS"){?>
<script>
    var busInfo = JSON.parse(localStorage.getItem('busInfo'));
    if(busInfo.idv!=null){
        if(busInfo.idv.isLowest=="YES"){
            $('#idvlowest').prop('checked',true);
            $('#idvown').prop('checked',false);
            $('#idvRange').val($('#idvRange').attr('min'))
            $('#inputIdvValue').val($('#idvRange').attr('min'))
        }else{
            $('#idvlowest').prop('checked',false);
            $('#idvown').prop('checked',true);
            $('#idvRange').val(busInfo.idv.value)
            $('#inputIdvValue').val(busInfo.idv.value)
        }
    }else{
        
       busInfo.idv = {isLowest:"YES",value:$('#idvRange').attr('min')} ;
       localStorage.setItem("busInfo", JSON.stringify(busInfo));
           
    }
    busInfo = JSON.parse(localStorage.getItem('busInfo'));
</script>
<?php } ?>

<?php if($typ=="TAXI"){?>
 <script>
    var taxiInfo = JSON.parse(localStorage.getItem('taxiInfo'));
    if(taxiInfo.idv!=null){
        if(taxiInfo.idv.isLowest=="YES"){
            $('#idvlowest').prop('checked',true);
            $('#idvown').prop('checked',false);
            $('#idvRange').val($('#idvRange').attr('min'))
            $('#inputIdvValue').val($('#idvRange').attr('min'))
        }else{
            $('#idvlowest').prop('checked',false);
            $('#idvown').prop('checked',true);
            $('#idvRange').val(taxiInfo.idv.value)
            $('#inputIdvValue').val(taxiInfo.idv.value)
        }
    }else{
       taxiInfo.idv = {isLowest:"YES",value:$('#idvRange').attr('min')} ;
       localStorage.setItem("carInfo", JSON.stringify(taxiInfo));
    }
    taxiInfo = JSON.parse(localStorage.getItem('taxiInfo'));
    </script>
<?php } ?>

<?php if($typ=="TRACTOR"){?>
<script>
    var tractorInfo = JSON.parse(localStorage.getItem('tractorInfo'));
    if(tractorInfo.idv!=null){
        if(tractorInfo.idv.isLowest=="YES"){
            $('#idvlowest').prop('checked',true);
            $('#idvown').prop('checked',false);
            $('#idvRange').val($('#idvRange').attr('min'))
            $('#inputIdvValue').val($('#idvRange').attr('min'))
        }else{
            $('#idvlowest').prop('checked',false);
            $('#idvown').prop('checked',true);
            $('#idvRange').val(tractorInfo.idv.value)
            $('#inputIdvValue').val(tractorInfo.idv.value)
        }
    }else{
       tractorInfo.idv = {isLowest:"YES",value:$('#idvRange').attr('min')} ;
       localStorage.setItem("carInfo", JSON.stringify(tractorInfo));
    }
    tractorInfo = JSON.parse(localStorage.getItem('tractorInfo'));
</script>
<?php } ?>

<?php if($typ=="GOODS"){?>
  <script>
    var goodsInfo = JSON.parse(localStorage.getItem('goodsInfo'));
    if(goodsInfo.idv!=null){
        if(busInfo.idv.isLowest=="YES"){
            $('#idvlowest').prop('checked',true);
            $('#idvown').prop('checked',false);
            $('#idvRange').val($('#idvRange').attr('min'))
            $('#inputIdvValue').val($('#idvRange').attr('min'))
        }else{
            $('#idvlowest').prop('checked',false);
            $('#idvown').prop('checked',true);
            $('#idvRange').val(goodsInfo.idv.value)
            $('#inputIdvValue').val(goodsInfo.idv.value)
        }
    }else{
       goodsInfo.idv = {isLowest:"YES",value:$('#idvRange').attr('min')} ;
       localStorage.setItem("carInfo", JSON.stringify(goodsInfo));
    }
    goodsInfo = JSON.parse(localStorage.getItem('goodsInfo'));
    </script>
<?php } ?>

<script>

var slider = document.getElementById("idvRange");
var input = $("#inputIdvValue");
//input.innerHTML = slider.value; // Display the default slider value


slider.oninput = function() {
  input.val(this.value) ;
  if(this.value==this.min){
    $("#idvlowest").prop("checked", true);
    $("#idvown").prop("checked", false);
  }else{
      $("#idvlowest").prop("checked", false);
      $("#idvown").prop("checked", true);
  }
}
</script>