<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require(DIR_WS_INCLUDES . 'counter.php');
?>

<div class="grid_24 footer">
  <p><?php echo FOOTER_TEXT_BODY; ?></p>
</div>

<?php
  if ($banner = tep_banner_exists('dynamic', 'piede')) {
?>

<div class="grid_24" style="text-align: center; padding-bottom: 20px;">
  <?php echo tep_display_banner('static', $banner); ?>
</div>

<?php
  }
if(MODULE_WAREHOUSES_MESSAGE_STATUS == 'True'){

    if($dominio['sede']==0 && $_SERVER['HTTP_HOST']==$dominio['hostname']){

            echo '<div id="overlay">';
            echo '<div id="box">';
   
            $messaggio_sql=tep_db_query("SELECT citta, hostname, title, text, image FROM warehouses, messages 
            WHERE warehouses.messages_id = messages.messages_id 
            AND warehouses.sede = messages.sede");
            
            $contents='';
            while($messaggio=tep_db_fetch_array($messaggio_sql)){
            
            $contents .= '<tr><td colspan="2"><a class="other_button" style="width: 85%;" href="http://'.$messaggio['hostname'].'">'.$messaggio['citta'].' - '.$messaggio['text'].'</a></td></tr>';
            $title = '<table width="100%"><tr><td colspan="2"><h1 class="pageHeading">'.$messaggio['title'].'</h1></td></tr>';
            $text = '<tr><td colspan="2">'.$dominio['messaggio'].'</td></tr>';
            $image=$messaggio['image'];
            $width=$messaggio['width'];       
  
            }
            echo $title;
            echo $text;
            echo $contents; 
            echo '</table>';

            echo '<div id="tema-image"><img src="images/passalibro/'.$image.'" width="'.$width.'"/></div>';
            echo '</div>';
            echo '</div>'; 
    
    }
}

?>

<script type="text/javascript">
$('.productListTable tr:nth-child(even)').addClass('alt');
</script>
