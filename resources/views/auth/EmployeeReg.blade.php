<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V14</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/icons/logo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts_login/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts_login/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor_login/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor_login/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor_login/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css_login/util.css">
	<link rel="stylesheet" type="text/css" href="css_login/main.css">
<!--===============================================================================================-->
<!-- sweet alert ================================================== -->	
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- sweet 2 -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> 

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ URL::to('/EmpCheck') }}">
				@csrf	
					<span class="login100-form-title p-b-32">
						Employee Register
                    </span>
                    
                    <span class="txt1 p-b-11">
						First Name
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "โปรดกรอก E-mail">
						<input class="input80 form-control" type="text" name="Fname" >
						<span class="focus-input80"></span>
					</div>

					<span class="txt1 p-b-11">
						Last Name
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "โปรดกรอก E-mail">
						<input class="input80 form-control" type="text" name="Lname" >
						<span class="focus-input80"></span>
                    </div>
                    
                    <span class="txt1 p-b-11">
						Status
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "โปรดกรอก E-mail">
                        <select class="input100 selection" name="status">
                            <option>Admin</option>
                        </select>
					</div>

					<span class="txt1 p-b-11">
						E-mall Address
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "โปรดกรอก E-mail">
						<input class="input80 form-control" type="email" name="email">
						<span class="focus-input80"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "โปรดกรอก Password">
						<input class="input80 form-control" type="password" name="pass" >
						<span class="focus-input80"></span>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor_login/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/bootstrap/js/popper.js"></script>
	<script src="vendor_login/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/daterangepicker/moment.min.js"></script>
	<script src="vendor_login/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor_login/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js_login/main.js"></script>

</body>
</html>