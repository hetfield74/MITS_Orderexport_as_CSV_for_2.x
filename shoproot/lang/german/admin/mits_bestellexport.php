<?php
/**
 * --------------------------------------------------------------
 * File: mits_bestellexport.php
 * Date: 21.07.2017
 * Time: 09:58
 *
 * Author: Hetfield
 * Copyright: (c) 2019 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

defined('HEADING_TITLE_BESTELLEXPORT') or define('HEADING_TITLE_BESTELLEXPORT', 'MITS Bestellexport als CSV <small style="font-weight:normal;font-size:0.6em;">&copy; 2010-' . date('Y') . ' by <a href="https://www.merz-it-service.de/" target="_blank">Hetfield</a></small>');
defined('HEADING_SUBTITLE_BESTELLEXPORT') or define('HEADING_SUBTITLE_BESTELLEXPORT', '<a href="https://www.merz-it-service.de/" target="_blank">' . xtc_image(DIR_WS_IMAGES . 'merz-it-service.png', '', '', '', ' style="display:block;max-width:100%;height:auto;max-height:40px;margin-top:6px;margin-bottom:6px;"') . '</a>');
defined('TEXT_BESTELLEXPORT') or define('TEXT_BESTELLEXPORT', 'Exportiere die Bestellungen aus folgendem Zeitraum als CSV:');
defined('TEXT_DAY') or define('TEXT_DAY', 'Tag');
defined('TEXT_MONTH') or define('TEXT_MONTH', 'Monat');
defined('TEXT_YEAR') or define('TEXT_YEAR', 'Jahr');
defined('TEXT_PAYMENT') or define('TEXT_PAYMENT', 'Zahlungsart');
defined('TEXT_SHIPPING') or define('TEXT_SHIPPING', 'Versandart');
defined('TEXT_ORDER_STATUS') or define('TEXT_ORDER_STATUS', 'Bestellstatus');
defined('TEXT_EXPORT_BUTTON') or define('TEXT_EXPORT_BUTTON', 'Exportieren');
defined('TEXT_NEW_SEARCH') or define('TEXT_NEW_SEARCH', 'Neue Suche &raquo;');
defined('ERROR_NO_ORDERS_FOUND') or define('ERROR_NO_ORDERS_FOUND', 'Keine Bestellungen gefunden!');
defined('ERROR_BESTELLEXPORT_NOT_ACTIVE') or define('ERROR_BESTELLEXPORT_NOT_ACTIVE', 'Modul "MITS Bestellexport als CSV" ist nicht aktiviert!');
