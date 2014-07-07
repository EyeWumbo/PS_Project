<!DOCTYPE html>
<html class="" lang="en">

  <head>
 
    <title>Doublr</title>

    <link rel="icon" type="image/png" href="">

    <link rel="icon" 
      type="image/png" 
      href="wes/Favicon.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/icons.css" rel="stylesheet">
    <link href="css/jquery.bxslider.css" rel="stylesheet">
    <link href="css/supersized.css" rel="stylesheet">
    <link href="css/effect.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive-body.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/metro-style.css" rel="stylesheet">
    <link href="css/Met-Js.css" rel="stylesheet">

    <!-- Js -->

    <script src="js/jquery.min.js"></script>


    <!-- Stripe Payment Script -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
      Stripe.setPublishableKey('pk_YOUR_PUBLISHABLE_KEY');
        $(document).ready(function() {
          function addInputNames() {
            // Not ideal, but jQuery's validate plugin requires fields to have names
            // so we add them at the last possible minute, in case any javascript 
            // exceptions have caused other parts of the script to fail.
            $(".card-number").attr("name", "card-number")
            $(".card-cvc").attr("name", "card-cvc")
            $(".card-expiry-year").attr("name", "card-expiry-year")
          }

          function removeInputNames() {
            $(".card-number").removeAttr("name")
            $(".card-cvc").removeAttr("name")
            $(".card-expiry-year").removeAttr("name")
          }

          function submit(form) {
            // remove the input field names for security
            // we do this *before* anything else which might throw an exception
            removeInputNames(); // THIS IS IMPORTANT!

            // given a valid form, submit the payment details to stripe
            $(form['submit-button']).attr("disabled", "disabled")

            Stripe.createToken({
              number: $('.card-number').val(),
              cvc: $('.card-cvc').val(),
              exp_month: $('.card-expiry-month').val(), 
              exp_year: $('.card-expiry-year').val()
            }, function(status, response) {
              if (response.error) {
                // re-enable the submit button
                $(form['submit-button']).removeAttr("disabled")

                // show the error
                $(".payment-errors").html(response.error.message);

                // we add these names back in so we can revalidate properly
                addInputNames();
              } else {
                // token contains id, last4, and card type
                var token = response['id'];

                // insert the stripe token
                var input = $("<input name='stripeToken' value='" + token + "' style='display:none;' />");
                form.appendChild(input[0])

                // and submit
                form.submit();
              }
            });            
            return false;
          }
          
          // add custom rules for credit card validating
          jQuery.validator.addMethod("cardNumber", Stripe.validateCardNumber, "Please enter a valid card number");
          jQuery.validator.addMethod("cardCVC", Stripe.validateCVC, "Please enter a valid security code");
          jQuery.validator.addMethod("cardExpiry", function() {
            return Stripe.validateExpiry($(".card-expiry-month").val(), 
                                         $(".card-expiry-year").val())
          }, "Please enter a valid expiration");

          // We use the jQuery validate plugin to validate required params on submit
          $("#example-form").validate({
            submitHandler: submit,
            rules: {
              "card-cvc" : {
                  cardCVC: true,
                  required: true
              },
              "card-number" : {
                  cardNumber: true,
                  required: true
              },
              "card-expiry-year" : "cardExpiry" // we don't validate month separately
            }
          });

          // adding the input field names is the last step, in case an earlier step errors                
          addInputNames();
      });
    </script>
    <!-- /Stripe Payment Script -->


    <!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-52426101-1', 'auto');
      ga('send', 'pageview');
    </script>
    <!-- /Google Analytics -->

    <?php
    echo '<p>Hello World</p>';
    ?>

  </head>




  <body class="onepage">
    <div id="preloader"></div>
    <a id="top"></a>



    <!-- NAV -->
    <nav id="nav-desktop" class="nav-normal"> 
      <div class="container">
        <h1 id="logo"><a class="scroll" href="index.html"><img class="logo" src="img/logo.png" alt=""></a></h1>
        <ul>
          <li><a href="#learn"><span>Learn More</span></a></li>
          <li><a href="#order"><span>Order</span></a></li>
          <li><a href="#contact"><span>Contact</span></a></li>
        </ul>
      </div>
    </nav>
    <!-- /NAV -->



    <!-- What Do We Do? -->
    <section id="home" class="page">
      <div class="row">
        <div class="col-md-12">
          <div class="title clearfix pad-top">
            <h1></h1>
            <h1 data-animated="bounceIn">How To Order Your Double</h1>
            <img src="img/lini.png" alt="" data-animated="bounceIn">
          </div>
          <h1 class="under-l" data-animated="bounceIn">We provide a way of making the best memories last even longer with lifelike replicas.</h1>
        </div>
      </div>
      <div class="row ">
        <div id="about-wrap" class="pad-top">
          <div id="about-desc" class="col-sm-6 col-md-6 pad-top pad-bottom">
            <a style="margin-left: 10%" href="#"><img src="http://maps.googleapis.com/maps/api/staticmap?center=33.697945,-117.846761&zoom=16&size=600x300&maptype=roadmap
