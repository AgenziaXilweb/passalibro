<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  function tep_gest_db_connect($server_gest = DB_SERVER_GEST, $username_gest = DB_SERVER_GET_USERNAME, $password_gest = DB_SERVER_GET_PASSWORD, $database_gest = DB_DATABASE_GEST, $link_gest = 'db_link_gest') {
    global $$link_gest;

    if (USE_PCONNECT == 'true') {
      $$link_gest = mysql_pconnect($server_gest, $username_gest, $password_gest);
    } else {
      $$link_gest = mysql_connect($server_gest, $username_gest, $password_gest);
    }

    if ($$link_gest) mysql_select_db($database_gest);

    return $$link_gest;
  }  

  function tep_gest_db_close($link_gest = 'db_link_gest') {
    global $$link_gest;

    return mysql_close($$link_gest);
  }

  function tep_gest_db_error($query, $errno, $error) { 
    die('<font color="#000000"><strong>' . $errno . ' - ' . $error . '<br /><br />' . $query . '<br /><br /><small><font color="#ff0000">[TEP STOP]</font></small><br /><br /></strong></font>');
  }

  function tep_gest_db_query($query, $link_gest = 'db_link_gest') {
    global $$link_gest;

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
      error_log('QUERY ' . $query . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    $result = mysql_query($query, $$link_gest) or tep_gest_db_error($query, mysql_errno(), mysql_error());

    if (defined('STORE_DB_TRANSACTIONS') && (STORE_DB_TRANSACTIONS == 'true')) {
       $result_error = mysql_error();
       error_log('RESULT ' . $result . ' ' . $result_error . "\n", 3, STORE_PAGE_PARSE_TIME_LOG);
    }

    return $result;
  }

  function tep_gest_db_perform($table, $data, $action = 'insert', $parameters = '', $link_gest = 'db_link_gest') {
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
            $query .= '\'' . tep_gest_db_input($value) . '\', ';
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
            $query .= $columns . ' = \'' . tep_gest_db_input($value) . '\', ';
            break;
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }

    return tep_gest_db_query($query, $link_gest);
  }

  function tep_gest_db_fetch_array($db_query) {
    return mysql_fetch_array($db_query, MYSQL_ASSOC);
  }

  function tep_gest_db_num_rows($db_query) {
    return mysql_num_rows($db_query);
  }

  function tep_gest_db_data_seek($db_query, $row_number) {
    return mysql_data_seek($db_query, $row_number);
  }

  function tep_gest_db_insert_id($link_gest = 'db_link_gest') {
    global $$link_gest;

    return mysql_insert_id($$link_gest);
  }

  function tep_gest_db_free_result($db_query) {
    return mysql_free_result($db_query);
  }

  function tep_gest_db_fetch_fields($db_query) {
    return mysql_fetch_field($db_query);
  }

  function tep_gest_db_output($string) {
    return htmlspecialchars($string);
  }

  function tep_gest_db_input($string, $link_gest = 'db_link_gest') {
    global $$link_gest;

    if (function_exists('mysql_real_escape_string')) {
      return mysql_real_escape_string($string, $$link_gest);
    } elseif (function_exists('mysql_escape_string')) {
      return mysql_escape_string($string);
    }

    return addslashes($string);
  }

  function tep_gest_db_prepare_input($string) {
    if (is_string($string)) {
      return trim(tep_sanitize_string(stripslashes($string)));
    } elseif (is_array($string)) {
      reset($string);
      while (list($key, $value) = each($string)) {
        $string[$key] = tep_gest_db_prepare_input($value);
      }
      return $string;
    } else {
      return $string;
    }
  }
?>
