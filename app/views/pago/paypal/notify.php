<?php
    $log.=print_r($_POST, true);
    $raw_post_data = file_get_contents('php://input');
    $raw_post_array = explode('&', $raw_post_data);
    $myPost = array();
    foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
    }
    // read the post from PayPal system and add 'cmd'
    $req = 'cmd=_notify-validate';
    if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
    }
    foreach ($myPost as $key => $value) {
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
            $value = urlencode(stripslashes($value));
        } else {
            $value = urlencode($value);
        }
        $req .= "&$key=$value";
    }
    // Post IPN data back to PayPal to validate the IPN data is genuine
    // Without this step anyone can fake IPN data
    if(USE_SANDBOX == true) {
        $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    } else {
        $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
    }
    $ch = curl_init($paypal_url);
    if ($ch == FALSE) {
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    // CONFIG: Optional proxy configuration
    //curl_setopt($ch, CURLOPT_PROXY, $proxy);
    //curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
    // Set TCP timeout to 30 seconds
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
    // CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
    // of the certificate as shown below. Ensure the file is readable by the webserver.
    // This is mandatory for some environments.
    //$cert = __DIR__ . "./cacert.pem";
    //curl_setopt($ch, CURLOPT_CAINFO, $cert);
    $res = curl_exec($ch);
    if (curl_errno($ch) != 0){ // cURL error
        $log.=date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL;
        curl_close($ch);
    } else {
        // Log the entire HTTP response if debug is switched on.
        $log.=date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL;
        $log.=date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL;
        curl_close($ch);
    }
    // Inspect IPN validation result and act accordingly
    // Split response headers and payload, a better way for strcmp
    $tokens = explode("\r\n\r\n", trim($res));
    $res = trim(end($tokens));
    $log.=$res;

    if (strcmp ($res, "VERIFIED") == 0) {
        $token_carrito = $_POST['item_number'];
        if($_POST["payment_status"] == "completed" || $_POST["payment_status"]=="Completed"){
            $estado="pagado";
        } else{
            $estado="pendiente";
        }
        $log.=date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL;
        $log.="estado: $estado - token: $token_carrito";
    }elseif (strcmp ($res, "INVALID") == 0) {
        // log for manual investigation
        // Add business logic here which deals with invalid IPN messages

        $log.=date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL;
    }
?>
