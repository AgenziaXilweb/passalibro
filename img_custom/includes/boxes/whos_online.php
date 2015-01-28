<?
/* canis~lupus © 2008 */ 

 $whos_online_query = tep_db_query("select customer_id, full_name, ip_address, time_entry, time_last_click, last_page_url, session_id from " . TABLE_WHOS_ONLINE);
 

echo '<!-- whos online begin --><div class="box_whos_heading" style="margin:0 0 0 25px">'.BOX_WHOS_ONLINE.'</div>';
echo '<div class="box_whos" style="width:150px;margin:0 0 0 25px">'.BOX_WHOS_ONLINE_TEXT1.'<span style="font-family:tahoma;font-size:11px;color:#EED9C0;font-weight:bold">  '.tep_db_num_rows($whos_online_query).' '.BOX_WHOS_ONLINE_TEXT2.'</span></div><!-- whos online eof -->'
?>