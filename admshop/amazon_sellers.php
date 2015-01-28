<?php
	
 require('includes/application_top.php');
 require(DIR_WS_INCLUDES . 'template_top.php');
 
?>
<script>
  $(function() {
    $( "#radio" ).buttonset();
    $( "#radio" ).checkboxradio("refresh");    
  });
 </script>
<form name="frm_config" method="POST" action="<?php echo $_SERVER['PHP_SELF'].'?action=aws_update' ?>">
<table  border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
        <td colspan="2" class="pageHeading"><?php echo 'Amazon Manager'; ?></td>
    </tr>
    <tr>
        <td style="text-align: left;">
        <span class=""><a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" href="<?php echo $_SERVER['PHP_SELF'].'?action=aws_orders&status=Pending' ?>"role="button"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Sospesi</span></a></span>
        <span class=""><a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" href="<?php echo $_SERVER['PHP_SELF'].'?action=aws_orders&status=UnShipped' ?>"role="button"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">Venduti</span></a></span>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="pageHeading"><?php echo 'Impostazioni'; ?></td>
    </tr>
    <tr>
        <td colspan="2" class="main"><?php echo '(Attenzione, la modifica ha effetto su tutte le sedi)'; ?></td>
    </tr>
    <tr bgcolor="#ebebff">
        <td class="main">Da qui puoi modificare i giorni d'impegno del negozio/web:</td><td>
        
<div id="radio" class="ui-buttonset">

<?php

$sql_checked="SELECT amazonOrdersCreatedAfter FROM ".TABLE_AMAZON_ORDER_STATUS." WHERE active = 1 and amazonOrdersStatusId = 1";

$query_checked=tep_db_query($sql_checked);

$result_checked=tep_db_fetch_array($query_checked);

$x=2;
for($i=1; $i<7;$i++){


$corner=$i==1?'ui-corner-left':$i==7?'ui-corner-right':'';

$checked_true=$result_checked['amazonOrdersCreatedAfter']==$i?'checked="checked"':'';
$class_active=$result_checked['amazonOrdersCreatedAfter']==$i?'ui-state-active':'ui-state-default';

echo '<input class="ui-helper-hidden-accessible" name="days_number" id="radio'.$i.'" type="radio" value="'.$i.'" />
<label for="radio'.$i.'" class="ui-button ui-widget '.$class_active.' ui-button-text-only '.$corner.' '.$checked_true.'" role="button" aria-disabled="false"><span class="ui-button-text">'.$x.' giorni</span></label>';    

$x++;    
}	
?>
<input class="ui-button ui-widget ui-state-default ui-button-text-only" style="padding: 9px 15px 12px 15px;" name="button" id="button" type="submit" value="Modifica"/>       
</div></td>
    </tr>
    <tr>
        <td colspan="2" class="main"></td>
    </tr>
</table>
</form> 
<?php
 
switch($_REQUEST['action']){

case 'aws_update':

$days_number = (int)$_REQUEST['days_number'];

tep_db_perform(TABLE_AMAZON_ORDER_STATUS,array('amazonOrdersCreatedAfter'=>$days_number),'update','active = 1 and amazonOrdersStatusId > 0');

break;
    
case 'aws_orders':

$sql="SELECT amazonOrdersListId,
       amazonOrderId,
       amazonOrderStatus,
       amazonPurchaseDate,
       amazonLastUpdateDate,
       amazonSede
  FROM passalibroweb.amazonOrderList WHERE amazonOrderStatus = '".$_REQUEST['status']."' and amazonSede = ".$_SESSION['admsede'];

$query=tep_db_query($sql);

$field_name=$_REQUEST['status']=='Pending'?'Data fine sospeso':'Data ultimo aggiornamento';

echo '<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr bgcolor="#ebebff" style="text-align: left;">
<th class="main">Amazon Order</th>
<th class="main">Stato dell\'ordine</th>
<th class="main">Data inizio sospeso</th>
<th class="main">'.$field_name.'</th>
</tr><tr><td colspan="4"></td></tr>';

while($result=tep_db_fetch_array($query)){

$day_after=$result_checked['amazonOrdersCreatedAfter'];

$start_date = new DateTime($result['amazonPurchaseDate']);
$last_date = new DateTime($result['amazonLastUpdateDate']);

$stop_date = $result['amazonOrderStatus']=='Pending'?date('d-m-Y', strtotime($last_date->format('d-m-Y') . ' + '.$day_after.' day')):'<b>Venduto il </b>'.$last_date->format('d-m-Y');
   
echo '<tr style="text-align: left;">
<td class="smallText"><span class=""><a class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" href="'.$_SERVER['PHP_SELF'].'?action=aws_orders_details&orders_id='.$result['amazonOrderId'].'""role="button"><span class="ui-button-icon-primary ui-icon ui-icon-plus"></span><span class="ui-button-text">'.$result['amazonOrderId'].'</span></a></span></td>
<td class="smallText">'.$result['amazonOrderStatus'].'</td>
<td class="smallText">'.$start_date->format('d-m-Y').'</td>
<td class="smallText">'.$stop_date.'</td>
</tr>';
   
}

echo '</table>';

break;

case 'aws_orders_details':

$sql="SELECT amazonOrdersListItemsId,
       amazonOrderId,
       amazonASIN,
       amazonOrderItemId,
       amazonSellerSKU,
       amazonItemTitle,
       amazonItemQuantityOrdered,
       amazonConditionId,
       amazonSede
  FROM passalibroweb.amazonOrderListItems WHERE amazonOrderId = '".$_REQUEST['orders_id']."' and amazonSede = ".$admsede;

$query=tep_db_query($sql);

echo '<table border="0" width="100%" cellspacing="0" cellpadding="2">
<tr style="text-align: left;">
<th class="main">Amazon Order</th>
<th class="main">N° SKU</th>
<th class="main">Stato del libro</th>
<th class="main">Quantità</th>
</tr><tr><td colspan="4"></td></tr>';

while($result=tep_db_fetch_array($query)){
  
echo '<tr style="text-align: left;">
<td class="smallText">'.$result['amazonOrderId'].'</td>
<td class="smallText">'.$result['amazonSellerSKU'].'</td>
<td class="smallText">'.$result['amazonConditionId'].'</td>
<td class="smallText">'.$result['amazonItemQuantityOrdered'].'</td>
</tr>';    
    
}
echo '</table>';
break;    
}
 
 require(DIR_WS_INCLUDES . 'template_bottom.php');
 require(DIR_WS_INCLUDES . 'application_bottom.php');    
    
?>