&markers=color:red%7Clabel:PeopleSpace%7C33.697945, -117.846761" alt="" data-animated="bounceIn"></a>
          </div>
          <div class="col-md-6 col-sm-6 pad-top">
            <div class="service-icon" data-animated="fadeInRight">
              <span class="icon-gear"></span>
              <h3>Tangible</h3>
              <p>Using the latest 3D printing technology</p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 pad-hbottom">
            <div class="service-icon" data-animated="fadeInRight">
              <span class="icon-mobile"></span>
              <h3>Lifelike</h3>
              <p>High quality figurines that look alive</p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="service-icon" data-animated="fadeInRight">
              <span class="icon-book"></span>
              <h3>Quick</h3>
              <p>Scan yourself in 60 seconds</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /What Do We Do? -->



    <!-- We Sell Locally -->
    <section id="home" class="page">
      <div class="row">
        <div class="col-md-12">
          <div class="title clearfix pad-top">
            <h1></h1>
            <h1 data-animated="bounceIn">We're Local!</h1>
            <img src="img/lini.png" alt="" data-animated="bounceIn">
          </div>
          <h1 class="under-l" data-animated="bounceIn">Visit us at our humble headquarters: 1691 Kettering Street, Irvine, CA</h1>
        </div>
      </div>
      <div class="row ">
        <div id="about-wrap" class="pad-top">
          <div id="about-desc" class="col-md-12">
            <a style="margin-left: 10%" href="#"><img src="http://maps.googleapis.com/maps/api/staticmap?center=33.697945,-117.846761&zoom=16&size=600x300&maptype=roadmap
&markers=color:red%7Clabel:PeopleSpace%7C33.697945, -117.846761" alt="" data-animated="bounceIn"></a>
          </div>
        </div>
      </div>
    </section>
    <!-- /What Do We Do? -->



    <!-- Stripe Data Input -->
    <h1>Order One Today!</h1>
      <form action="/" method="post" id="example-form" style="display: none;">

        <div class="form-row">
          <label for="name" class="stripeLabel">Your Name</label>
          <input type="text" name="name" class="required" />
        </div>            

        <div class="form-row">
          <label for="email">E-mail Address</label>
          <input type="text" name="email" class="required" />
        </div>            

        <div class="form-row">
          <label>Card Number</label>
          <input type="text" maxlength="20" autocomplete="off" class="card-number stripe-sensitive required" />
        </div>
        
        <div class="form-row">
          <label>CVC</label>
          <input type="text" maxlength="4" autocomplete="off" class="card-cvc stripe-sensitive required" />
        </div>
        
        <div class="form-row">
          <label>Expiration</label>
          <div class="expiry-wrapper">
            <select class="card-expiry-month stripe-sensitive required">
            </select>
            <script type="text/javascript">
              var select = $(".card-expiry-month"),
                month = new Date().getMonth() + 1;
              for (var i = 1; i <= 12; i++) {
                select.append($("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"))
              }
            </script>
            <span> / </span>
            <select class="card-expiry-year stripe-sensitive required"></select>
            <script type="text/javascript">
              var select = $(".card-expiry-year"),
                year = new Date().getFullYear();

              for (var i = 0; i < 12; i++) {
                select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
              }
            </script>
          </div>
        </div>

        <button type="submit" name="submit-button">Submit</button>
        <span class="payment-errors"></span>
      </form>
 
        <!-- 
            The easiest way to indicate that the form requires JavaScript is to show
            the form with JavaScript (otherwise it will not render). You can add a
            helpful message in a noscript to indicate that users should enable JS.
        -->
        <script>if (window.Stripe) $("#example-form").show()</script>
        <noscript><p>JavaScript is required for the registration form.</p></noscript>
    <!-- /Stripe Data Input -->




    <!-- JS -->

    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.sticky.js"></script>
    <script type="text/javascript" src="js/jquery.parallax.js"></script>
    <script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
    <script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="js/jquery.timelinr-0.9.53.js"></script>
    <script type="text/javascript" src="js/jquery.appear.js"></script>
    <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="js/jquery.fitvids.js"></script>
    <script type="text/javascript" src="js/retina.min.js"></script>
    <script type="text/javascript" src="js/supersized.3.2.7.min.js"></script>
    <script type="text/javascript" src="js/supersized.shutter.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script type="text/javascript" src="js/MetroJs.js"></script>
    <script type="text/javascript" src="js/custom.metro.js"></script>
    <script src="js/jquery.superslides.min.js"></script>
    <script src="js/jquery.sudoslider.min.js"></script>
    <script src="js/service-js.js"></script>


  </body>
</html>