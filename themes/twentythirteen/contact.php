<?php
/**
 * Template Name: Contact Page
 */
get_header();
//echo '<img class="img-single-square"src="http://www.tlcpolitical.com/wp-content/themes/twentythirteen/images/contact-front.jpg">';
?>

<div class="mainContact">
	<div class="row">
		<div class="col-md-2"></div> 
		<div class="col-md-5">
			<div class="wrap-contact">
				<div id="main" style="padding:50px 0 0 0;">
				<?php
					if(isset($_GET['send']) && ($_GET['send']=="yes")){
						echo "<div class='reussi'>Wohooooo! Thank you for your message, we'll answer you as soon as possible...</div>";
					}elseif(isset($_GET['send']) && ($_GET['send']=="error")){
						echo "<div class='error'>Oooooops! There an error in your message, the email is not sent...</div>";
					}
				?>
				<!-- Form -->
				<form id="contact-form" action="http://tlcpolitical.com/mail.php" method="post">
					<h3>Get in touch</h3>
					<h4>Fill in the form below, and we'll get back to you within 24 hours.</h4>
					<div>
						<label>
							<span>Name: (required)</span>
							<input name="name" placeholder="Please enter your name" class="form-control" type="text" tabindex="1" required autofocus>
						</label>
					</div>
					<div>
						<label>
							<span>Email: (required)</span>
							<input name="email" placeholder="Please enter your email address" class="form-control" type="email" tabindex="2" required>
						</label>
					</div>
					<div>
						<label>
							<span>Telephone: (required)</span>
							<input name="phone" placeholder="Please enter your number" class="form-control" type="tel" tabindex="3" required>
						</label>
					</div>
<!--					<div>
						<label>
							<span>Website: (required)</span>
							<input name="site" placeholder="Begin with http://" type="url" class="form-control" tabindex="4" required>
						</label>
					</div>
-->
					<div>
						<label>
							<span>Message: (required)</span>
							<textarea name="message" placeholder="Include all the details you can" tabindex="5" required></textarea>
						</label>
					</div>
					<div>
						<button name="submit" type="submit" id="contact-submit" class="form-control" data-text="...Sending">Send Email</button>
					</div>
				</form>
				<!-- /Form -->
				
				</div>
			</div>
		</div>
		<div class="col-md-3">
		<h1>Visit Us</h1>
			<p>2800 Shirlington Road, 9th Floor</br>
			Arlington, VA 22206</br>
			<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> Toll Free: 888-845-8484</br>
			<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> Phone: 703-845-8484</br>
			<span class="glyphicon glyphicon-send" aria-hidden="true"></span> Fax: 703-845-9655</br>
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Email: political@thelukenscompany.com
			</p>
		</div>
				<div class="col-md-2"></div> 

	</div>
</div>

<?php get_footer(); ?>
