@extends('header-footer')

@section('header')

	<h2 class="l-text3 t-center">
		ใบเสนอราคา
	</h2>

    <div class="wrap_menu">
	    <nav class="menu">
			<ul class="main_menu">
                <li>
					<form action="customer" method="get">
						<div class="w-size2 p-t-20">
							<input type="hidden" name="กำลังขอ" class="form-control">
							@if(isset($_GET['กำลังขอ']))
							<button class="manu-noti flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								กำลังขอ
							</button>
							@elseif(isset($_GET['รอยืนยัน']) || isset($_GET['ต่อรองราคา']) || isset($_GET['รอชำระเงิน']))
							<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								กำลังขอ
							</button>
							@else
							<button class="manu-noti flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								กำลังขอ
							</button>
							@endif
						</div>
					</form>
                </li>

                <li>
					<form action="customer" method="get">
						<div class="w-size2 p-t-20">
							<input type="hidden" name="รอยืนยัน" class="form-control">
							@if(isset($_GET['รอยืนยัน']))
							<button class="manu-noti flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								รอยืนยัน
							</button>
							@else
							<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								รอยืนยัน
							</button>
							@endif
						</div>
					</form>
                </li>

                <li>
					<form action="customer" method="get">
						<div class="w-size2 p-t-20">
							<input type="hidden" name="ต่อรองราคา" class="form-control">
							@if(isset($_GET['ต่อรองราคา']))
							<button class="manu-noti flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								ต่อรองราคา
							</button>
							@else
							<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								ต่อรองราคา
							</button>
							@endif
						</div>
					</form>
                </li>

                <li>
					<form action="customer" method="get">
						<div class="w-size2 p-t-20">
							<input type="hidden" name="รอชำระเงิน" class="form-control">
							@if(isset($_GET['รอชำระเงิน']))
							<button class="manu-noti flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								รอชำระเงิน
							</button>
							@else
							<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								รอชำระเงิน
							</button>
							@endif
						</div>
					</form>
                </li>
            </ul>
        </nav>
	</div>

	<!---------------------------status------------------------------------------------->
	@if (isset($_GET['กำลังขอ']))
	<h4 class="l-text10 t-left">
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการขอใบเสนอราคาทั้งหมด &nbsp;&nbsp;{{$count1}}&nbsp;&nbsp;รายการ<br><br>
		</h4>
		<div class="container">

		@if($count1 > 0)
			@foreach($orders as $order)
				@if($order[0]->oStatus == 'อยู่ในระหว่างการขอใบเสนอราคา')
				<div class="card col-md-12 ">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-cart">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p>{{$order[0]->oDate}}</p>
						</div>
						<div class="contentCard col-md-6">
							<p class="head-cart">รายการสินค้า</p>
							<ol>
							@foreach($order as $product)
								@foreach($products as $pro)
									@if($product->pID == $pro->pID)
										<li> {{$pro->tName}} ({{$pro->pBrand}}) {{$pro->pSize}} {{$pro->pThick}} &nbsp;&nbsp; (จำนวน : {{$product->dQuantity}} {{$pro->pUnit}}) </li>
									@endif
								@endforeach
							@endforeach
							</ol>
						</div>

						<div class="contentCard contentCardStatus col-md-3 center">
							<p class="head-card">{{$order[0]->oStatus}}</p>
						</div>
					</div>
				</div>
				@endif
			@endforeach
		@else
			<br>
			<h4 style="color: #BEBEBE;" align="center">ยังไม่มีรายการ</h4>
			<br>
		@endif
		</div>

	<!---------------------------status------------------------------------------------->
	@elseif (isset($_GET['รอยืนยัน']))
		<h4 class="l-text10 t-left">
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการรอยืนยันใบเสนอราคาทั้งหมด &nbsp;&nbsp;{{$count2}}&nbsp;&nbsp;รายการ<br><br>
		</h4>
		<div class="container">
		@if($count2 > 0)
			@foreach($orders as $order)
				@if($order[0]->oStatus == 'รอยืนยันใบเสนอราคา')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p>{{$order[0]->oDate}}</p>
						</div>
						<div class="contentCard col-md-6">
							<p class="head-card">รายการสินค้า</p>
							<ol>
							@foreach($order as $product)
								@foreach($products as $pro)
									@if($product->pID == $pro->pID)
										<li> {{$pro->tName}} ({{$pro->pBrand}}) {{$pro->pSize}} {{$pro->pThick}} &nbsp;&nbsp; (จำนวน : {{$product->dQuantity}} {{$pro->pUnit}}) </li>
									@endif
								@endforeach
							@endforeach
							</ol>
						</div>
						<div class="contentCard contentCardStatus col-md-3 center">
							<p class="head-card">{{$order[0]->oStatus}}<br><a href="#"  role="button" class="btn btn-success" style="margin-left: 12px; margin-top:8px;" >ดูใบเสนอราคา</a></p>							
						
						</div>
						<br>
					</div>
				</div>
				@endif
			@endforeach
		@else
			<br>
			<h4 style="color: #BEBEBE;" align="center">ยังไม่มีรายการ</h4>
			<br>
		@endif
		</div>

	<!---------------------------status------------------------------------------------->
	@elseif (isset($_GET['ต่อรองราคา']))
		<h4 class="l-text10 t-left">
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการต่อรองราคาทั้งหมด &nbsp;&nbsp;{{$count3}}&nbsp;&nbsp;รายการ<br><br>
		</h4>
		<div class="container">
		@if($count3 > 0)
			@foreach($orders as $order)
				@if($order[0]->oStatus == 'อยู่ในระหว่างการต่อรองราคา')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p>{{$order[0]->oDate}}</p>
						</div>
						<div class="contentCard col-md-6">
							<p class="head-card">รายการสินค้า</p>
							<ol>
							@foreach($order as $product)
								@foreach($products as $pro)
									@if($product->pID == $pro->pID)
										<li> {{$pro->tName}} ({{$pro->pBrand}}) {{$pro->pSize}} {{$pro->pThick}} &nbsp;&nbsp; (จำนวน : {{$product->dQuantity}} {{$pro->pUnit}}) </li>
									@endif
								@endforeach
							@endforeach
							</ol>
						</div>
						<div class="contentCard contentCardStatus col-md-3 center">
							<p class="head-card">{{$order[0]->oStatus}}</p>
						</div>
					</div>
				</div>
				@endif
			@endforeach
		@else
			<br>
			<h4 style="color: #BEBEBE;" align="center">ยังไม่มีรายการ</h4>
			<br>
		@endif
		</div>

	<!---------------------------status------------------------------------------------->
	@elseif (isset($_GET['รอชำระเงิน']))
	<h4 class="l-text10 t-left">
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการรอชำระเงินทั้งหมด &nbsp;&nbsp;{{$count}}&nbsp;&nbsp;รายการ<br><br>
	</h4>
	<div class="container">
		@if($count > 0)
			@foreach($orders as $order)
				@if($order[0]->oStatus == 'กำลังตรวจสอบการชำระเงิน')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p>{{$order[0]->oDate}}</p>
						</div>
						<div class="contentCard col-md-6">
							<p class="head-card">รายการสินค้า</p>
							<ol>
							@foreach($order as $product)
								@foreach($products as $pro)
									@if($product->pID == $pro->pID)
										<li> {{$pro->tName}} ({{$pro->pBrand}}) {{$pro->pSize}} {{$pro->pThick}} &nbsp;&nbsp; (จำนวน : {{$product->dQuantity}} {{$pro->pUnit}}) </li>
									@endif
								@endforeach
							@endforeach
							</ol>
						</div>
						<div class="contentCard contentCardStatus col-md-3 center">
							<p class="head-card">{{$order[0]->oStatus}}</p>
						</div>
					</div>
				</div>
				@endif
				@if($order[0]->oStatus == 'รอชำระเงิน')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p>{{$order[0]->oDate}}</p>
						</div>
						<div class="contentCard col-md-6">
							<p class="head-card">รายการสินค้า</p>
							<ol>
							@foreach($order as $product)
								@foreach($products as $pro)
									@if($product->pID == $pro->pID)
										<li> {{$pro->tName}} ({{$pro->pBrand}}) {{$pro->pSize}} {{$pro->pThick}} &nbsp;&nbsp; (จำนวน : {{$product->dQuantity}} {{$pro->pUnit}}) </li>
									@endif
								@endforeach
							@endforeach
							</ol>
						</div>
						<div class="contentCard contentCardStatus col-md-3 center">
							<p class="head-card " style="text-align:center;">{{$order[0]->oStatus}}<br><a href="#"  role="button" class="btn btn-success" style="margin-left: 12px;margin-top:8px;" >ส่งหลักฐานการชำระเงิน</a></p>
						</div>
					</div>
				</div>
				@endif
			@endforeach
		@else
			<br>
			<h4 style="color: #BEBEBE;" align="center">ยังไม่มีรายการ</h4>
			<br>
		@endif
	</div>

	<!---------------------------status------------------------------------------------->
	@else
		<h4 class="l-text10 t-left">
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการขอใบเสนอราคาทั้งหมด &nbsp;&nbsp;{{$count1}}&nbsp;&nbsp;รายการ<br><br>
		</h4>
		<div class="container">

		@if($count1 > 0)
			@foreach($orders as $order)
				@if($order[0]->oStatus == 'อยู่ในระหว่างการขอใบเสนอราคา')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p>{{$order[0]->oDate}}</p>
						</div>
						<div class="contentCard col-md-6">
							<p class="head-card">รายการสินค้า</p>
							<ol>
							@foreach($order as $product)
								@foreach($products as $pro)
									@if($product->pID == $pro->pID)
										<li> {{$pro->tName}} ({{$pro->pBrand}}) {{$pro->pSize}} {{$pro->pThick}} &nbsp;&nbsp; (จำนวน : {{$product->dQuantity}} {{$pro->pUnit}}) </li>
									@endif
								@endforeach
							@endforeach
							</ol>
						</div>
						<div class="contentCard contentCardStatus col-md-3 center">
							<p class="head-card">{{$order[0]->oStatus}}</p>
						</div>
					</div>
				</div>
				@endif
			@endforeach
		@else
			<br>
			<h4 style="color: #BEBEBE;" align="center">ยังไม่มีรายการ</h4>
			<br>
		@endif
		</div>
	@endif
    

    

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