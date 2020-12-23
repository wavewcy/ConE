@extends('header-footer')

@section('header')
	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/product.jpg);">
		<h2 class="l-text3 t-center" style="color:#888888">
			CHIANGMAI CENTER STEEL
		</h2>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							หมวดหมู่สินค้า
						</h4>

						<ul class="p-b-54">

							<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
								<a href="{{URL::to('/product')}}" class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
									รายการสินค้าทั้งหมด
								</a>
							</div>
							@foreach($groups as $group)
							<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
								<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
									{{$group->gName}}
									<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
									<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
								</h5>
								<div class="dropdown-content dis-none p-t-15 p-b-23">
									@foreach($catagories as $cata)
										@if($group->gID == $cata->gID)
										<form action="{{URL::to('/search')}}" method="post">
										@csrf
											<input type="hidden" name="caID" value="{{$cata->caID}}"/>
											<button class="js-toggle-dropdown-content flex-sb-m cs-pointer s-text8 color0-hov trans-0-4" type="submit" name="name" value="{{$cata->caName}}">{{$cata->caName}}</button>
										</form>
										@endif
									@endforeach
								</div>
							</div>
							@endforeach
						</ul>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<h2 class="l-text9 t-center" style="color:#fcc404">
							รายการสินค้าทั้งหมด
						</h2>

						<div class="s-text8 p-t-5 p-b-5">
							<div class="search-product pos-relative bo4 of-hidden">
								<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="ค้นหาสินค้า...">

								<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
									<i class="fs-12 fa fa-search" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</div>

					<!-- Product -->
					<div class="row">
						@if($caID == null)
							@foreach($products as $pro)
							<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
								<!-- Block2 -->
								<!-- block2-labelnew block2-labelsale -->
								<!-- photo size 720x960 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative">
										<img src="images/{{$pro->tImg}}" alt="IMG-PRODUCT" width="400" height="300">

										<div class="block2-overlay trans-0-4">
											<form action="{{URL::to('/product-detail')}}" method="post" class="block2-btn-addcart w-size1 trans-0-4">
												<!-- Button -->
												@csrf
												<input type="hidden" name="tID" value="{{$pro->tID}}"/>
												<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
													ดูรายละเอียด
												</button>
											</form>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a class="block2-name dis-block s-text3 m-text8 p-b-5">
											{{$pro->tName}}
										</a>

										<!-- <span class="block2-price m-text6 p-r-5">
											Brand
										</span> -->
									</div>
								</div>
							</div>
							@endforeach
						@else
							@foreach($products as $pro)
							@if($caID == $pro->caID)
							<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
								<!-- Block2 -->
								<!-- block2-labelnew block2-labelsale -->
								<!-- photo size 720x960 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative">
										<img src="images/{{$pro->tImg}}" alt="IMG-PRODUCT" width="400" height="300">

										<div class="block2-overlay trans-0-4">
											<form action="{{URL::to('/product-detail')}}" method="post" class="block2-btn-addcart w-size1 trans-0-4">
												<!-- Button -->
												@csrf
												<input type="hidden" name="tID" value="{{$pro->tID}}"/>
												<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
													ดูรายละเอียด
												</button>
											</form>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a class="block2-name dis-block s-text3 p-b-5">
											{{$pro->tName}}
										</a>

										<span class="block2-price m-text6 p-r-5">
											Brand
										</span>
									</div>
								</div>
							</div>
							@endif
							@endforeach
						@endif
						
					</div>

					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div>
				</div>
			</div>
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
	<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
	<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<!-- <script type="text/javascript">
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
	</script> -->

<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/noui/nouislider.min.js"></script>
	<script type="text/javascript">
		/*[ No ui ]
	    ===========================================================*/
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 50, 200 ],
	        connect: true,
	        range: {
	            'min': 50,
	            'max': 200
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]) ;
	    });
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
@endsection