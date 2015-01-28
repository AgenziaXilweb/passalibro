<!-- This is the container for the carousel. -->
<div id = "carousel1" style="width:680px; height:330px;overflow:hidden;z-index: 0;">           
<!-- All images with class of "cloudcarousel" will be turned into carousel items -->
<!-- You can place links around these images -->
<?php 
    $queryProdcutsTopTen=tep_db_query("SELECT p.products_id,
                                            p.products_model,
                                            p.products_image,
                                            p.products_price,
                                            p.products_used_price,
                                            pd.products_name
                                        FROM products p JOIN products_description pd USING (products_id)
                                       ORDER BY p.products_ordered DESC
                                        LIMIT 10");
    while($product=tep_db_fetch_array($queryProdcutsTopTen)){        
        $imageProduct=file_exists(DIR_WS_ISBN.$product['products_image'])?DIR_WS_ISBN.$product['products_image']:'images/nopic.png';
        echo '<a href="'.tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['products_id']).'"><img height=150 width=114 class = "cloudcarousel" src="'.$imageProduct.'" alt="'.$product['products_model'].', '.$product['products_name'].'" title="'.$product['products_name'].'" /></a>';
    }
?>          
</div>        
<!-- Define left and right buttons. -->
<!--<input id="left-but"  type="button" value="Left" />-->
<!--<input id="right-but" type="button" value="Right" />-->      
<!-- Define elements to accept the alt and title text from the images. -->