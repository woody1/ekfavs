<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Results</title>
</head>
<body>
    <p>Thank you for entering the form.</p>

    <?php
        // reCaptcha info
        $secret = "6LcicCwUAAAAABOCx-sy-A9qmsFmvXOi8LCfKxkf";
        $remoteip = $_SERVER["REMOTE_ADDR"];
        $url = "https://www.google.com/recaptcha/api/siteverify";

        // Form info
        $first = $_POST["first"];
        $last = $_POST["last"];
        $response = $_POST["g-recaptcha-response"];

        // Curl Request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'secret' => $secret,
            'response' => $response,
            'remoteip' => $remoteip
        ));
        $curlData = curl_exec($curl);
        curl_close($curl);

        // Parse data
        $recaptcha = json_decode($curlData, true);
        if ($recaptcha["success"])
            echo "Success!";
        else
            echo "Failure!";
    ?>
</body>
</html>