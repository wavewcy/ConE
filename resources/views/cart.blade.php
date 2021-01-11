@extends('header-footer')

@section('header')
	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-01.jpg);">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			@if(session('cart'))
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1" colspan="2">รายการสินค้าในตะกร้าทั้งหมด &nbsp;&nbsp;{{$items_in_cart}} &nbsp;&nbsp;รายการ</th>
						</tr>

						
						@foreach(session('cart') as $id => $product)
							<tr class="table-row">
								<td class="column-1">
									<div class="cart-img-product b-rad-4 o-f-hidden">
										<img src="images/{{$product['pImg']}}" alt="IMG-PRODUCT">
									</div>
								</td>
								<td class="column-2">
									<p class="head-cart">{{$product['pName']}}</p>
									<p>รหัสสินค้า : {{$product['pID']}}</p>
									<p>แบรนด์ : {{$product['pBrand']}}</p>
									<p>ขนาด : {{$product['pSize']}}</p>
									<p>ความหนา : {{$product['pThick']}}</p>
								</td>
								<td class="column-3">
									<div class="flex-w bo5 of-hidden w-size17">
										<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
										</button>
										<input class="size8 m-text18 t-center num-product" type="number" id="qty" name="qty" value="{{$product['quantity']}}">

										<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
										</button>
									</div>
								</td>
								
								<td class="column-4">
									<div class="rs2-select2 rs3-select2 rs4-select2  of-hidden w-size21 m-t-8 m-b-12">
										<p>{{$product['pUnit']}}</p>
									</div>
								</td>
								<td class="column-5" ><a onClick="fncAction1({{$product['pID']}})" class="fa fa-trash fa-2x"></a></td>
							</tr>
						@endforeach				
					</table>					
				</div>
			</div>
			<!-- Total -->
			<div class=" w-size18 p-l-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<div class="forms">
					<ul class="tab-group">
						<li class="tab active"><a href="#จัดส่ง">จัดส่ง</a></li>
						<li class="tab"><a href="#รับเอง">รับเอง</a></li>
					</ul>
					<form action="{{ URL::to('/cart/delivery') }}" id="จัดส่ง">
						<div class="input-field">
							<label for="name">ชื่อ</label>
							<input type="text" name="name" required />
							<label for="addr">ที่อยู่</label> 
							<input type="text" name="addr" required/>
							<label for="phone">เบอร์โทร</label> 
							<input type="tel" name="phone" required/>
							
							<div style="margin-top:30px;" class="size15 trans-0-4">				
								<!-- Button -->
								<button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" id="btn-submit" name="btn-submit">
									ยืนยันขอใบเสนอราคา
								</button>
							</div>
						</div>
					</form>
					<form action="{{ URL::to('/cart/self') }}" id="รับเอง">
						<div class="input-field">
							<label for="name">ชื่อ</label>
							<input type="text" name="name" required />
							<label for="phone">เบอร์โทร</label> 
							<input type="tel" name="phone" required/>
							<div style="margin-top:30px;" class="size15 trans-0-4">				
								<!-- Button -->
								<button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
									ยืนยันขอใบเสนอราคา
								</button>
							</div>
						</div>
					</form>
				</div>

			</div>

			@else
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1" colspan="2">รายการสินค้าในตะกร้าทั้งหมด &nbsp;&nbsp;{{$items_in_cart}} &nbsp;&nbsp;รายการ</th>
						</tr>				
						<tr class="table-row">
							<td class="column-6">
								ยังไม่มีสินค้าในตะกร้า							
							</td>								
						</tr>						
					</table>					
				</div>
			</div>
			@endif
		</div>
	</section>
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
		$(document).ready(function(){
			$('.tab a').on('click', function (e) {
			e.preventDefault();
			
			$(this).parent().addClass('active');
			$(this).parent().siblings().removeClass('active');
			
			var href = $(this).attr('href');
			$('.forms > form').hide();
			$(href).fadeIn(500);
			});
		});

		$(".selection-1").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});

		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect2')
		});

		$("#btn-submit").on('click',function(e){ //also can use on submit
			e.preventDefault(); //prevent submit
			swal({
				title: "Are you sure?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes!",
				cancelButtonText: "Cancel",
				closeOnConfirm: true
			
			}).then(function(value) {
				if (value) {
				$('#จัดส่ง').submit();
				}});
		});

		function fncAction1(pID){
		swal({
			title: "ยืนยันการลบสินค้า",
			text: "คุณต้องการลบสินค้าออกจากตะกร้าใช่หรือไม่",
			icon: "warning",
			buttons: true,
			successMode: true,
			})
			.then((willDelete) => {
			if (willDelete) {
				swal("ลบสินค้าเรียบร้อยแล้ว", {icon: "success"});
				setTimeout(function(){
					window.location.assign("{{URL::to('/cart/delete?pID=')}}"+pID);
				},2000);
			}
		});
		}

	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
@endsection
