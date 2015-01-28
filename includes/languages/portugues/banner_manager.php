<?php
define('HEADING_TITLE', 'Gest&atilde;o de Pain&eacute;is');

define('TABLE_HEADING_BANNERS', 'Pain&eacute;is');
define('TABLE_HEADING_GROUPS', 'Grupos');
define('TABLE_HEADING_STATISTICS', 'Visualiza&ccedil;&otilde;es / Cliques');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_ACTION', 'Ac&ccedil;&atilde;o');

define('TEXT_BANNERS_TITLE', 'T&iacute;tulo do painel:');
define('TEXT_BANNERS_URL', 'URL do painel:');
define('TEXT_BANNERS_GROUP', 'Grupo do painel:');
define('TEXT_BANNERS_NEW_GROUP', ', ou digite um novo grupo abaixo');
define('TEXT_BANNERS_IMAGE', 'Imagem:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', ou indique um ficheiro local abaixo');
define('TEXT_BANNERS_IMAGE_TARGET', 'Imagem Destino (Gravar para):');
define('TEXT_BANNERS_HTML_TEXT', 'Texto HTML:');
define('TEXT_BANNERS_EXPIRES_ON', 'Termina em:');
define('TEXT_BANNERS_OR_AT', ', ou com');
define('TEXT_BANNERS_IMPRESSIONS', 'impress&otilde;es/visualiza&ccedil;&otilde;es.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Agendado para:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Notas do painel:</b><ul><li>Utilize uma imagem ou texto HTML para o painel - n&atilde;o ambos.</li><li>O texto HTML tem prioridade sobre a imagem</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Notas da Imagem:</b><ul><li>As pastas para o carregamento t&ecirc;m que ter as permiss&otilde;es de utilizador correctas (escrita)!</li><li>N&atilde;o preencha o item \'Gravar para\' se n&atilde;o for enviar uma imagem para o servidor (isto &eacute;, se estiver a utilizar uma imagem local <i>(serverside)</i> ).</li><li>O item \'Gravar para\' tem que ser uma pasta existente e terminar com barra (ex: banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Notas de t&eacute;rmino:</b><ul><li>Apenas um dos dois items deve ser enviado</li><li>Se o painel n&atilde;o tiver um t&eacute;rmino autom&aacute;tico deixe estes itens vazios.</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Notas do agendamento:</b><ul><li>Se indicar um agendamento, o painel ser&aacute; activado nessa data.</li><li>Todos os pain&eacute;is agendados est&atilde;o assinalados como inactivos at&eacute; &agrave; data assinalada, emque ser&atilde;o marcados coma activos.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Adicionado dia:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Agendado para: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Finaliza em: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Finaliza &agrave;s: <b>%s</b> visualiza&ccedil;&otilde;es');
define('TEXT_BANNERS_STATUS_CHANGE', 'Altera&ccedil;&atilde;o de estado: %s');

define('TEXT_BANNERS_DATA', 'D<br />A<br />T<br />A');
define('TEXT_BANNERS_LAST_3_DAYS', '&Uacute;ltimos 3 dias');
define('TEXT_BANNERS_BANNER_VIEWS', 'Visualiza&ccedil;&otilde;es');
define('TEXT_BANNERS_BANNER_CLICKS', 'Cliques');

define('TEXT_INFO_DELETE_INTRO', 'Tem a certeza que quer apagar este painel?');
define('TEXT_INFO_DELETE_IMAGE', 'Apagar imagem do painel');

define('SUCCESS_BANNER_INSERTED', 'Successo: O painel foi inserido.');
define('SUCCESS_BANNER_UPDATED', 'Successo: O painel foi actualizado.');
define('SUCCESS_BANNER_REMOVED', 'Successo: The O painel foi apagado.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Successo: O estado do painel foi actualizado.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Erro: T&iacute;tulo do painel &eacute; obrigat&oacute;rio!');
define('ERROR_BANNER_GROUP_REQUIRED', 'Erro: Grupo do painel &eacute; obrigat&oacute;rio!');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erro: A pasta de destino %s n&atilde;o existe!');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erro: A pasta de destino %s n&atilde;o pode ser escrita!');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Erro: Imagem n&atilde;o existe!');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Erro: A imagem n&atilde;o pode apagada!');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Erro: Sinaliza&ccedil;&atilde;o de estado desconhecida!');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Erro: A pasta dos gr&aacute;ficos n&atilde;o existe! Crie uma pasta \'graphs\' dentro de \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Erro: A pasta dos gr&aacute;ficos n&atilde;o pode ser escrita!');
?>