<?php
/**
 * Bestellexport als CSV - (c) Copyright 2010-2017 by Hetfield - www.MerZ-IT-SerVice.de
 *
 * Created by PhpStorm.
 * User: Hetfield
 * Date: 21.07.2017
 * Time: 09:58
 */

define('HEADING_TITLE_BESTELLEXPORT', 'MITS Bestellexport als CSV <small style="font-weight:normal;font-size:0.6em;">&copy; 2010-' . date('Y') . ' by <a href="https://www.merz-it-service.de/" target="_blank">Hetfield</a></small>');
define('HEADING_SUBTITLE_BESTELLEXPORT', '<a href="https://www.merz-it-service.de/" target="_blank">' . xtc_image(DIR_WS_IMAGES . 'merz-it-service.png', '', '', '', ' style="display:block;max-width:100%;height:auto;max-height:40px;margin-top:6px;margin-bottom:6px;"') . '</a>');
define('TEXT_BESTELLEXPORT', 'Exportiere die Bestellungen aus folgendem Zeitraum als CSV:');
define('TEXT_DAY', 'Tag');
define('TEXT_MONTH', 'Monat');
define('TEXT_YEAR', 'Jahr');
define('TEXT_PAYMENT', 'Zahlungsart');
define('TEXT_SHIPPING', 'Versandart');
define('TEXT_ORDER_STATUS', 'Bestellstatus');
define('TEXT_EXPORT_BUTTON', 'Exportieren');
define('TEXT_NEW_SEARCH', 'Neue Suche &raquo;');
define('ERROR_NO_ORDERS_FOUND', 'Keine Bestellungen gefunden!');
define('ERROR_BESTELLEXPORT_NOT_ACTIVE', 'Modul "MITS Bestellexport als CSV" ist nicht aktiviert!');
