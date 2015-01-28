<?php

if($argv){
    
// richieste $argv[n]

$get_call = $argv[1];
$get_sede = $argv[2];
$get_pubblicato = $argv[3];
$get_proposta = $argv[3];
   
}else{

// richieste $_GET['key']

$get_call = $_REQUEST['call'];
$get_sede = $_REQUEST['sede'];
$get_pubblicato = $_REQUEST['pubblicato'];
$get_proposta = $_REQUEST['proposta'];
    
}

?>