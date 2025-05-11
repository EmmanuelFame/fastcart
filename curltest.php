<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    echo $result;
}
curl_close($ch);
