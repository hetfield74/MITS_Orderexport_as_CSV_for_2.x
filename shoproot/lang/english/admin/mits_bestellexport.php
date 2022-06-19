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

defined('HEADING_TITLE_BESTELLEXPORT') or define('HEADING_TITLE_BESTELLEXPORT', 'MITS Order export as CSV <small style="font-weight:normal;font-size:0.6em;">&copy; 2010-' . date('Y') . ' by <a href="https://www.merz-it-service.de/" target="_blank">Hetfield</a></small>');
defined('HEADING_SUBTITLE_BESTELLEXPORT') or define('HEADING_SUBTITLE_BESTELLEXPORT', '<a href="https://www.merz-it-service.de/" target="_blank">' . xtc_image(DIR_WS_IMAGES . 'merz-it-service.png', '', '', '', ' style="display:block;max-width:100%;height:auto;max-height:40px;margin-top:6px;margin-bottom:6px;"') . '</a>');
defined('TEXT_BESTELLEXPORT') or define('TEXT_BESTELLEXPORT', 'Export orders from as CSV:');
defined('TEXT_DAY') or define('TEXT_DAY', 'Day');
defined('TEXT_MONTH') or define('TEXT_MONTH', 'Month');
defined('TEXT_YEAR') or define('TEXT_YEAR', 'Year');
defined('TEXT_PAYMENT') or define('TEXT_PAYMENT', 'Payment');
defined('TEXT_SHIPPING') or define('TEXT_SHIPPING', 'Shipping');
defined('TEXT_ORDER_STATUS') or define('TEXT_ORDER_STATUS', 'Order status');
defined('TEXT_EXPORT_BUTTON') or define('TEXT_EXPORT_BUTTON', 'Export');
defined('TEXT_NEW_SEARCH') or define('TEXT_NEW_SEARCH', 'New search &raquo;');
defined('ERROR_NO_ORDERS_FOUND') or define('ERROR_NO_ORDERS_FOUND', 'No orders found!');
defined('ERROR_BESTELLEXPORT_NOT_ACTIVE') or define('ERROR_BESTELLEXPORT_NOT_ACTIVE', 'Modul "MITS Order export as CSV" is not active!');
