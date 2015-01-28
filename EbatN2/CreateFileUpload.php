<?php

$sql="SELECT if(eb.type = 'u',
          m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u,
          m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n)
          AS new_quantity,
       c.titolo,
       c.autore1,
       c.editore,
       c.descrizione_estesa,
       c.anno_edizione,
       eb.cod_chiave,
       eb.quantity,
       eb.sede,
       eb.type,
       eb.isbn13,
       eb.categoria_ebay,
       eb.stato_uso,
       eb.condizione_ebay,
       eb.prezzo,
       eb.ubicazione,
       eb.proposta,
       eb.ItemID,
       eb.autopay,
       eb.prima_edizione,
       eb.SKU
  FROM ".TABLE_EBAY_PRODUCTS.$param['sede']." eb
       JOIN ".MAGAZZINO_SEDI." m
          USING (cod_chiave, sede)
       JOIN ".CATALOGO." c
          USING (cod_chiave)
 WHERE esito = 'failure'";
  
$query=tep_db_query($sql);

$text_return_policy = 'Accetto la restituzione nei termini di legge che normano questo diritto.ABBIAMO AVUTO DISGUIDI CON LE SPEDIZIONI PIEGO DI LIBRI.RIBADIAMO CHE NON ABBIAMO NESSUN PROBLEMA AD EFFETTUARLE, MA NON CI ASSUMIAMO ALCUNA RESPONSABILITA\' PER MANCATO ARRIVO E PURTROPPO NON RISARCIAMO! CONSIGLIAMO VIVAMENTE LA SPEDIZIONE RACCOMANDATA CHE E\' TRACCIATA!';

$BulkFile = '<?xml version="1.0" encoding="UTF-8"?>
<BulkDataExchangeRequests>
	<Header>
		<SiteID>101</SiteID>
		<Version>663</Version>
	</Header>';

