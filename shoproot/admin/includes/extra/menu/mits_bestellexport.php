<?php
/**
 * --------------------------------------------------------------
 * File: mits_bestellexport.php
 * Date: 21.07.2017
 * Time: 09:48
 *
 * Author: Hetfield
 * Copyright: (c) 2019 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

if (defined('MODULE_MITS_BESTELLEXPORT_STATUS') && MODULE_MITS_BESTELLEXPORT_STATUS == 'true') {
  $add_contents[BOX_HEADING_TOOLS][] = array(
    'admin_access_name' => 'mits_bestellexport',
    'filename'          => FILENAME_MITS_BESTELLEXPORT,
    'boxname'           => MITS_BOX_BESTELLEXPORT,
    'parameters'        => '',
    'ssl'               => ''
  );
}
