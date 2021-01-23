@extends('header-footer')

@section('header')

<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- breadcrumb -->
	@foreach($manu as $head)
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="#" class="s-text16">
			หน้าหลัก
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a class="s-text16">
			{{$head->gName}}
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="javascript:history.go(-1)" class="s-text16">
			{{$head->caName}}
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			{{$head->tName}}
		</span>
	</div>
	@endforeach

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
		
			@foreach($data as $info)
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick1">
						<div class="item-slick1" >
							<div class="wrap-pic-w">
								<img src="images/{{$info->tImg}}" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					{{$info->tName}}
				</h4>
				<form class="container" action="{{ URL::to('/product-detail/addToCart') }}" method="post" >
				@csrf
				<div class="p-t-33 p-b-60">

					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							ขนาด
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2 form-control dynamic" name="size" id="size" 
								data-dependent="thick" onchange="FunctionSize(this)">
							<option value="" selected disabled>กรุณาเลือกขนาด</option>
								@foreach($proSize as $size)
								<option value="{{$size[0]->pSize}}">{{$size[0]->pSize}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							ความหนา
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2 form-control dynamic" name="thick" id="thick" 
							data-dependent="unit" onchange="FunctionThick(this)">
							</select>
						</div>
					</div>

					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							หน่วย
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2 form-control" name="unit" id="unit"
							data-dependent="unit" onchange="FunctionUnit(this)">
							</select>
						</div>
					</div>
					
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							ยี่ห้อ
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="selection-2 form-control dynamic" name="brand" id="brand" 
							data-dependent="brand">
							</select>
						</div>
					</div>

					
					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								
								<input class="size8 m-text18 t-center num-product" type="number" name="qty" value="1">
								

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>

							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<!-- <a class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" href="{{ url('/product-detail/addToCart/'.$tID) }}" >
									เพิ่มไปยังตะกร้า
								</a> -->
								<input type="hidden" name="tID" value="{{$tID}}">
								<input class="button flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit" value="เพิ่มไปยังตะกร้า">
							</div>
							
						</div>
					</div>
				</div>
				</form>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						ข้อมูลสินค้า
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							{{$info->info}}
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						ข้อมูลเชิงเทคนิค
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
						{{$info->technicInfo}}
						</p>
					</div>
				</div>
			</div>
			
			@endforeach
		
		</div>
	</div>


	<!-- Relate Product -->


	
@endsection

@section('footer')

<script src="https://www.goragod.com/ajax/gajax.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
// แก้ไขฐานข้อมูลให้ default เป็น ไม่มี....

	function FunctionSize(obj){
		var select = obj.value;
		var products = <?php echo json_encode($products); ?>;
		var resul = [];

		for (var i=0; i< products.length; i++){
			if(select == products[i].pSize){
				resul.push(products[i].pThick);
			}
		}

		var r_thick = Array.from(new Set(resul));
		var t;
		document.getElementById("thick").innerHTML = '<option value="" selected disabled>กรุณาเลือกความหนา</option>'
		for (t of r_thick){
			document.getElementById("thick").innerHTML += '<option value="' + t +'">' + t + '</option>';
		}
	}

	function FunctionThick(obj){
		var select = obj.value;
		var I_size = document.getElementById("size").value;
		var products = <?php echo json_encode($products); ?>;
		var resul = [];
		var p_unit = [];
		var unit = [];
		
		for(var i=0;i< products.length; i++ ){
			if(I_size == products[i].pSize){
				if(select == products[i].pThick){
					resul.push(products[i].pUnit);
					p_unit.push(products[i].pPerUnit);
				}
			}
		}

		for(var i=0;i< resul.length; i++){
			unit.push(resul[i]+" (จำนวนต่อหน่วย :"+p_unit[i]+")");
		}

			var r_unit = Array.from(new Set(unit));
			var u;
			document.getElementById("unit").innerHTML = '<option value="" selected disabled>กรุณาเลือกหน่วย</option>'
			for (u of r_unit){
				document.getElementById("unit").innerHTML += '<option value="' + u +'">' + u + '</option>';
			}
	}

	function FunctionUnit(obj){
		var select = obj.value;
		var I_size = document.getElementById("size").value;
		var I_thick = document.getElementById("thick").value;
		var products = <?php echo json_encode($products); ?>;
		var resul = [];
		var unit = [];

		for(var i=0;i< products.length; i++){
			unit.push(products[i].pUnit+" (จำนวนต่อหน่วย :"+products[i].pPerUnit+")");
		}

		for(var i=0;i< products.length; i++ ){
			if(I_size == products[i].pSize){
				if(I_thick == products[i].pThick){
					if(select == unit[i]){
						resul.push(products[i].pBrand);
					}
				}
			}
		}

		var r_brand = Array.from(new Set(resul));
		var b;
		document.getElementById("brand").innerHTML = '<option value="" selected disabled>กรุณาเลือกแบรนด์</option>'
		for (b of r_brand){
			document.getElementById("brand").innerHTML += '<option value="' + b +'">' + b + '</option>';
		}
	}

</script>

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
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		$('.block2-btn-addwishlist').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");
			});
		});

		$('.btn-addcart-product-detail').each(function(){
			var nameProduct = $('.product-detail-name').html();
			$(this).on('click', function(){
				swal(nameProduct, "เพิ่มไปยังตะกร้าแล้ว", "success");
			});
		});
	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!-- =============================================================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- =============================================================================================== -->


@endsection

