<?php
define('HEADING_TITLE', 'Manager Bannere');

define('TABLE_HEADING_BANNERS', 'Bannere');
define('TABLE_HEADING_GROUPS', 'Grupuri');
define('TABLE_HEADING_STATISTICS', 'Nr Vizualizari / Clickuri');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Actiune');

define('TEXT_BANNERS_TITLE', 'Titlu Banner:');
define('TEXT_BANNERS_URL', 'URL Banner:');
define('TEXT_BANNERS_GROUP', 'Grup Banner:');
define('TEXT_BANNERS_NEW_GROUP', ', sau adauga un nou grup de bannere dedesubt');
define('TEXT_BANNERS_IMAGE', 'Imagine:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', sau adauga fisier local dedesubt');
define('TEXT_BANNERS_IMAGE_TARGET', 'Tinta imagine (Salveaza in):');
define('TEXT_BANNERS_HTML_TEXT', 'Text HTML:');
define('TEXT_BANNERS_EXPIRES_ON', 'Expira la:');
define('TEXT_BANNERS_OR_AT', ', sau la');
define('TEXT_BANNERS_IMPRESSIONS', 'impresii/vizualizari.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Programat la:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Note Banner:</b><ul><li>Folositi o imagine sau un fisier HTML text pentru banner - nu amandoua.</li><li>Un text HTML Text are prioritate inainte de o imagine</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Note imagine:</b><ul><li>Pentru a uploada foldere trebuie sa aveti drept de scriere!</li><li>Nu completati campul \'Salveza in\' daca nu uploadati o imagine pe server (daca folositi o imagine stocata deja pe server).</li><li>Campul \'Salveaza in\' trebuie sa fie un folder existent care se incheie cu ghilimea(banner/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Note de Expirare:</b><ul><li>Doar unul din cele 2 campuri trebuie umplut</li><li>Daca nu doriti ca banner-ul sa expire automat, lasati campurile necompletate</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Note de programare:</b><ul><li>Daca o programare e facuta, bannerul va fi activat la data acelei programari.</li><li>Toate banerele programate sunt marcate ca inactive pana la acea data, cand vor fi marcate active.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Data Adaugata:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Programat in: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expira in: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expira in: <b>%s</b> impresii');
define('TEXT_BANNERS_STATUS_CHANGE', 'Schimbare Status: %s');

define('TEXT_BANNERS_DATA', 'D<br />A<br />T<br />A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Ultimele 3 zile');
define('TEXT_BANNERS_BANNER_VIEWS', 'Vizualizari Banner');
define('TEXT_BANNERS_BANNER_CLICKS', 'Clickuri Banner');

define('TEXT_INFO_DELETE_INTRO', 'Sunteti sigur(a) ca doriti sa stergeti acest banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Sterge imaginea bannerului');

define('SUCCESS_BANNER_INSERTED', 'Succes: Banner-ul a fost introdus.');
define('SUCCESS_BANNER_UPDATED', 'Succes: Banner-ul a fost innoit.');
define('SUCCESS_BANNER_REMOVED', 'Succes: Banner-ul a fost sters.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Succes: Statusul banner-ului a fost innoit.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Eroare: Bannerul are nevoie de un titlu.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Eroare: Bannerul are nevoie de un grup.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Eroare: Folderul tinta nu exista: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Eroare: Folderul tinta nu poate fi scris: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Eroare: Imaginea nu exista.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Eroare: Imaginea nu poate fi indepartata.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Eroare: Eroare necunoscuta.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Eroare: Folderul grafic nu exista . Va rog sa creati un folder numit \'graphs\' in folderul \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Eroare: Folderul grafic nu poate fi scris.');
?>