while($results=tep_db_fetch_array($query)){
    
//tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],array('quantity'=>$results['new_quantity']),'update','ItemID = '.$results['ItemID']);
    
$html = 'Titolo: '.$results['titolo'].'<br>';
$html .= 'Condizioni: '.$results['stato_uso'].'<br>';
$html .= 'Ubicazione: '.$results['ubicazione'].'<br>';
$html .= 'Autore: '.$results['autore1'].'<br>';
$html .= 'Editore: '.$results['editore'].'<br>';
$html .= 'ISBN13: '.$results['isbn13'].'<br>'; 
$html .= 'Anno Edizione: '.$results['anno_edizione'].'<br><br>';
$html .= 'SKU: ['.$results['SKU'].']<br>';
   
$BulkFile .= '<AddFixedPriceItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
		<ErrorLanguage>it_IT</ErrorLanguage>
		<WarningLevel>High</WarningLevel>
		<Version>663</Version>
    <MessageID>Request 1</MessageID>
		<Item>
			<SKU>'.$results['SKU'].'</SKU>
			<Country>IT</Country>
			<Currency>EUR</Currency>
			<Description><![CDATA['.$html.']]></Description>
			<DispatchTimeMax>3</DispatchTimeMax>
			<InventoryTrackingMethod>SKU</InventoryTrackingMethod>
			<ListingDuration>'.$DurationTime.'</ListingDuration>
			<ListingType>FixedPriceItem</ListingType>
			<PostalCode>'.$param['cap'].'</PostalCode>
			<PaymentMethods>PayPal</PaymentMethods>
			<PayPalEmailAddress>'.$param['paypal'].'</PayPalEmailAddress>
			<PrimaryCategory>
				<CategoryID>'.$results['categoria_ebay'].'</CategoryID>
			</PrimaryCategory>
			<Quantity>'.$results['quantity'].'</Quantity>
			<StartPrice>'.$results['prezzo'].'</StartPrice>
            <ShippingDetails>
                <ApplyShippingDiscount>false</ApplyShippingDiscount>
                <CalculatedShippingRate>
                <WeightMajor measurementSystem="English" unit="lbs">0</WeightMajor>
                <WeightMinor measurementSystem="English" unit="oz">0</WeightMinor>
                </CalculatedShippingRate>
                <InsuranceFee currencyID="EUR">0.0</InsuranceFee>
                <InsuranceOption>NotOffered</InsuranceOption>
                <SalesTax>
                    <SalesTaxPercent>0.0</SalesTaxPercent>
                    <ShippingIncludedInTax>false</ShippingIncludedInTax>
                </SalesTax>';

$sql_ship = tep_db_query("SELECT ShoppingID,
       sede,
       carrier,
       ShippingService,
       ShippingServiceCost,
       ShippingServiceAdditionalCost,
       WeightMinor,
       WeightMajor
  FROM passalibroweb.shipping_table WHERE sede = ".$param['sede']." AND carrier = 'ebay';");
  
  
$catID = $data['isbn13'] == '' ? '<PrimaryCategory><CategoryID>'.$results['categoria_ebay'].'</CategoryID></PrimaryCategory>' : '';
$image = file_exists('../images/ISBN/'.$results['isbn13'].'.jpg')?'images/ISBN/'.$results['isbn13'].'.jpg':file_exists('../images/ISBN/'.$results['cod_chiave'].'.jpg')?'images/ISBN/'.$results['cod_chiave'].'.jpg':'images/nopic.png';
$text_return_policy = 'Accetto la restituzione nei termini di legge che normano questo diritto.ABBIAMO AVUTO DISGUIDI CON LE SPEDIZIONI PIEGO DI LIBRI.RIBADIAMO CHE NON ABBIAMO NESSUN PROBLEMA AD EFFETTUARLE, MA NON CI ASSUMIAMO ALCUNA RESPONSABILITA\' PER MANCATO ARRIVO E PURTROPPO NON RISARCIAMO! CONSIGLIAMO VIVAMENTE LA SPEDIZIONE RACCOMANDATA CHE E\' TRACCIATA!';
  
while($ship=tep_db_fetch_array($sql_ship)){
   
$BulkFile .= '<ShippingServiceOptions>
					<ShippingServicePriority>1</ShippingServicePriority>
					<ShippingService>'.number_format($ship['ShippingService'],'2','.','').'</ShippingService>
					<ShippingServiceCost>'.number_format($ship['ShippingServiceCost'],'2','.','').'</ShippingServiceCost>
                    <ShippingServiceAdditionalCost>'.number_format($ship['ShippingServiceAdditionalCost'],'2','.','').'</ShippingServiceAdditionalCost>
                    <ExpeditedService>true</ExpeditedService>
                    <ShippingTimeMin>2</ShippingTimeMin>
                    <ShippingTimeMax>4</ShippingTimeMax>
				</ShippingServiceOptions>';

}                
                
$BulkFile .= '</ShippingDetails>
			<Title>'.utf8_decode($results['titolo']).'</Title>
            <PictureDetails> 
                <GalleryType>Gallery</GalleryType>
                <GalleryURL>http://www.passalibro.it/'.$image.'</GalleryURL>
                <PhotoDisplay>None</PhotoDisplay>
                <PictureURL>http://www.passalibro.it/'.$image.'</PictureURL>
            </PictureDetails>
			<ReturnPolicy>
				<ReturnsAcceptedOption>ReturnsAccepted</ReturnsAcceptedOption>
				<RefundOption>MoneyBack</RefundOption>
				<ReturnsWithinOption>Days_14</ReturnsWithinOption>
				<Description>'.$text_return_policy.'</Description>
				<ShippingCostPaidByOption>Buyer</ShippingCostPaidByOption>
			</ReturnPolicy>
		</Item>
	</AddFixedPriceItemRequest>';

} 

$BulkFile .= '</BulkDataExchangeRequests>';

$file="application/UploadFile/AddFixedPriceItem.xml";
$apro=fopen($file,"w+");
fwrite($apro,$BulkFile);
fclose($apro);
$apro2=file($file);
print_r($apro2);

$old_file = "application/UploadFile/AddFixedPriceItem.xml.gz";
$new_file = "application/UploadFile/AddFixedPriceItem.gz";


tep_gzCompressFile($file);
rename($old_file,$new_file);

echo $BulkFile;

?>