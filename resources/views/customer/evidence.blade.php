@extends('header-footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@section('header')

<div class="container">

    <h2 style="text-align: center;">ส่งหลักฐานการชำระเงิน</h2>
    <div class="card3">
        <form action="{{ URL::to('/upload') }}" method ="post" enctype="multipart/form-data" id="upload">
            {{csrf_field()}}
            <input id="oID" name="oID" type="hidden" value="{{$oID}}">
        <table class="evidence">
            <tr>
                <td rowspan="2">
                    <div class="cardImg">
                        <img id="bank"src="images/bank.jpeg" style="width:100%; max-width:500px;">
                    </div>
                </td>
                <td>
                    <div class="cardImg" style="background-color: #cecece;">
                        <h3 style="text-align: left;">ออเดอร์เลขที่  </h3> 
                        <h3 style="text-align: center;"><b>{{$oID}}</b></h3><br>

                        <h3 style="text-align: left;">ยอดที่ต้องชำระ</h3> 
                        <h3 style="text-align: center; color:red;"><b>{{$orders[0]->oAmountVat}} บาท</b></h3>
                        
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                <div class="cardImg">
                        <img id="blah"src="images/upload1.jpg" style="width:100%;max-width:300px;">
                        <div class="avartar-picker">
                        <br>
                            <input type="file" onchange="readURL(this);" name="evidence" id="file-1" class="inputfile" 
                                accept="image/jpeg,image/png,application/pdf" style="width:100%;max-width:200px;"
                                data-multiple-caption="{count} files selected" multiple />
                        </div>
                        <ul class="main_menu">
                            <li>
                                <button onclick="javascript:history.go(-1)" class="flex-c-m size3 bg1 bo-rad-23 hov8 m-text1 trans-0-4" style="width: 200px; height:40px">	
                                    กลับ
                                </button>
                            </li>
                            <li>
                                <button id="ยืนยัน" type="submit" class="flex-c-m size2 bg0 bo-rad-23 hov7 m-text2 trans-0-4" style="width: 200px; height:40px">	
                                    ยืนยัน
                                </button>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>

        </table>
        </form>
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

		$("#create").on('click', function() {
    		oID = document.getElementById("oID").value;
			window.location.assign("{{URL::to('/adminQuotation?oID=')}}"+oID);
        });
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
						;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#ยืนยัน").on('click',function(e){ //also can use on submit
			e.preventDefault(); //prevent submit
			Swal.fire({
				title: 'ต้องการยืนยันส่งหลักฐานการชำระเงิน?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ยืนยัน',
				cancelButtonText: 'ยกเลิก'
				}).then((result) => {
					if(result.isConfirmed){
						Swal.fire(
							'สำเร็จ!',
							'ส่งหลักฐานการชำระเงินเรียบร้อยแล้ว',
							'success'
						)
						$('#upload').submit();
					}
				});
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