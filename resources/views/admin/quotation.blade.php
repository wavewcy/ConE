@extends('header-footer')

@section('header')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/product.jpg);">
		<h2 class="l-text3 t-center" style="color:#ffffff">
			สร้างใบเสนอราคา
		</h2>
</section>

<div class="limiter">
		
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="contentCard col-md-12 card2" style="margin-bottom:40px;">
					<div class="row">
						<div class="row col-md-8">
							<h4 class="m-text2 p-b-7 col-md-2">
								ชื่อลูกค้า
							</h4>
							<h4 class="m-text2 p-b-7 col-md-6">
								:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order[0]->oShipName}}
							</h4>
						</div>
						<div class="row col-md-4">
							<h4 class="m-text2 p-b-7 col-md-5">
								วันที่
							</h4>
							<h4 class="m-text2 p-b-7 col-md-7">
								:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order[0]->oDate}}
							</h4>
						</div>
						<div class="row col-md-8">
							<h4 class="m-text2 p-b-7 col-md-2">
								ที่อยู่
							</h4>
							<h4 class="m-text2 p-b-7 col-md-6">
								:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order[0]->oShipAddress}}
							</h4>
						</div>
						<div class="row col-md-4">
							<h4 class="m-text2 p-b-7 col-md-5">
								หมายเลขคำสั่งซื้อ
							</h4>
							<h4 class="m-text2 p-b-7 col-md-7">
								:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$order[0]->oID}}
							</h4>
						</div>
					</div>				
				</div>

				<div class="table100">
					<form action="{{ URL::to('/adminQuotation/created') }}" style="width:1400px;">
						<div class="row100 header100">
							<div class="cell100">
								ลำดับ
							</div>
							<div class="cell100">
								สินค้า
							</div>
							<div class="cell100">
								ขนาด
							</div>
							<div class="cell100">
								ความหนา
							</div>
							<div class="cell100">
								น้ำหนัก
							</div>
							<div class="cell100">
								ยี่ห้อ
							</div>
							<div class="cell100">
								จำนวน
							</div>
							<div class="cell100">
								หน่วย
							</div>
							<div class="cell100">
								มีของ
							</div>
							<div class="cell100">
								ราคา/หน่วย
							</div>
							<div class="cell100">
								จำนวนเงิน
							</div>
						</div>
						
							@foreach ($details as $index => $detail)
							<div class="row100">
								<div class="cell100" data-title="number">
									{{$index+1}}
								</div>
								<div class="cell100" data-title="tName">
									{{$detail->tName}}
								</div>
								<div class="cell100" data-title="pSize">
									{{$detail->pSize}}
								</div>
								<div class="cell100" data-title="pThick">
									{{$detail->pThick}}
								</div>
								<div class="cell100" data-title="pWeight">
									{{$detail->pWeight}}
								</div>
								<div class="cell100" data-title="pBrand">
									{{$detail->pBrand}}
								</div>
								<div class="cell100" data-title="dQuantity">
									{{$detail->dQuantity}}
								</div>
								<div class="cell100" data-title="pUnit">
									{{$detail->pUnit}}<br>(จำนวนต่อหน่วย : {{$detail->pUnit}})
								</div>
								
								<div class="cell100" data-title="dOutOfStock">		
									<input id="checkHidden" type="hidden" value='0' name='inStock[{{$index}}]'>					
									<input id="check" class="w3-check" type="checkbox"  value='1' name='inStock[{{$index}}]'>
								</div>
								<div class="cell100" data-title="dPrice">
									<input type='number' class='price w3-input w3-border w3-round' min='0' name='price[]' id='' onchange="fncAction1({{$detail->dQuantity}},{{$index}})">
									<input type="hidden" id="pID" name="pID[]" value="{{$detail->pID}}">
									<input type="hidden" id="qty" name="qty[]" value="{{$detail->dQuantity}}">
								</div>
								
								<div class="total cell100" data-title="total" id="">

								</div>

							</div>
							@endforeach
					
						
						<script>
							var listTotal = document.getElementsByClassName("total");
							var listPrice = document.getElementsByClassName("price");
							for (var i = 0; i < listTotal.length; i++) {
								listTotal[i].setAttribute("id", "total"+ i);
								listPrice[i].setAttribute("id", "price" + i);
							}
						</script>

						<div class="row100">
							<div class="cell100" data-title="number"></div>
							<div class="cell100" data-title="tName"></div>
							<div class="cell100" data-title="pSize"></div>
							<div class="cell100" data-title="pThick"></div>
							<div class="cell100" data-title="pWeight"></div>
							<div class="cell100" data-title="pBrand"></div>
							<div class="cell100" data-title="dQuantity"></div>
							<div class="cell100" data-title="pUnit">ค่าขนส่ง</div>							
							<div class="cell100" data-title="dOutOfStock"></div>
							<div class="cell100" data-title="cost">
								<input type='number' class='w3-input w3-border w3-round' min='0' name='cost' id='cost' onchange="fncAction2()">
							</div>							
							<div class="cell100" data-title="costInner" id="costInner">
								
							</div>
						</div>

						<input type="hidden" id="oID" name="oID" value="{{$order[0]->oID}}">
						
						
					</div>
				
				
				<div class="row col-md-12">
					<div class="col-md-7"></div>
					<div class="contentCard col-md-5 card2" style="margin-bottom:40px;">
						<div class="row">
							<div class="row col-md-12">
								<h4 class="m-text2 p-b-7 col-md-5">
									จำนวนเงินรวมก่อนภาษี
								</h4>
								<h4 class="m-text2 p-b-7 col-md-7" id="amount" style="text-align:right;"></h4>
							</div>
							<div class="row col-md-12">
								<h4 class="m-text2 p-b-7 col-md-5">
									VAT 7%
								</h4>
								<h4 class="m-text2 p-b-7 col-md-7" id="vat" style="text-align:right;"></h4>
							</div>
							<div class="row col-md-12">
								<h4 class="m-text2 p-b-7 col-md-5">
									จำนวนเงินรวมทั้งสิ้น
								</h4>
								<h4 class="m-text28 p-b-7 col-md-7" id="amountVat" style="text-align:right;"></h4>
							</div>
						</div>				
					</div>
				</div>


				<div class="row col-md-12">
					<div class="col-md-6">
						<button type="button" class="flex-c-m sizefull bg1 bo-rad-23 hov8 s-text1 trans-0-4" style="line-height:3;" onClick="javascript:history.go(-1)" >
							กลับ
						</button>
					</div>
					<div class="col-md-6">
						<button type="submit" class="flex-c-m sizefull bg0 bo-rad-23 hov7 s-text2 trans-0-4" style="line-height:3;"id="btn-submit" name="btn-submit" >
							สร้างใบเสนอราคา
						</button>
					</div>
				</div>
				</form>	
			</div>
		</div>
	</div>

