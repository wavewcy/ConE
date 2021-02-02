<!DOCTYPE html>
<html lang="en">
<head>
	<title>เชียงใหม่เซ็นเตอร์สตีล</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- header fixed -->
	<div class="wrap_header fixed-header2 trans-0-4">
		<!-- Logo -->
		<a href="index.html" class="logo">
			<img src="images/icons/logo.png" alt="IMG-LOGO">
		</a>

		<!-- Menu -->
		<div class="wrap_menu">
			<nav class="menu">
				<ul class="main_menu">
					<li>
						<a href="{{ url('/product') }}">หน้าหลัก</a>
					</li>


					<li>
						<a href="#">เกี่ยวกับเรา</a>
					</li>

					<li>
						<a href="#">ติดต่อเรา</a>
					</li>
				</ul>
			</nav>
		</div>

		<!-- Header Icon -->
		<div class="header-icons">
		@if (Auth::check())
					<ul class="main_menu">
						<li>
							<a href="#" class="header-wrapicon1 dis-block m-l-30">
							<span class="topbar-email" >
								{{Auth::user()->email}}
								&nbsp; &nbsp;</span>
								<span class="topbar-email">
								<i class="fa fa-user-circle-o fa-2x"></i>
								&nbsp;
								<i class="fa fa-caret-down fa-2x"></i>
							</span>
							</a>
								<ul class="sub_menu">
								@if( Auth::user()->status == 'ลูกค้า')
									<li><a href="{{URL::to('/customer')}}">รายการคำสั่งซื้อ</a></li>
									<li><a href="{{URL::to('/history')}}">ประวัติคำสั่งซื้อ</a></li>
								@endif
								@if( Auth::user()->status == 'admin')
									<li><a href="{{URL::to('/admin')}}">จัดการคำสั่งซื้อ</a></li>
								@endif
									<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                     		document.getElementById('logout-form').submit();">Logout</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                           @csrf
										</form>
									</li>
								</ul>
						</li>
					</ul>
				@else
				
					<span class="header-wrapicon1 dis-block m-l-30 topbar-email" >
						<a href="{{URL::to('/login')}}" class="">Log in</a>
						/
						<a href="{{URL::to('/register')}}" class="">Register</a>
					</span>
				@endif

			<span class="linedivide1"></span>

			<div class="header-wrapicon2">
				<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
				<span class="header-icons-noti">{{$items_in_cart}}</span>

				<!-- Header cart noti -->
				<div class="header-cart header-dropdown">							
					<ul class="header-cart-wrapitem">
						@if(session('cart'))				
							@foreach(session('cart') as $id => $product)
								<li class="header-cart-item">
									<div class="header-cart-item-img">
										<img src="images/{{$product['pImg']}}" alt="IMG">
									</div>
									<div class="header-cart-item-txt">
										<a href="#" class="header-cart-item-name">
											{{$product['pName']}}
										</a>
										<span class="header-cart-item-info">
											รหัสสินค้า : {{$product['pID']}}
											ยี่ห้อ : {{$product['pBrand']}}
											ขนาด : {{$product['pSize']}}
											ความหนา : {{$product['pThick']}}
											จำนวน : {{$product['quantity']}}
										</span>
									</div>
								</li>
							@endforeach							
						@else							
							<li class="header-cart-item">
								<div class="header-cart-item-txt">
									<span class="header-cart-item-info">
										ยังไม่มีสินค้าในตะกร้า
									</span>
								</div>
							</li>	
						@endif
						<div class="header-cart-buttons">
								<!-- Button -->
								<a href="{{ url('/cart') }}" class="m-b-10 flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
									ดูตะกร้า
								</a>
						</div>	
					</ul>	
				</div>	
			</div>
		</div>
	</div>

	<!-- Header -->
	<header class="header2">
	<!-- Header desktop -->
	<div class="container-menu-header-v2 p-t-26">
		<div class="topbar2">
			<div class="topbar-social">
				<a href="#" class="topbar-social-item fa fa-phone"></a>
				<a href="#" class="topbar-social-item fa fa-envelope"></a>
				<a href="#" class="topbar-social-item fa fa-facebook"></a>
			</div>

			<!-- Logo2 -->
			<a href="index.html" class="logo2">
				<img src="images/icons/logo.png" alt="IMG-LOGO">
			</a>
		
			<div class="topbar-child2">
				<!-- <span class="topbar-email">
					fashe@example.com
				</span> -->

				<!--  -->
				<div class="topbar-language rs1-select2">
				@if (Auth::check())
					<ul class="main_menu">
						<li>
							<a href="#" class="header-wrapicon1 dis-block m-l-30">
							<span class="topbar-email" >
								{{Auth:: user()->email}}
								&nbsp; &nbsp;</span>
								<span class="topbar-email">
								<i class="fa fa-user-circle-o fa-2x"></i>
								&nbsp;
								<i class="fa fa-caret-down fa-2x"></i>
							</span>
							</a>
								<ul class="sub_menu">
								@if( Auth::user()->status == 'ลูกค้า')
									<li><a href="{{URL::to('/customer')}}">รายการคำสั่งซื้อ</a></li>
									<li><a href="{{URL::to('/history')}}">ประวัติคำสั่งซื้อ</a></li>
								@endif
								@if( Auth::user()->status == 'admin')
									<li><a href="{{URL::to('/admin')}}">จัดการคำสั่งซื้อ</a></li>
								@endif
									<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                     		document.getElementById('logout-form').submit();">Logout</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                           @csrf
										</form>
									</li>
								</ul>
						</li>
					</ul>
				@else
				
					<span class="header-wrapicon1 dis-block m-l-30 topbar-email" >
						<a href="{{URL::to('/login')}}" class="">Log in</a>
						/
						<a href="{{URL::to('/register')}}" class="">Register</a>
					</span>
				@endif
				</div>

				<span class="linedivide1"></span>

				<div class="header-wrapicon2 m-r-13">
					<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
					<span class="header-icons-noti">{{$items_in_cart}}</span>

					<!-- Header cart noti -->
					<div class="header-cart header-dropdown">							
						<ul class="header-cart-wrapitem">
							@if(session('cart'))				
								@foreach(session('cart') as $id => $product)
									<li class="header-cart-item">
										<div class="header-cart-item-img">
											<img src="images/{{$product['pImg']}}" alt="IMG">
										</div>
										<div class="header-cart-item-txt">
											<a href="#" class="header-cart-item-name">
												{{$product['pName']}}<br />												
												{{$product['pBrand']}} {{$product['pSize']}} {{$product['pThick']}}
											</a>
											<span class="header-cart-item-info">
												จำนวน : {{$product['quantity']}} {{$product['pUnit']}}<br />
											</span>
										</div>
									</li>
								@endforeach					
							@else					
								<li class="header-cart-item">
									<div class="header-cart-item-txt">
										<span class="header-cart-item-info">
											ยังไม่มีสินค้าในตะกร้า
										</span>
									</div>
								</li>	
							@endif
							<div class="header-cart-buttons">
									<!-- Button -->
									<a href="{{ url('/cart') }}" class="m-b-10 flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										ดูตะกร้า
									</a>
							</div>	
						</ul>	
					</div>
				</div>
			</div>
		</div>

		<div class="wrap_header">

			<!-- Menu -->
			<div class="wrap_menu">
				<nav class="menu">
					<ul class="main_menu">
						<li>
							<a href="{{ url('/product') }}">หน้าหลัก</a>
						</li>


						<li>
							<a href="#">เกี่ยวกับเรา</a>
						</li>

						<li>
							<a href="#">ติดต่อเรา</a>
						</li>
					</ul>
				</nav>
			</div>

			<!-- Header Icon -->
			<div class="header-icons">

			</div>
		</div>
	</div>
	</header>
