@extends('header-footer')

@section('header')

    <section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/product.jpg);">
            <h2 class="l-text3 t-center" style="color:#888888">
                ประวัติคำสั่งซื้อ
            </h2>
    </section>

    <h4 class="l-text10 t-left">
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ประวัติคำสั่งซื้อทั้งหมด &nbsp;&nbsp;{{$count}}&nbsp;&nbsp;รายการ<br><br>
    </h4>
    <div class="container">

    @if($count > 0)
        @foreach($orders as $order)
            @if($order[0]->oStatus == 'คำสั่งซื้อสำเร็จแล้ว' || $order[0]->oStatus == 'ยกเลิกคำสั่งซื้อ' || $order[0]->oStatus == 'หมดอายุ')
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