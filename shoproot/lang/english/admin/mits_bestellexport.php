<?php
/**
 * Bestellexport als CSV - (c) Copyright 2010-2017 by Hetfield - www.MerZ-IT-SerVice.de
 *
 * Created by PhpStorm.
 * User: Hetfield
 * Date: 21.07.2017
 * Time: 09:58
 */

define('HEADING_TITLE_BESTELLEXPORT', 'MITS Order export as CSV <small style="font-weight:normal;font-size:0.6em;">&copy; 2010-' . date('Y') . ' by <a href="https://www.merz-it-service.de/" target="_blank">Hetfield</a></small>');
define('HEADING_SUBTITLE_BESTELLEXPORT', '<a href="https://www.merz-it-service.de/" target="_blank">' . xtc_image(DIR_WS_IMAGES . 'merz-it-service.png', '', '', '', ' style="display:block;max-width:100%;height:auto;max-height:40px;margin-top:6px;margin-bottom:6px;"') . '</a>');
define('TEXT_BESTELLEXPORT', 'Export orders from as CSV:');
define('TEXT_DAY', 'Day');
define('TEXT_MONTH', 'Month');
define('TEXT_YEAR', 'Year');
define('TEXT_PAYMENT', 'Payment');
define('TEXT_SHIPPING', 'Shipping');
define('TEXT_ORDER_STATUS', 'Order status');
define('TEXT_EXPORT_BUTTON', 'Export');
define('TEXT_NEW_SEARCH', 'New search &raquo;');
define('ERROR_NO_ORDERS_FOUND', 'No orders found!');
define('ERROR_BESTELLEXPORT_NOT_ACTIVE', 'Modul "MITS Order export as CSV" is not active!');
