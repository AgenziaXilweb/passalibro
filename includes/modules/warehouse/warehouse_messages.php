<?php

            echo '<div id="sfondo">';
            echo '<div id="holiday" class="pageHeading">';
                     
            $messaggio_sql=tep_db_query("select m.text,m.title from messages m, warehouses w where m.messages_id = w.messages_id and w.sede = ".$dominio['sede']);
            $messaggio=tep_db_fetch_array($messaggio_sql);
            
            echo '<table><tr><td colspan="2"><h1 class="pageHeading">'.$messaggio['title'].'</h1></td></tr>';
            echo '<tr><td colspan="2"></td></tr>';
            
            echo '<tr><td>'.$messaggio['text'].'</td></tr>';   
            echo '</table>';

            echo '<div id="ombrellone"><img src="images/passalibro/buone-vacanze.png" width="50%"/></div>';
            echo '</div>';
            echo '</div>';

?>