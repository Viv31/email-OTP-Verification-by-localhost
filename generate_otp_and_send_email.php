<?php
require_once('config/config.php');

if(isset($_POST['login'])){
	$email = $_POST['email'];
	//echo $email;
//Email verify from database
	$check_email ="SELECT email FROM user WHERE email ='".$email."'";
	$res = mysqli_query($conn,$check_email);
	if(mysqli_num_rows($res)>0){
		//if email  is registered so generate OTP and send
		$characters = '0123456789';
	$OTP_length = 6;
	 $generated_otp = '';
	  $max = strlen($characters) - 1;
  		for ($i = 0; $i < $OTP_length; $i++) {
       $generated_otp .= $characters[mt_rand(0, $max)];
		 }
		 //echo $generated_otp;
		
		 $update_old_otp = "UPDATE user set `OTP` = '".$generated_otp."',`OTP_Verify`= 0 WHERE email = '".$email."' ";
	$result = mysqli_query($conn,$update_old_otp);
		
		if($result){
				
				$to = $email;
		$subject = 'OTP Verification';
		$headers = "From: vivgangs@gmail.com";
		$headers .= 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$message1 = '<div class="col-md-6 mx-auto">Your Verifiation Code is '.$generated_otp.' </div>';
		//echo $message1;

	$sent = mail($to, $subject, $message1, $headers); //mail function  
				if($sent){ ?>
					<div class="row">
						<div class="col-md-6 mx-auto mt-5">
							<div class="alert alert-success alert-dismissible">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>Success!</strong> An OTP sent to your email <?php echo $email ?>.
							</div>
						</div>
					</div>
				<?php }else{
					echo "Not Sent";
				}
			}
		else{
			echo "OTP Failed";
		}


	}
	else{
		echo "Data Not Found";
	}

}
?>
<?php include_once('inc/header.php') ?>
<div class="row">
	<div class="col-md-4 mx-auto mt-5" id="loginFormDiv">
		 <div class="form-group">
        <label>Enter OTP:</label>
        <input type="number" name="OTP" id="OTP" placeholder="Enter OTP" class="form-control" onkeyup="return VerifyOTP(this.value);">
        <span id="OTP_error"></span>
      </div>
	</div>
</div>
<?php include_once('inc/footer.php') ?>
<script type="text/javascript">
//Cheking User inserted OTP value
function VerifyOTP($otp){
    //console.log($otp);
     var email = '<?php echo $email; ?>';
     var OTP = $otp;
     //alert(OTP);

     var data = {
      "email":email,
      "OTP":OTP

     }

     $.ajax({
      type:"POST",
      url:"verify_otp.php",
      data:data,
      beforeSend:function(){
        $("#OTP_error").text("Checking OTP ..............");
      },
      success:function(response){
        $("#OTP_error").text("");
        if(response == "OTP Verify"){
          //alert("Verified");
          $("#OTP").css("border-color",'green');
          $("#OTP_error").text("Redirectng..............");
          window.location.href ="dashboard.php";

          

        }
        if(response == "OTP Not Verify"){
          //Checking  for OTP 
          $("#OTP").css("border-color",'red');
          $("#OTP_error").text("Please Enter Correct OTP");


        }

      }

     });
}

</script>

