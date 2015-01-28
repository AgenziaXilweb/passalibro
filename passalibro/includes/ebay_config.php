<?php

function tep_get_token($type=null,$sede=null){
if($type==null){

echo 'Connessione con eBay non attiva.<br>';
    
} else {
$sql = mysql_query("SELECT customers_id,
       sede,
       cod_chiave,
       piattaforma,
       type,
       storename,
       username,
       password,
       devID,
       appID,
       certID,
       tokenID,
       sessionID,
       merchantID
  FROM passalibroweb.account_external
 WHERE sede = ".$sede." AND piattaforma = 'ebay' AND type = '".$type."';");
  
$result = mysql_fetch_array($sql);    

// API request variables

return array('sede' => $result['sede'],
'type'=>$result['type'],
'cod_chiave'=> $result['cod_chiave'],
'userid' => $result['username'],
'devname' => $result['devID'],
'appname' => $result['appID'],
'certname' => $result['certID'],
'token' => $result['tokenID'],
'siteid' => '101');
}
}

function tep_last_startdate($sede=null){
    
$sql = mysql_query("SELECT products_date_added
  FROM passalibroweb.products 
  WHERE products_ebay = TRUE 
  AND products_sede = ".$sede." 
  ORDER BY products_date_added DESC LIMIT 1");    

    
$result = mysql_fetch_array($sql);

return $result['products_date_added'];    
       
}

function tep_action_db($table, $data, $action = 'insert', $parameters = '') {
    reset($data);
    if ($action == 'insert') {
      $query = 'insert into ' . $table . ' (';
      while (list($columns, ) = each($data)) {
        $query .= $columns . ', ';
      }
      $query = substr($query, 0, -2) . ') values (';
      reset($data);
      while (list(, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= 'now(), ';
            break;
          case 'null':
            $query .= 'null, ';
            break;
          default:
            $query .= '\'' . $value . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
      $query = 'update ' . $table . ' set ';
      while (list($columns, $value) = each($data)) {
        switch ((string)$value) {
          case 'now()':
            $query .= $columns . ' = now(), ';
            break;
          case 'null':
            $query .= $columns .= ' = null, ';
            break;
          default:
            $query .= $columns . ' = \'' . $value . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }

    return mysql_query($query);
  }


?>