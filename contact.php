<?php
require("php/database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dieren Opvang de Haard, neem hier uw dieren naartoe om ze te laten genieten van een van de beste dierenopvangcentra in Nederland.">
    <?php require("components/style.php"); ?>
    <title>Dieren Opvang</title>
</head>
<body>
<header>
	<div class="container">
    <img class="img-fluid" width="120" src="uploads/simg/logo.png">
	    <h1 style="margin-top: -4rem;" class="text-center ms-4">Dierenopvang</h1>
		<p></p>
	</div>
</header>
<?php require("components/navbar.php"); ?>
<section class="container mb-5 card card-body" id="contact">
		<div class="row">
                    <div class="col-lg-6 mx-auto">
                        <form id="contactForm" name="sentMessage" novalidate="novalidate">
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Name</label>
                                    <input class="form-control" id="name" type="text" placeholder="Name" required="required" data-validation-required-message="Please enter your name." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Email Address</label>
                                    <input class="form-control" id="email" type="email" placeholder="Email Address" required="required" data-validation-required-message="Please enter your email address." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Phone Number</label>
                                    <input class="form-control" id="phone" type="tel" placeholder="Phone Number" required="required" data-validation-required-message="Please enter your phone number." />
                                    <p class="help-block text-danger"></p>
                                </div>
							</div>
							<div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Subject</label>
                                    <input class="form-control" id="subject" type="text" placeholder="Subject" required="required" data-validation-required-message="Please enter your Subject." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                    <label>Message</label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <br />
                            <div id="success"></div>
                            <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton" type="submit">Send</button></div>
                        </form>
                    </div>
                <div class="col-md-3 mx-auto mt-5 text-center">
				<ul class="list-unstyled mb-0">
					<li><i class="fas fa-map-marker-alt fa-2x"></i>
						<p>Hier moet een </p>
					</li>

					<li><i class="fas fa-phone mt-4 fa-2x"></i>
						<p>Hier moet een phone number</p>
					</li>

					<li><i class="fas fa-envelope mt-4 fa-2x"></i>
						<p>Ik moet nog een email maken</p>
					</li>
				</ul>
			</div>
                </div>
            </div>
	</section>
<?php require("components/scripts.php");
require("components/footer.php"); ?>
<script src="js/mail/jqBootstrapValidation.js"></script>
<script src="js/mail/contact_me.js"></script>
</body>
</html>