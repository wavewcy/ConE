
@extends('header-footer')

@section('header')
	<!-- top noti -->
	<div class="flex-c-m size22 bg0 s-text21 pos-relative">
		ลดพิเศษ 20%  &nbsp;
		<a href="{{URL::to('/product')}}" class="s-text22 hov6 p-l-5">
			สั่งซื้อตอนนี้
		</a>

		<button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
			<i class="fa fa-remove fs-13" aria-hidden="true"></i>
		</button>
	</div>

	<!-- Slide1 -->
	<section class="slide1">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1 item1-slick1" style="background-image: url(images/master-slide-05.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
							จำหน่ายเหล็กทุกชนิด
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
							เหล็กเส้น เหล็กรูปพรรณ ไวร์เมช ทับหลัง กล่องเกเบี้ยน กล่องแมทเทรส
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
							<!-- Button -->
							<a href="{{URL::to('/product')}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								สั่งซื้อตอนนี้
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item2-slick1" style="background-image: url(images/master-slide-03.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rollIn">
							จำหน่ายเหล็กทุกชนิด
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="lightSpeedIn">
							เหล็กเส้น เหล็กรูปพรรณ ไวร์เมช ทับหลัง กล่องเกเบี้ยน กล่องแมทเทรส
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="slideInUp">
							<!-- Button -->
							<a href="{{URL::to('/product')}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								สั่งซื้อตอนนี้
							</a>
						</div>
					</div>
				</div>

				<div class="item-slick1 item3-slick1" style="background-image: url(images/master-slide-01.jpg);">
					<div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
						<h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="rotateInDownLeft">
							จำหน่ายเหล็กทุกชนิด
						</h2>

						<span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="rotateInUpRight">
							เหล็กเส้น เหล็กรูปพรรณ ไวร์เมช ทับหลัง กล่องเกเบี้ยน กล่องแมทเทรส
						</span>

						<div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="rotateIn">
							<!-- Button -->
							<a href="{{URL::to('/product')}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
								สั่งซื้อตอนนี้
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Banner -->
	<div class="banner bgwhite p-t-40 p-b-40">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="images/banner-05.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<form action="{{URL::to('/searchGroup')}}" method="post">
							@csrf
								<input type="hidden" name="gID" value="G0007"/>
								<button href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
									เหล็กรูป
								</button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="images/banner-03.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<form action="{{URL::to('/searchGroup')}}" method="post">
							@csrf
								<input type="hidden" name="gID" value="G0006"/>
								<button href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
									เหล็กเส้น
								</button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="images/banner-10.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<form action="{{URL::to('/searchGroup')}}" method="post">
							@csrf
								<input type="hidden" name="gID" value="G0005"/>
								<button href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
									ตะแกรงเหล็ก
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="images/banner-15.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<form action="{{URL::to('/searchGroup')}}" method="post">
							@csrf
								<input type="hidden" name="gID" value="G0001"/>
								<button href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
									เกเบี้ยน แมทเทรส
								</button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="images/banner-16.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<form action="{{URL::to('/searchGroup')}}" method="post">
							@csrf
								<input type="hidden" name="gID" value="G0004"/>
								<button href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
									PVC
								</button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
					<!-- block1 -->
					<div class="block1 hov-img-zoom pos-relative m-b-30">
						<img src="images/banner-17.jpg" alt="IMG-BENNER">

						<div class="block1-wrapbtn w-size2">
							<!-- Button -->
							<form action="{{URL::to('/product')}}" method="get">
							@csrf
								<input type="hidden" name="gID" value="G0004"/>
								<button href="#" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
									อื่นๆ
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Our product -->
	<section class="bgwhite p-t-45 p-b-58">
		<div class="container">
			<div class="sec-title p-b-22">
				<h3 class="m-text5 t-center">
					สินค้าแนะนำ
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#best-seller" role="tab">สินค้าขายดี</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#featured" role="tab">สินค้ามาใหม่</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#sale" role="tab">สินค้าลดราคา</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-35">
					<!-- - -->
					<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
						<div class="row">
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelhot">
										<img src="images/item-02.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0001"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											เกเบี้ยน (3.4 / 2.7 / 2.2 มม.)
										</a>

										<span class="block2-price m-text6 p-r-5">
										</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelhot">
										<img src="images/item-08.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0059"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a  class="block2-name dis-block s-text3 p-b-5">
											ตะแกรงเหล็ก (กลม) 4.0 x 4.0 มม.
										</a>

										<span class="block2-price m-text6 p-r-5">
										</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelhot">
										<img src="images/item-10.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0071"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a class="block2-name dis-block s-text3 p-b-5">
											เหล็กเส้นกลม SR24
										</a>

										<span class="block2-price m-text6 p-r-5">										
										</span>
									</div>
								</div>
							</div>


							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelhot">
										<img src="images/item-12.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0001"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											ลวดมัดเหล็ก
										</a>

										<span class="block2-price m-text6 p-r-5">
										</span>
									</div>
								</div>
							</div>							
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="featured" role="tabpanel">
						<div class="row">
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
										<img src="images/item-07.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0069"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											ทับหลัง
										</a>

										<span class="block2-newprice m-text8 p-r-5">
										</span>
									</div>
								</div>
							</div>

							
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
										<img src="images/item-06.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0074"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											เหล็กโดเวล (กลม)
										</a>

										<span class="block2-price m-text6 p-r-5">
										</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
										<img src="images/item-11.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0070"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											หนวดกุ้ง/ลาย
										</a>

										<span class="block2-price m-text6 p-r-5">
										</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
										<img src="images/item-14.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0054"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											ท่อ PVC
										</a>

										<span class="block2-price m-text6 p-r-5">
										</span>
									</div>
								</div>
							</div>
							
						</div>
					</div>

					<!--  -->
					<div class="tab-pane fade" id="sale" role="tabpanel">
						<div class="row">
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
										<img src="images/item-05.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0010"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											ปูนปอร์ตแลนด์
										</a>

										
										<span class="block2-oldprice m-text7 p-r-5">
											115 บาท
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											110 บาท
										</span>

									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
										<img src="images/item-09.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0036"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											แปรงทาสี
										</a>

										<span class="block2-oldprice m-text7 p-r-5">
											120 บาท
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											110 บาท
										</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
										<img src="images/item-04.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0039"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											กระดาษทราย
										</a>

										<span class="block2-oldprice m-text7 p-r-5">
											20 บาท
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											18 บาท
										</span>
									</div>
								</div>
							</div>

							<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelsale">
										<img src="images/item-13.jpg" alt="IMG-PRODUCT">

										<div class="block2-overlay trans-0-4">
											<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
												<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
												<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
											</a>

											<div class="block2-btn-addcart w-size1 trans-0-4">
												<form action="{{URL::to('/product-detail')}}" method="post">
													<!-- Button -->
													@csrf
													<input type="hidden" name="tID" value="T0049"/>
													<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
														ดูรายละเอียด
													</button>
												</form>
											</div>
										</div>
									</div>

									<div class="block2-txt p-t-20">
										<a href="#" class="block2-name dis-block s-text3 p-b-5">
											ยาแนว
										</a>

										<span class="block2-oldprice m-text7 p-r-5">
											55 บาท
										</span>

										<span class="block2-newprice m-text8 p-r-5">
											50 บาท
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>


	<!-- Banner video -->
	<section class="parallax0 parallax100" style="background-image: url(images/bg-video-01.jpg);">
		<div class="overlay0 p-t-190 p-b-200">
			<div class="flex-col-c-m p-l-15 p-r-15">
				<span class="m-text9 p-t-45 fs-20-sm">
					พร้อมบริการส่งสินค้า
				</span>

				<h3 class="l-text1 fs-35-sm">
					ถึงหน้างานคุณ
				</h3>

				<span class="btn-play s-text4 hov5 cs-pointer p-t-25" data-toggle="modal"  data-target="#modal-video-01">
					<i class="fa fa-play" aria-hidden="true"></i>
					เล่นวิดีโอ
				</span>
			</div>
		</div>
	</section>


	<!-- Shipping -->
	<section class="shipping bgwhite p-t-62 p-b-46">
		<div class="flex-w p-l-15 p-r-15">
			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					สินค้าหลากหลายได้มาตรฐาน
				</h4>

				<a href="#" class="s-text11 t-center">
					สินค้ามากกว่า 2,000 รายการ พร้อมมาตรฐาน มอก.
				</a>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
				<h4 class="m-text12 t-center">
					ส่งสินค้ารวดเร็ว
				</h4>

				<span class="s-text11 t-center">
					บริการส่งสินค้าถึงหน้างานทั่วเขตภาคเหนือตอนบน
				</span>
			</div>

			<div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
				<h4 class="m-text12 t-center">
					บริการด้วยใจ
				</h4>

				<span class="s-text11 t-center">
					พร้อมมอบบริการที่ดีให้แก่คุณ
				</span>
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

	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
	<script type="text/javascript">
		$('.block2-btn-addcart1').each(function(){
			window.location.assign("{{URL::to('/product-detail')}}");

		});
	</script>

<!--===============================================================================================-->
	<script type="text/javascript" src="vendor/parallax100/parallax100.js"></script>
	<script type="text/javascript">
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
@endsection