@endsection

@section('footer')
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
	<script type="text/javascript">
		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});

		

		function fncAction1(qty,n){
			var price = document.getElementById("price"+n).value;
			totalInner = parseInt(price)*parseInt(qty);
			document.getElementById("total"+n).innerHTML = totalInner;
		
			var listTotal = document.getElementsByClassName("total");
			var amountVat = 0;
			for (var i = 0; i < listTotal.length; i++) {
				var element = parseInt((document.getElementById("total"+(i)).textContent).trim());				
				
				if(Number.isNaN(element)){
					console.log(amountVat);
					console.log(i);
				}
				else {							
					amountVat += element
					console.log(amountVat);
					console.log(i);
				}			
			}		
			var cost = +document.getElementById("cost").value;
			if(cost==null){
					console.log(cost);
				}
			else {							
				amountVat += cost;
				console.log(cost+1);
				console.log(amountVat);
			}	
			document.getElementById("amountVat").innerHTML = amountVat.toFixed(2);
			var vat = (amountVat*7)/107;
			document.getElementById("vat").innerHTML = vat.toFixed(2);
			var amount = amountVat-vat;
			document.getElementById("amount").innerHTML = amount.toFixed(2);
		}

		function fncAction2(){			
			var amountVat = 0;
			var cost = +document.getElementById("cost").value;			
			document.getElementById("costInner").innerHTML = cost;
			if(cost==null){
					console.log(cost);
				}
			else {							
				amountVat += cost;
				console.log(cost+1);
				console.log(amountVat);
			}	

			var listTotal = document.getElementsByClassName("total");
			for (var i = 0; i < listTotal.length; i++) {
				var element = parseInt((document.getElementById("total"+(i)).textContent).trim());		
				
				if(Number.isNaN(element)){
					console.log(amountVat);
					console.log(i);
				}
				else {							
					amountVat += element
					console.log(amountVat);
					console.log(i);
				}			
			}		
			document.getElementById("amountVat").innerHTML = amountVat.toFixed(2);
			var vat = (amountVat*7)/107;
			document.getElementById("vat").innerHTML = vat.toFixed(2);
			var amount = amountVat-vat;
			document.getElementById("amount").innerHTML = amount.toFixed(2);
		}
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/noui/nouislider.min.js"></script>


	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
@endsection
