<?php

echo 'ApiCall: '.$_REQUEST['call'].'<br>';

$test=tep_warhouses('110118540568');

echo 'ItemID: '.$test['model'];

?>