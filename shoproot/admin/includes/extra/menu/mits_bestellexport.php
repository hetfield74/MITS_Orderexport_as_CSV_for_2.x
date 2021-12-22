<?php
/**
 * Bestellexport als CSV - (c) Copyright 2010-2017 by Hetfield - www.MerZ-IT-SerVice.de
 *
 * Created by PhpStorm.
 * User: Hetfield
 * Date: 21.07.2017
 * Time: 09:48
 */

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');
if (defined('MODULE_MITS_BESTELLEXPORT_STATUS') && MODULE_MITS_BESTELLEXPORT_STATUS == 'true') {
  $add_contents[BOX_HEADING_TOOLS][] = array(
    'admin_access_name' => 'mits_bestellexport',
    'filename'          => FILENAME_MITS_BESTELLEXPORT,
    'boxname'           => MITS_BOX_BESTELLEXPORT,
    'parameter'         => '',
    'ssl'               => ''
  );
}
