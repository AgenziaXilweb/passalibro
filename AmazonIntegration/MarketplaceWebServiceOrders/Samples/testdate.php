<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 22/04/14
 * Time: 12.07
 */
$today = new DateTime('NOW');
$date = new DateTime($today->format('Y-m-d'));
$date->sub(new DateInterval('P6D'));
echo $date->format('Y-m-d'),PHP_EOL;