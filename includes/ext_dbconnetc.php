<?php
$myconn = mysql_connect("192.168.4.5","passalibroweb","passa20libro12");
if (!$myconn)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("passalibro", $myconn);
?>