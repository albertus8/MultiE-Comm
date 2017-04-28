<?php
/**
 * Created by albertus
 * Project MultiE-Comm
 * on Apr 2017.
 */
?>
<!doctype html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="<?php echo base_url("assets/css/ext/chck/reset.css"); ?>"> <!-- CSS reset -->
        <link rel="stylesheet" href="<?php echo base_url("assets/css/ext/chck/style.css"); ?>"> <!-- Resource style -->
        <script src="<?php echo base_url("assets/js/ext/chck/modernizr.js"); ?>"></script> <!-- Modernizr -->
        <script type="text/javascript" src="<?php echo base_url("assets/js/ext/bootstrap-collapse.js"); ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">

        <title>Animated Sign Up Flow | CodyHouse</title>
    </head>
    <body>
        <header class="cd-main-header">
            <h1>Animated Sign Up Flow</h1>
        </header>

        <ul class="cd-pricing">
            <li>
                <header class="cd-pricing-header">
                    <h2>Free</h2>
                    <div class="cd-price">
                        <span>IDR 0</span>
                        <span>month</span>
                    </div>
                </header> <!-- .cd-pricing-header -->

                <div class="cd-pricing-features">
                    <ul>
                        <li class="available"><em>Feature 1</em></li>
                        <li><em>Feature 2</em></li>
                        <li><em>Feature 3</em></li>
                        <li><em>Feature 4</em></li>
                    </ul>
                </div> <!-- .cd-pricing-features -->

                <footer class="cd-pricing-footer">
                    <a href="#0">Select</a>
                </footer> <!-- .cd-pricing-footer -->
            </li>

            <li>
                <header class="cd-pricing-header">
                    <h2>Silver</h2>

                    <div class="cd-price">
                        <span>IDR 10.000,00</span>
                        <span>month</span>
                    </div>
                </header> <!-- .cd-pricing-header -->

                <div class="cd-pricing-features">
                    <ul>
                        <li class="available"><em>Feature 1</em></li>
                        <li class="available"><em>Feature 2</em></li>
                        <li><em>Feature 3</em></li>
                        <li><em>Feature 4</em></li>
                    </ul>
                </div> <!-- .cd-pricing-features -->

                <footer class="cd-pricing-footer">
                    <a href="#0">Select</a>
                </footer> <!-- .cd-pricing-footer -->
            </li>

            <li>
                <header class="cd-pricing-header">
                    <h2>Gold</h2>

                    <div class="cd-price">
                        <span>IDR 20.000,00</span>
                        <span>month</span>
                    </div>
                </header> <!-- .cd-pricing-header -->

                <div class="cd-pricing-features">
                    <ul>
                        <li class="available"><em>Feature 1</em></li>
                        <li class="available"><em>Feature 2</em></li>
                        <li class="available"><em>Feature 3</em></li>
                        <li class="available"><em>Feature 4</em></li>
                    </ul>
                </div> <!-- .cd-pricing-features -->

                <footer class="cd-pricing-footer">
                    <a href="#0">Select</a>
                </footer> <!-- .cd-pricing-footer -->
            </li>
        </ul> <!-- .cd-pricing -->

        <div class="cd-form">

            <div class="cd-plan-info">
                <!-- content will be loaded using jQuery - according to the selected plan -->
            </div>

            <div class="cd-more-info">
                <h4>Need help?</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>

            <form action="">
                <fieldset>
                    <legend>Account Info</legend>

                    <div class="half-width">
                        <label for="userName">Name</label>
                        <input type="text" id="userName" name="userName">
                    </div>

                    <div class="half-width">
                        <label for="userEmail">Email</label>
                        <input type="email" id="userEmail" name="userEmail">
                    </div>

                    <div class="half-width">
                        <label for="userPassword">Password</label>
                        <input type="password" id="userPassword" name="userPassword">
                    </div>

                    <div class="half-width">
                        <label for="userPasswordRepeat">Repeat Password</label>
                        <input type="password" id="userPasswordRepeat" name="userPasswordRepeat">
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Payment Method</legend>

                    <div>
                        <ul class="cd-payment-gateways">
                            <li>
                                <input type="radio" name="payment-method" id="paypal" value="paypal">
                                <label for="paypal">Paypal</label>
                            </li>

                            <li>
                                <input type="radio" name="payment-method" id="card" value="card" checked>
                                <label for="card">Card</label>
                            </li>
                        </ul> <!-- .cd-payment-gateways -->
                    </div>

                    <div class="cd-credit-card">
                        <div>
                            <p class="half-width">
                                <label for="cardNumber">Card Number</label>
                                <input type="text" id="cardNumber" name="cardNumber">
                            </p>

                            <p class="half-width">
                                <label>Expiration date</label>
                                <b>
								<span class="cd-select">
									<select name="card-expiry-month" id="card-expiry-month">
										<option value="1">1</option>
										<option value="1">2</option>
										<option value="1">3</option>
										<option value="1">4</option>
										<option value="1">5</option>
										<option value="1">6</option>
										<option value="1">7</option>
										<option value="1">8</option>
										<option value="1">9</option>
										<option value="1">10</option>
										<option value="1">11</option>
										<option value="1">12</option>
									</select>
								</span>

                                    <span class="cd-select">
									<select name="card-expiry-year" id="card-expiry-year">
										<option value="2015">2015</option>
										<option value="2015">2016</option>
										<option value="2015">2017</option>
										<option value="2015">2018</option>
										<option value="2015">2019</option>
										<option value="2015">2020</option>
									</select>
								</span>
                                </b>
                            </p>

                            <p class="half-width">
                                <label for="cardCvc">Card CVC</label>
                                <input type="text" id="cardCvc" name="cardCvc">
                            </p>
                        </div>
                    </div> <!-- .cd-credit-card -->
                </fieldset>

                <fieldset>
                    <div>
                        <input type="submit" value="Get started">
                    </div>
                </fieldset>
            </form>

            <a href="#0" class="cd-close"></a>
        </div> <!-- .cd-form -->

        <!-- Resource jQuery -->
        <div class="cd-overlay"></div> <!-- shadow layer -->
        <script src="<?php echo base_url("assets/js/ext/chck/jquery-2.1.4.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/ext/chck/velocity.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/ext/chck/main.js"); ?>"></script>
    </body>
</html>
