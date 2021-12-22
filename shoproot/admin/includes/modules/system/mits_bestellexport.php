<?php
/**
 * Bestellexport als CSV - (c) Copyright 2010-2017 by Hetfield - www.MerZ-IT-SerVice.de
 *
 * Created by PhpStorm.
 * User: Hetfield
 * Date: 21.07.2017
 * Time: 09:45
 */

defined('_VALID_XTC') or die('Direct Access to this location is not allowed.');

class mits_bestellexport {
  var $code, $title, $description, $enabled;

  function __construct() {
    $this->code = 'mits_bestellexport';
    $this->title = constant('MODULE_' . strtoupper($this->code) . '_TEXT_TITLE');
    $this->description = constant('MODULE_' . strtoupper($this->code) . '_TEXT_DESCRIPTION');
    $this->sort_order = defined('MODULE_' . strtoupper($this->code) . '_SORT_ORDER') ? constant('MODULE_' . strtoupper($this->code) . '_SORT_ORDER') : 0;
    $this->enabled = ((constant('MODULE_' . strtoupper($this->code) . '_STATUS') == 'true') ? true : false);
  }

  function process($file) {
    if (isset($_POST['configuration']) && $_POST['configuration']['MODULE_MITS_BESTELLEXPORT_STATUS'] == 'true') {
      //xtc_redirect(xtc_href_link(FILENAME_MITS_BESTELLEXPORT));
    }
  }

  function display() {
    return array(
      'text' => '<br /><div align="center">' . xtc_button(BUTTON_SAVE) .
        xtc_button_link(BUTTON_CANCEL, xtc_href_link(FILENAME_MODULE_EXPORT, 'set=' . $_GET['set'] . '&module=mits_bestellexport')) . "</div>");
  }

  function check() {
    if (!isset($this->_check)) {
      $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_MITS_BESTELLEXPORT_STATUS'");
      $this->_check = xtc_db_num_rows($check_query);
    }
    return $this->_check;
  }

  function install() {
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('MODULE_MITS_BESTELLEXPORT_STATUS', 'true',  '6', '1', 'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("ALTER TABLE " . TABLE_ADMIN_ACCESS . " ADD `mits_bestellexport` INT(1) NOT NULL DEFAULT '0'");
    xtc_db_query("UPDATE " . TABLE_ADMIN_ACCESS . " SET `mits_bestellexport` = 1");
  }

  function remove() {
    xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key in ('" . implode("', '", $this->keys()) . "')");
    xtc_db_query("ALTER TABLE " . TABLE_ADMIN_ACCESS . " DROP COLUMN `mits_bestellexport`");
  }

  function keys() {
    $key = array('MODULE_MITS_BESTELLEXPORT_STATUS');

    return $key;
  }
}

?>