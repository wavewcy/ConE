@extends('header-footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('header')

<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/product.jpg);">
		<h2 class="l-text3 t-center" style="color:#ffffff">
			คำสั่งซื้อ
		</h2>
</section>

    <div class="wrap_menu">
	    <nav class="menu">
			<ul class="main_menu">
                <li>
					<form action="admin" method="get">
						<div class="w-size2 p-t-20">
							<input type="hidden" name="สร้างใบเสนอราคา" class="form-control">
							@if(isset($_GET['สร้างใบเสนอราคา']))
							<button class="manu-noti flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								สร้างใบเสนอราคา
							</button>
							@elseif(isset($_GET['รอยืนยัน']) || isset($_GET['ต่อรองราคา']) || isset($_GET['ชำระเงิน']))
							<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								สร้างใบเสนอราคา
							</button>
							@else
							<button class="manu-noti flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								สร้างใบเสนอราคา
							</button>
							@endif
						</div>
					</form>
                </li>

                <li>
					<form action="admin" method="get">
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
					<form action="admin" method="get">
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
					<form action="admin" method="get">
						<div class="w-size2 p-t-20">
							<input type="hidden" name="ชำระเงิน" class="form-control">
							@if(isset($_GET['ชำระเงิน']))
							<button class="manu-noti flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								ชำระเงิน
							</button>
							@else
							<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">	
								ชำระเงิน
							</button>
							@endif
						</div>
					</form>
                </li>
            </ul>
        </nav>
	</div>

	<!---------------------------status------------------------------------------------->
	@if (isset($_GET['สร้างใบเสนอราคา']))
	<h4 class="l-text10 t-left">
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการขอใบเสนอราคาทั้งหมด &nbsp;&nbsp;{{$count1}}&nbsp;&nbsp;รายการ<br><br>
		</h4>
		<div class="container">

		@if($count1 > 0)
			@foreach($allOrders as $index => $order)
				@if($order[0]->oStatus == 'อยู่ในระหว่างการขอใบเสนอราคา')
				<div class="card col-md-12 ">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-cart">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>							
							<p><i class="fa fa-user"></i> &nbsp;&nbsp;:&nbsp; {{$order[0]->oShipName}}</p>
							<p><i class="fa fa-calendar"></i></i> &nbsp;:&nbsp; {{$order[0]->oDate}}</p>
							<p style="color:red;"><i class="fa fa-hourglass-half" ></i></i> &nbsp;:&nbsp; {{$order[0]->oExp}} &nbsp;
							<?php
								$ts1 = strtotime($order[0]->oExp);
								$ts2 = strtotime(date("Y-m-d"));
								$diff = ($ts1 - $ts2)/3600/24;
								echo "( เหลือ : $diff วัน )"
							?></p><br>
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
							<p align=right style="padding-right: 30px;">
								<input type="hidden" id="create{{$index}}" value="{{$order[0]->oID}}">
								<a id="create{{$index}}" href="#" class="create btn btn-success" style="margin-top:8px;" >สร้างใบเสนอราคา</a>
							</p>
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
			@foreach($orders as $index => $order)
				@if($order[0]->oStatus == 'รอยืนยันใบเสนอราคา')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p><i class="fa fa-user"></i> &nbsp;&nbsp;:&nbsp; {{$order[0]->oShipName}}</p>
							<p><i class="fa fa-calendar"></i></i> &nbsp;:&nbsp; {{$order[0]->oDate}}</p>
							<p style="color:red;"><i class="fa fa-hourglass-half" ></i></i> &nbsp;:&nbsp; {{$order[0]->oExp}} &nbsp;
							<?php
								$ts1 = strtotime($order[0]->oExp);
								$ts2 = strtotime(date("Y-m-d"));
								$diff = ($ts1 - $ts2)/3600/24;
								echo "( เหลือ : $diff วัน )"
							?></p><br>
							<input id="pdf{{$index}}" type="hidden" value="{{$order[0]->oID}}">
							<a id="pdf{{$index}}"  href="#" class="pdf btn btn-warning" style="margin-top:8px;">ดูใบเสนอราคา</a>
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
						<br>
					</div>
				</div>
				@endif
				@if($order[0]->oStatus == 'รอยืนยันการต่อรองราคา')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p><i class="fa fa-user"></i> &nbsp;&nbsp;:&nbsp; {{$order[0]->oShipName}}</p>
							<p><i class="fa fa-calendar"></i></i> &nbsp;:&nbsp; {{$order[0]->oDate}}</p>
							<p style="color:red;"><i class="fa fa-hourglass-half" ></i></i> &nbsp;:&nbsp; {{$order[0]->oExp}} &nbsp;
							<?php
								$ts1 = strtotime($order[0]->oExp);
								$ts2 = strtotime(date("Y-m-d"));
								$diff = ($ts1 - $ts2)/3600/24;
								echo "( เหลือ : $diff วัน )"
							?></p><br>
							<input id="pdf{{$index}}" type="hidden" value="{{$order[0]->oID}}">
							<a id="pdf{{$index}}"  href="#" class="pdf btn btn-warning" style="margin-top:8px;">ดูใบเสนอราคา</a>
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
			@foreach($orders as $index => $order)
				@if($order[0]->oStatus == 'อยู่ในระหว่างการต่อรองราคา')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p><i class="fa fa-user"></i> &nbsp;&nbsp;:&nbsp; {{$order[0]->oShipName}}</p>
							<p><i class="fa fa-calendar"></i></i> &nbsp;:&nbsp; {{$order[0]->oDate}}</p>
							<p style="color:red;"><i class="fa fa-hourglass-half" ></i></i> &nbsp;:&nbsp; {{$order[0]->oExp}} &nbsp;
							<?php
								$ts1 = strtotime($order[0]->oExp);
								$ts2 = strtotime(date("Y-m-d"));
								$diff = ($ts1 - $ts2)/3600/24;
								echo "( เหลือ : $diff วัน )"
							?></p><br>
							<input id="pdf{{$index}}" type="hidden" value="{{$order[0]->oID}}">
							<a id="pdf{{$index}}" href="#" class="pdf btn btn-warning" style="margin-top:8px;">ดูใบเสนอราคา</a>
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
							<p align=right style="padding-right: 30px;">
								<input id="cancel{{$index}}" type="hidden" value="{{$order[0]->oID}}">
								<a id="cancel{{$index}}" href="#" class="cancel btn btn-outline-danger" style="margin-left: 12px; margin-top:8px;" >ปฏิเสธ</a>
								
								<input id="bargain{{$index}}" type="hidden" value="{{$order[0]->oID}}">
								<a id="bargain{{$index}}" href="#" class="bargain btn btn-outline-primary" style="margin-left: 12px; margin-top:8px;" >ต่อรองราคา</a>					
								
								
								<input id="confirm{{$index}}" type="hidden" value="{{$order[0]->oID}}">
								<a id="confirm{{$index}}" href="#" class="confirm btn btn-success" style=" margin-left: 12px; margin-top:8px; cursor:pointer;" >ยืนยันใบเสนอราคา</a>
							</p>
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
	@elseif (isset($_GET['ชำระเงิน']))
	<h4 class="l-text10 t-left">
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการชำระเงินทั้งหมด &nbsp;&nbsp;{{$count}}&nbsp;&nbsp;รายการ<br><br>
	</h4>
	<div class="container">
		@if($count > 0)
			@foreach($orders as $index => $order)
				@if($order[0]->oStatus == 'กำลังตรวจสอบการชำระเงิน')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p><i class="fa fa-user"></i> &nbsp;&nbsp;:&nbsp; {{$order[0]->oShipName}}</p>
							<p><i class="fa fa-calendar"></i></i> &nbsp;:&nbsp; {{$order[0]->oDate}}</p>
							<p style="color:red;"><i class="fa fa-hourglass-half" ></i></i> &nbsp;:&nbsp; {{$order[0]->oExp}} &nbsp;
							<?php
								$ts1 = strtotime($order[0]->oExp);
								$ts2 = strtotime(date("Y-m-d"));
								$diff = ($ts1 - $ts2)/3600/24;
								echo "( เหลือ : $diff วัน )"
							?></p><br>
							<input id="pdf{{$index}}" type="hidden" value="{{$order[0]->oID}}">
							<a id="pdf{{$index}}" href="#" class="pdf btn btn-outline-warning" style="margin-top:8px;">ดูใบเสนอราคา</a>
							<input id="payment{{$index}}" type="hidden" value="{{$order[0]->oID}}">
							<a id="payment{{$index}}" href="#" class="payment btn btn-warning" style="margin-top:8px;">ดูหลักฐานการชำระเงิน</a>
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
							<p align=right style="padding-right: 30px;">
							
								<input type="hidden" id="paymentCancel{{$index}}" value="{{$order[0]->oID}}">
								<a id="paymentCancel{{$index}}"  href="#" class="paymentCancel btn btn-outline-danger" style="margin-top:8px;" >ปฏิเสธ</a>

								<input type="hidden" id="paymentConfirm{{$index}}" value="{{$order[0]->oID}}">
								<a id="paymentConfirm{{$index}}"  href="#" class="paymentConfirm btn btn-success" style="margin-top:8px;" >ยืนยันการชำระเงิน</a>
							</p>
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
							<p><i class="fa fa-user"></i> &nbsp;&nbsp;:&nbsp; {{$order[0]->oShipName}}</p>
							<p><i class="fa fa-calendar"></i></i> &nbsp;:&nbsp; {{$order[0]->oDate}}</p>
							<p style="color:red;"><i class="fa fa-hourglass-half" ></i></i> &nbsp;:&nbsp; {{$order[0]->oExp}} &nbsp;
							<?php
								$ts1 = strtotime($order[0]->oExp);
								$ts2 = strtotime(date("Y-m-d"));
								$diff = ($ts1 - $ts2)/3600/24;
								echo "( เหลือ : $diff วัน )"
							?></p><br>
							
							<input id="pdf{{$index}}" type="hidden" value="{{$order[0]->oID}}">
							<a id="pdf{{$index}}" href="#" class="pdf btn btn-warning" style="margin-top:8px;">ดูใบเสนอราคา</a>
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
	@else
		<h4 class="l-text10 t-left">
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รายการขอใบเสนอราคาทั้งหมด &nbsp;&nbsp;{{$count1}}&nbsp;&nbsp;รายการ<br><br>
		</h4>
		<div class="container">

		@if($count1 > 0)
			@foreach($allOrders as $index => $order)
				@if($order[0]->oStatus == 'อยู่ในระหว่างการขอใบเสนอราคา')
				<div class="card col-md-12">
					<div class="row">
						<div class="contentCard contentCardOrder col-md-3">
							<p class="head-card">ออเดอร์เลขที่ : {{$order[0]->oID}}</p>
							<p><i class="fa fa-user"></i> &nbsp;&nbsp;:&nbsp; {{$order[0]->oShipName}}</p>
							<p><i class="fa fa-calendar"></i></i> &nbsp;:&nbsp; {{$order[0]->oDate}}</p>
							<p style="color:red;"><i class="fa fa-hourglass-half" ></i></i> &nbsp;:&nbsp; {{$order[0]->oExp}} &nbsp;
							<?php
								$ts1 = strtotime($order[0]->oExp);
								$ts2 = strtotime(date("Y-m-d"));
								$diff = ($ts1 - $ts2)/3600/24;
								echo "( เหลือ : $diff วัน )"
							?></p><br>
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
							<p align=right style="padding-right: 30px;">
								<input type="hidden" id="create{{$index}}" value="{{$order[0]->oID}}">
								<a id="create{{$index}}" href="#" class="create btn btn-success" style="margin-top:8px;cursor:pointer;" >สร้างใบเสนอราคา</a>
							</p>
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

		$(".create").on('click', function() {
    		oID = document.getElementById(this.id).value;
			console.log(oID);
			window.location.assign("{{URL::to('/adminQuotation?oID=')}}"+oID);
		});

		$(".bargain").on('click', function() {
			oID = document.getElementById(this.id).value;
			window.location.assign("{{URL::to('/adminQuotation?oID=')}}"+oID);
		});

		$(".cancel").on('click', function() {
			Swal.fire({
				title: 'ต้องการปฏิเสธการต่อรองราคานี้?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonText: 'ยกเลิก',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน'
				}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
					'ปฏิเสธแล้ว!',
					'',
					'success'
					)
					oID = document.getElementById(this.id).value;
					window.location.assign("{{URL::to('/adminQuotation/cancel?oID=')}}"+oID);
				}
			});
		});

		$(".confirm").on('click', function() {
			Swal.fire({
				title: 'ต้องการยืนยันการต่อรองราคานี้?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonText: 'ยกเลิก',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน'
				}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
					'ยืนยันสำเร็จ!',
					'',
					'success'
					)
					oID = document.getElementById(this.id).value;
					window.location.assign("{{URL::to('/adminQuotation/confirm?oID=')}}"+oID);
				}
			});
		});

		$(".paymentCancel").on('click', function() {
			Swal.fire({
				title: 'ต้องการปฏิเสธการชำระเงินนี้?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonText: 'ยกเลิก',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน'
				}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
					'ปฏิเสธแล้ว!',
					'',
					'success'
					)
					oID = document.getElementById(this.id).value;
					window.location.assign("{{URL::to('/adminQuotation/paymentCancel?oID=')}}"+oID);
				}
			});
		});

		$(".paymentConfirm").on('click', function() {
			Swal.fire({
				title: 'ต้องการยืนยันการชำระเงินนี้?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonText: 'ยกเลิก',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน'
				}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire(
					'ยืนยันสำเร็จ!',
					'',
					'success'
					)
					oID = document.getElementById(this.id).value;
					window.location.assign("{{URL::to('/adminQuotation/paymentConfirm?oID=')}}"+oID);
				}
			});
		});

		$(".pdf").on('click', function() {
			oID = document.getElementById(this.id).value;
			window.location.assign("{{URL::to('/pdf?oID=')}}"+oID);
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