@yield('header')


	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="flex-w p-b-90">
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
				<h4 class="s-text12 p-b-30">
					เกี่ยวกับเรา
				</h4>

				<div>
					<p class="s-text7 w-size27">
						บริษัท เชียงใหม่เซ็นเตอร์สตีล จำกัด มีทั้งขายส่งและขายปลีก และมีบริการส่งสินค้าถึงหน้างานทั่วเขตภาคเหนทอตอนบน ทั้งหมด 8 จังหวัด ได้แก่ เชียงใหม่ เชียงราย พะเยา ลำพูน ลำปาง แม่ฮ่องสอน แพร่ น่าน
					</p>

					<!-- <div class="flex-m p-t-30">
						<a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
						<a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
					</div> -->
				</div>
			</div>

			
			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					ติดต่อเรา
				</h4>

				<ul>
					<div class="p-b-9">
						<a href="#" class="s-text7">
							<i class="fa fa-building fa-lg"></i></i> &nbsp;&nbsp;&nbsp;บริษัท เชียงใหม่เซ็นเตอร์สตีล จำกัด
						</a>
					</div>

					<div class="p-b-9">
						<a href="#" class="s-text7">
							<i class="fa fa-map-marker fa-lg"></i> &nbsp;&nbsp;&nbsp;&nbsp;176 ม.8 ต.หนองจ๊อม อ.สันทราย จ.เชียงใหม่ 50210
						</a>
					</div>

					<div class="p-b-9">
						<a href="#" class="s-text7">
							<i class="fa fa-phone fa-lg"></i> &nbsp;&nbsp;&nbsp;053-345436
						</a>
					</div>

					<div class="p-b-9">
						<a href="#" class="s-text7">
							<i class="fa fa-fax fa-lg"></i> &nbsp;&nbsp;053-345437
						</a>
					</div>

					<div class="p-b-9">
						<a href="#" class="s-text7">
							<i class="fa fa-envelope fa-lg"></i> &nbsp;&nbsp;chiangmaicentersteel@hotmail.co.th
						</a>
					</div>

					<div class="p-b-9">
						<a href="#" class="s-text7">
							<i class="fa fa-facebook fa-lg"></i> &nbsp;&nbsp;&nbsp;&nbsp;https://www.facebook.com.chiangmaicenter.steel
						</a>
					</div>
				</ul>
			</div>

			<div class="w-size6 p-t-30 p-l-15 p-r-15 respon4">
				<h4 class="s-text12 p-b-30">
					จดหมายข่าวสาร
				</h4>

				<form>
					<div class="effect1 w-size9">
						<input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
						<span class="effect1-line"></span>
					</div>

					<div class="w-size2 p-t-20">
						<!-- Button -->
						<button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
							ติดตาม
						</button>
					</div>

				</form>
			</div>
		</div>

	</footer>



	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>
	<div id="dropDownSelect2"></div>

	<!-- Modal Video 01-->
	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-dialog" role="document" data-dismiss="modal">
			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

			<div class="wrap-video-mo-01">
				<div class="w-full wrap-pic-w op-0-0"><img src="images/icons/video-16-9.jpg" alt="IMG"></div>
				<div class="video-mo-01">
					<iframe src="https://www.youtube.com/embed/Nt8ZrWY2Cmk?rel=0&amp;showinfo=0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
@yield('footer')
    