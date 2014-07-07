<?php
require './lib/stripe.php';
 
if ($_POST) {
  Stripe::setApiKey("sk_test_tvaMvG0ShUYJzy8rwKQYVBaH");
  $error = '';
  $success = '';
  try {
    if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
    Stripe_Charge::create(array("amount" => 1000,
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
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Stripe Getting Started Form</title>


    </head>
    <body>
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
    </body>
</html>