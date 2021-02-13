@extends('header-footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('header')
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/product.jpg);">
    <h2 class="l-text0 t-center" style="color:#3d3d3d;padding:30px;padding-left:100px;padding-right:100px;background-color: #cccccc;opacity: 0.85;">
        ข้อมูลลูกค้า
    </h2>
</section>

<div class="limiter">
    
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100">
                <div class="row100 header100">
                    <div class="cell101">
                        ลำดับ
                    </div>
                    <div class="cell101">
                        ชื่อ
                    </div>
                    <div class="cell101">
                        บริษัท
                    </div>
                    <div class="cell101">
                        ที่อยู่
                    </div>
                    <div class="cell101">
                        เบอร์โทร
                    </div>
                    <div class="cell101">
                        ประเภท
                    </div>
                    <div class="cell101">
                        ยอดสะสม (บาท)
                    </div>
                </div>
                
                @foreach ($customers as $index => $customer)
                <div class="row100">
                    <div class="cell101" data-title="number">{{$index+1}}</div>	
                    <div class="cell101" data-title="name">คุณ {{$customer->cFname}} {{$customer->cLname}} </div>	
                    <div class="cell101" data-title="company"> 
                        @if($customer->cCompany != "ไม่มีข้อมูล")
                            {{$customer->cCompany}}
                        @else
                            -
                        @endif
                    </div>
                    <div class="cell101" data-title="addr">{{$customer->cAddress}}</div>
                    <div class="cell101" data-title="phone">{{$customer->cPhone}}</div>	
                    <div class="cell101" data-title="tier">{{$customer->tierName}}</div>
                    <?php $have = 0?>	
                    @foreach($orders as $order)                        
                        @if($order->cID == $customer->cID and $order->sum != null)
                            <?php $have = 1?>
                            <div class="cell101" data-title="amount"><?php echo (number_format($order->sum)); ?></div>	
                        @endif
                    @endforeach
                    @if($have == 0)
                        <div class="cell101" data-title="amount">0</div>
                    @endif
                </div>
                @endforeach
            </div>
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
