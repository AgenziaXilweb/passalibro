<?php
/**
 * Created by PhpStorm.
 * User: fabio
 * Date: 18/06/14
 * Time: 11.29
 */

function mysql_query_($query)
{
    include "pass1.php";
    $curdate = date("d-m-Y H:i:s");
    if(mysql_query($query) == true)
    {
        if(substr(strtoupper($query),0,6) == 'INSERT' || substr(strtoupper($query),0,5) == 'UPDATE' || substr(strtoupper($query),0,5) == 'DELETE')
        {
            $fp=fopen("trans.sql","a");
            if($fp==null)
            {

                die("File cannot be opened. Try again !!!");
            }
            $printline = "/* $curdate : */ $query ;";
            fprintf($fp,"\r\n%s",$printline);
            fclose($fp);
            return true;
        }
        else
        {
            return mysql_query($query);
        }
    }
    else
    {
        $error = mysql_error();
        $error = addslashes($error);
        $query = addslashes($query);
        mysql_query("insert into errorlog values('$query','$error')");
        return false;
    }
}
?>