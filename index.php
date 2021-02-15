<?php include_once('inc/header.php') ?>
<div class="row">
	<div class="col-md-12">
		<h4 class="text-center text-white bg-dark p-3 mt-4">Login</h4>
	</div>
	<div class="col-md-4 mx-auto" id="loginFormDiv">
		<form action="generate_otp_and_send_email.php" method="POST">
			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
			</div>
			<input type="submit" name="login" class="btn btn-warning" id="login" value="Login">
		</form>
	</div>
</div>
<?php include_once('inc/footer.php') ?>