<?php
require './lib/stripe.php';
 
if ($_POST) {
  Stripe::setApiKey("sk_test_tvaMvG0ShUYJzy8rwKQYVBaH");
  $error = '';
  $success = '';
  try {
    if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
    Stripe_Charge::create(array("amount" => 2000,
                                "currency" => "usd",
                                "card" => $_POST['stripeToken']));
    $success = 'Your payment was successful.';
  }
  catch (Exception $e) {
    $error = $e->getMessage();
  }
} 
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/tired.css" rel="stylesheet" />
		<link href="css/icons.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>
		<link href="css/font-awesome.min.css" rel="stylesheet" />
		




		<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
        <!-- jQuery is used only for this example; it isn't required to use Stripe -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script type="text/javascript">
            // this identifies your website in the createToken call below
            Stripe.setPublishableKey('pk_test_Viv82H1z7E8Xg5sbl22ULYBg');
 
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    $('.submit-button').removeAttr("disabled");
                    // show the errors on the form
                    $(".payment-errors").html(response.error.message);
                } else {
                    var form$ = $("#payment-form");
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    form$.get(0).submit();
                }
            }
 
            $(document).ready(function() {
                $("#payment-form").submit(function(event) {
                    // disable the submit button to prevent repeated clicks
                    $('.submit-button').attr("disabled", "disabled");
 
                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
                });
            });
        </script>





        

	</head>
	<body>	
		<div class="temp">
			<div class="col-xs-3 text-left">
				<a id="logo" href="#">DOUBLR</a>
			</div>
			<div class="col-xs-5"></div>
			<div class="col-xs-1 text-right">
				<a class="bar_item" href="#">Contact</a>
			</div>
			<div class="col-xs-1 text-right">
				<a class="bar_item" href="#">Order</a>
				<nav class="menu-icon" href="#"><span class="icon-align-justify"></span></nav>
			</div>
			<div class="col-xs-1 text-right">
				<a class="bar_item" href="learn.html">Learn More</a>
			</div>
		</div>
		<section id="landingScroll" data-speed="8" data-type="background">
			<div class="container landingText">
				<h1 style="text-align:center; font-family:bebasneueregular;">THE NEW <a id="you_go" style="color:#FFF; font-size:50%;">YOU</a> IS HERE</h1>
			</div>
		</section>
		<section id="data-container">
			<div style="margin-top:5%">
				<h1 style="text-align:center; font-family:bebasneueregular; font-size:3em">WE ARE DOUBLR</h1>
			</div>
			<div style="width:25%; height:3px; background-color:#000; margin:5% auto"></div>
			<div style="margin-bottom:5%">
				<p style="text-align:center; font-size:1.5em">
					Some text here about us.
				</p>
			</div>
			<div id="finalInfo">
				<div id="map-canvas"></div>
				<div id="teamInfo">
					<div>
	                  <h3>Development</h3>
	                  <p>Praesent faucibus nisl sit amet nulla sollicitudin</p>
              		</div>
				</div>
			</div>
		</section>



		<section>
	        <form action="" method="POST">
          <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_test_Viv82H1z7E8Xg5sbl22ULYBg"
            data-amount="2000"
            data-name="Yay"
            data-description="2 widgets ($20.00)"
            data-image="/128x128.png">
          </script>
     	   </form>
	    </section>



        
	</body>
</html>