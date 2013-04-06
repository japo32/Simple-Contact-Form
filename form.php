<?php
//assign a variable so we don't have to keep referring to the array.
$rm = $_SERVER['REQUEST_METHOD'];
$stat_message = "We've recieved your submission! Thank you!";
$posted = false;
$success = false;

if ($rm == 'POST') {
	//assign some variables so we don't have to keep referring to the array.
	$posted = true;
	$name = htmlspecialchars($_POST['name']);
	$designation = htmlspecialchars($_POST['designation']);
	$company = htmlspecialchars($_POST['company']);
	$contact = htmlspecialchars($_POST['contact']);
	$email = htmlspecialchars($_POST['email']);

	//check if all items were submitted.
	if( $name  != "" &&
		$designation != "" && 
		$company != "" &&
		$contact != "" &&
		$email != ""){

		//check if email is valid
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$to = 'adrian.domingo32@gmail.com';
			$subject = 'VIA Inquiry from '.$name;

$mail_message = <<<EOT
A message has been sent through the VIA inquiry form.

Sender: $name
Designation: $designation
Company: $company
Contact: $contact
Sender Email: $email
EOT;

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: nonj@dnb.com.ph' . "\r\n" .
			    'Reply-To: nonj@dnb.com.ph' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

				if(mail($to, $subject, $mail_message)){
					$stat_message = 'Thank you for your message.';
					$success = true;
				} else{
					$stat_message = 'There was a problem sending your message. Please feel free to use the contact page or call us directly.';
				}

		} else{
			$stat_message = "Please enter a valid email address.";
		}

	} else{
		$stat_message = "Please fill up all the fields.";
	}
}
 ?>
<style type="text/css">
	ul{ margin: 0; padding: 0;}
	li{ list-style: none;}
	#learn-more{ width: 300px;}
	#learn-more label{width: 100px; font-size: 0.8em; display: inline-block;}
	#learn-more input[type=text]{width: 180px; margin: 5px 0;}
	#learn-more li:last-child{text-align: right;padding-right: 20px;}
	#form-status{ padding: 10px; display: none; -webkit-border-radius: 10px;
border-radius: 10px;}
	#form-status.display{ display: block;}
	#form-status.green{ 
		color: #044c29;
		background-color:#96ed89;
		border: 1px solid #044c29;
	}
	#form-status.red{ 
		color: #bf1616;
		background-color:#ff837e;
		border: 1px solid #bf1616;
	}
	#form-status{
	    -webkit-transition: all 2s ease;
		-moz-transition: all 2s ease;
		-ms-transition: all 2s ease;
		-o-transition: all 2s ease;
		transition: all 2s ease;
	}
</style>

<div id="contact">
<form action="" method="post" accept-charset="utf-8" id="contact-form">

	<?php if ($posted): ?>
		<div id="form-status" class="red"><?php echo $stat_message; ?></div>
	<?php endif; ?>
	<h3>Want to learn more?</h3>
	<ul>
		<li>
			<label for="name">Full Name:</label>
			<input type="text" name="name" id="name"
			<?php if($posted && $success == false){
				echo "value= \"$name\"";
			} ?> >
		</li>
		<li>
			<label for="designation">Designation:</label>
			<input type="text" name="designation" id="designation"
			<?php if($posted && $success == false){
				echo "value= \"$designation\"";
			} ?> >
		</li>
		<li>
			<label for="company">Company Name:</label>
			<input type="text" name="company" id="company"
			<?php if($posted && $success == false){
				echo "value= \"$company\"";
			} ?> >
		</li>
		<li>
			<label for="contact">Contact No.:</label>
			<input type="text" name="contact" id="contact"
			<?php if($posted && $success == false){
				echo "value= \"$contact\"";
			} ?> >
		</li>
		<li>
			<label for="email">Email</label>
			<input type="text" name="email" id="email"
			<?php if($posted && $success == false){
				echo "value= \"$email\"";
			} ?> >
		</li>
		<li>			
			<input type="hidden" name="secret" id="secret">
			<input type="submit" name="submit" id="submit" value="Submit">
		</li>
	</ul>
	
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script type="text/javascript" charset="utf-8" >

/*(function( $, window, document, undefined ) {

	$('#form-status').addClass('display');	
	<?php if ($success): ?>
	$('#form-status').removeClass('red').addClass('green');	
	<?php endif; ?>

})( jQuery, window, document );*/

$(document).ready(function(){
		form = $('#form-status');

		<?php if ($success): ?>
		form.removeClass('red').addClass('green');	
		<?php endif; ?>

		form.fadeIn(200);	
	});	


</script>