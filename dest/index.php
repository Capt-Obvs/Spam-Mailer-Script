<?php /** @noinspection ForgottenDebugOutputInspection */

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/../src/SimpleXLSX.php';

if (isset($_POST['send'])){

	$subject = $_POST['subject'];
	$sender_email = $_POST['sender_email'];
	$company_website = $_POST['company_website'];
		$message = "<!doctype html>
			<html lang='en-US'>

			<head>
				<meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
				<meta name='description' content='New Account Email Template.'>
				<style type='text/css'>
					a:hover {text-decoration: underline !important;}
				</style>
			</head>

			<body marginheight='0' topmargin='0' marginwidth='0' style='margin: 0px; background-color: #f2f3f8;' leftmargin='0'>
				<!-- 100% body table -->
				<table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#f2f3f8'
					style='@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;'>
					<tr>
						<td>
							<table style='background-color: #f2f3f8; max-width:670px; margin:0 auto;' width='100%' border='0'
								align='center' cellpadding='0' cellspacing='0'>
								<tr>
									<td>
										<table width='95%' border='0' align='center' cellpadding='0' cellspacing='0'
											style='max-width:670px; background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);'>
											<tr>
												<td style='height:40px;'>&nbsp;</td>
											</tr>
											<tr>
												<td style='padding:0 35px;'>
													<h1 style='color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;'>".$subject."
													</h1>
													<p style='font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;'>
														".$subject."</strong>.</p>
													<span
														style='display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;'></span>
												</td>
											</tr>
											<tr>
												<td style='height:40px;'>&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td style='height:20px;'>&nbsp;</td>
								</tr>
								<tr>
									<td style='text-align:center;'>
										<p style='font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;'>&copy; <strong>".$company_website."</strong> </p>
									</td>
								</tr>
								<tr>
									<td style='height:80px;'>&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</body>

			</html>";
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

if ($xlsx = SimpleXLSX::parse($target_file)) {
        $i = 0;

    foreach ($xlsx->rows() as $elt) {
      if ($i == 0) {
        echo "Not sure";
      } else {
	  $to = $elt[1];
		  // Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <'.$sender_email.'>' . "\r\n";

			mail($to,$subject,$message,$headers);
			echo "Mail Sent";
      }      

      $i++;
    }
} else {
    echo SimpleXLSX::parseError();
}
 } else {
		echo "Sorry, there was an error uploading your file.";
	  }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Authentication forms">
<meta name="author" content="Arasari Studio">
<title>Mailer Script</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/common.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Rubik:400,600,700&amp;display=swap" rel="stylesheet">
<link href="css/theme-05.css" rel="stylesheet">
</head>
<body>
<div class="forny-container">
<div class="forny-inner">
<div class="forny-two-pane">
<div>
<div class="forny-form">
<div>
<h4>Upload FIle</h4>
<p class="mb-10">Download sample excel format  <a href="05_register.html">Click here</a></p>
</div>
<form method="post" enctype="multipart/form-data">
<div class="form-group">
<div class="input-group">
<input required class="form-control" name="file" type="file" placeholder="Excel file">
</div>
</div>
<div class="form-group">
<div class="input-group">
<input required class="form-control" name="sender_email" type="email" placeholder="Sender Address">
</div>
</div>
<div class="form-group">
<div class="input-group">
<input required class="form-control" name="subject" type="text" placeholder="Subject of Email">
</div>
</div>
<div class="form-group">
<div class="input-group">
<input required class="form-control" name="company_website" type="text" placeholder="Company Website">
</div>
</div>
<div>
<button name="send" type="submit" class="btn btn-primary btn-block">Send Email</button>
</div>
</form>
</div>
</div>
<div class="right-pane">
<div class="text-center" style="width: 300px">
<img src="image.png" width="300">
<div class="mt-10">
<h4 class="mb-4">Welcome to Mailer Script</h4>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/demo.js"></script>
</body>
</html>