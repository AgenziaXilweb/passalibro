<?php

    $id="97423388";
    $password="Passa20libro12";
    $action="4";
    $amt="1.00";
    $currencycode="978";
    $langid="ITA";
    $responseurl="http://www1.passalibro.com/setefi/notify.php";
    $errorurl="http://www1.passalibro.com/setefi/error.php";
    $trackid="TRCK0001";
    $udf1="test di pagamento a test.setefi_moneta_online";
    $data="id=$id&password=$password&action=$action&amt=$amt&currencycode=$currencycode&langid=$langid&responseurl=$responseurl&errorurl=$errorurl&trackid=$trackid&udf1=$udf1";
    $curl_handle=curl_init();
    curl_setopt($curl_handle,CURLOPT_URL,'https://test.monetaonline.it/monetaweb/hosted/init/http');
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl_handle, CURLOPT_POST, 1);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
    $buffer = curl_exec($curl_handle);
    curl_close($curl_handle);
    $token=explode(":",$buffer,2);
    $tid=$token[0];
    $paymenturl=$token[1];
    echo"<a href=\"$paymenturl?PaymentID=$tid\">Buy now</a>";

?>