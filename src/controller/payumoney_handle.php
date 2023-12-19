<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['payumoney_btn'])) {

        $user_id = $_POST['user_id'];
        $address_id = $_POST['address_id'];
        $invoice_number = $_POST['invoice_number'];
        $tracking_id = $_POST['tracking_id'];
        $total_price = $_POST['grand_total'];
        $total_products = $_POST['total_products'];
        $user_email = $_POST['email_id'];
        $user_name = $_POST['fname'];
        $html = '';

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
            //generate hash with mandatory parameters and udf5
            $hash = hash('sha512', $key . '|' . $_POST['txnid'] . '|' . $_POST['amount'] . '|' . $_POST['productinfo'] . '|' . $_POST['firstname'] . '|' . $_POST['email'] . '|||||' . $_POST['udf5'] . '||||||' . $salt);

            $_SESSION['salt'] = $salt; //save salt in session to use during Hash validation in response

            $html = '<form action="' . $action . '" id="payment_form_submit" method="post">
			<input type="hidden" id="udf5" name="udf5" value="' . $_POST['udf5'] . '" />
			<input type="hidden" id="surl" name="surl" value="' . getCallbackUrl() . '" />
			<input type="hidden" id="furl" name="furl" value="' . getCallbackUrl() . '" />
			<input type="hidden" id="curl" name="curl" value="' . getCallbackUrl() . '" />
			<input type="hidden" id="key" name="key" value="' . $key . '" />
			<input type="hidden" id="txnid" name="txnid" value="' . $_POST['txnid'] . '" />
			<input type="hidden" id="amount" name="amount" value="' . $_POST['amount'] . '" />
			<input type="hidden" id="productinfo" name="productinfo" value="' . $_POST['productinfo'] . '" />
			<input type="hidden" id="firstname" name="firstname" value="' . $_POST['firstname'] . '" />
			<input type="hidden" id="Lastname" name="Lastname" value="' . $_POST['Lastname'] . '" />
			<input type="hidden" id="Zipcode" name="Zipcode" value="' . $_POST['Zipcode'] . '" />
			<input type="hidden" id="email" name="email" value="' . $_POST['email'] . '" />
			<input type="hidden" id="phone" name="phone" value="' . $_POST['phone'] . '" />
			<input type="hidden" id="address1" name="address1" value="' . $_POST['address1'] . '" />
			<input type="hidden" id="address2" name="address2" value="' . (isset($_POST['address2']) ? $_POST['address2'] : '') . '" />
			<input type="hidden" id="city" name="city" value="' . $_POST['city'] . '" />
			<input type="hidden" id="state" name="state" value="' . $_POST['state'] . '" />
			<input type="hidden" id="country" name="country" value="' . $_POST['country'] . '" />
			<input type="hidden" id="Pg" name="Pg" value="' . $_POST['Pg'] . '" />
			<input type="hidden" id="hash" name="hash" value="' . $hash . '" />
			</form>
			<script type="text/javascript"><!--
				document.getElementById("payment_form_submit").submit();	
			//-->
			</script>';

        }
        function getCallbackUrl()
        {
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $uri = str_replace('/index.php', '/', $_SERVER['REQUEST_URI']);
            return $protocol . $_SERVER['HTTP_HOST'] . $uri . 'response.php';
        }
        ?>

        <div class="main">
            <div>
                <img src="images/logo.png" />
            </div>
            <div>
                <h3>PayUBiz PHP7 Kit</h3>
            </div>
            <!-- Form Block //-->
            <span style="float:left; display:inline-block;">
                <!--// Form with required parameters to be posted to Payment Gateway. For details of each required 
            parameters refer Integration PDF. //-->
                <form action="" id="payment_form" method="post">

                    <!-- Contains information of integration type. Consult to PayU for more details.//-->
                    <input type="hidden" id="udf5" name="udf5" value="PayUBiz_PHP7_Kit" />

                    <div class="dv">
                        <span class="text"><label>Transaction/Order ID:</label></span>
                        <span>
                            <!-- Required - Unique transaction id or order id to identify and match 
                payment with local invoicing. Datatype is Varchar with a limit of 25 char. //-->
                            <input type="text" id="txnid" name="txnid" placeholder="Transaction ID"
                                value="<?php echo "Txn" . rand(10000, 99999999) ?>" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Amount:</label></span>
                        <span>
                            <!-- Required - Transaction amount of float type. //-->
                            <input type="text" id="amount" name="amount" placeholder="Amount" value="6.00" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Product Info:</label></span>
                        <span>
                            <!-- Required - Purchased product/item description or SKUs for future reference. 
                Datatype is Varchar with 100 char limit. //-->
                            <input type="text" id="productinfo" name="productinfo" placeholder="Product Info"
                                value="P01,P02" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>First Name:</label></span>
                        <span>
                            <!-- Required - Should contain first name of the consumer. Datatype is Varchar with 60 char limit. //-->
                            <input type="text" id="firstname" name="firstname" placeholder="First Name" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Last Name:</label></span>
                        <span>
                            <!-- Should contain last name of the consumer. Datatype is Varchar with 50 char limit. //-->
                            <input type="text" id="Lastname" name="Lastname" placeholder="Last Name" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Zip Code:</label></span>
                        <span>
                            <!-- Datatype is Varchar with 20 char limit only 0-9. //-->
                            <input type="text" id="Zipcode" name="Zipcode" placeholder="Zip Code" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Email ID:</label></span>
                        <span>
                            <!-- Required - An email id in valid email format has to be posted. Datatype is Varchar with 50 char limit. //-->
                            <input type="text" id="email" name="email" placeholder="Email ID" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Mobile/Cell Number:</label></span>
                        <span>
                            <!-- Required - Datatype is Varchar with 50 char limit and must contain chars 0 to 9 only. 
                This parameter may be used for land line or mobile number as per requirement of the application. //-->
                            <input type="text" id="phone" name="phone" placeholder="Mobile/Cell Number" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Address1:</label></span>
                        <span>
                            <input type="text" id="address1" name="address1" placeholder="Address1" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Address2:</label></span>
                        <span>
                            <input type="text" id="address2" name="address2" placeholder="Address2" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>City:</label></span>
                        <span>
                            <input type="text" id="city" name="city" placeholder="City" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>State:</label></span>
                        <span><input type="text" id="state" name="state" placeholder="State" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>Country:</label></span>
                        <span><input type="text" id="country" name="country" placeholder="Country" value="" /></span>
                    </div>

                    <div class="dv">
                        <span class="text"><label>PG:</label></span>
                        <span>
                            <!-- Not mandatory but fixed code can be passed to Payment Gateway to show default payment 
                option tab. e.g. NB, CC, DC, CASH, EMI. Refer PDF for more details. //-->
                            <input type="text" id="Pg" name="Pg" placeholder="PG" value="CC" /></span>
                    </div>

                    <div><input type="button" id="btnsubmit" name="btnsubmit" value="Pay" onclick="frmsubmit(); return true;" />
                    </div>
                </form>
            </span>


            <?php if ($html)
                echo $html; //submit request to PayUBiz  ?>


        </div> <!-- End of Main Div //-->

        <?php
        $key = "";
        $salt = "";
        $mode = "test";     //you can give test or live

        $success_url = "";
        $failed_url = "";
        $cancelled_url = "";

        if ($mode == 'live') {
            $action = 'https://secure.payu.in/_payment';
        } else {
            $action = 'https://test.payu.in/_payment';
            $key = "oZ7oo9";
            $salt = "UkojH5TS";
        }
    }
}


?>