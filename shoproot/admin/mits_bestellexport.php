<?php
/**
 * Bestellexport als CSV - (c) Copyright 2010-2018 by Hetfield - www.MerZ-IT-SerVice.de
 *
 * Created by PhpStorm.
 * User: Hetfield
 * Date: 21.07.2017
 * Time: 09:40
 */

require('includes/application_top.php');
if (defined('MODULE_MITS_BESTELLEXPORT_STATUS') && MODULE_MITS_BESTELLEXPORT_STATUS == 'true') {
  $fehler = 0;
  if (isset($_POST['action']) && $_POST['action'] == 'export') {

    $start = $_POST['startyear'] . '-' . $_POST['startmonth'] . '-' . $_POST['startday'] . ' 00:00:00';  // Startdatum im datetime-Format zusammensetzen 0000-00-00 00:00:00
    $end = $_POST['endyear'] . '-' . $_POST['endmonth'] . '-' . $_POST['endday'] . ' 00:00:00';  // Enddatum im datetime-Format zusammensetzen
    if ($_POST['status'] != '-1') {
      $orderstatus = ' AND orders_status = "' . xtc_db_input($_POST['status']) . '"';
    }
    if ($_POST['payment_art'] != '1') {
      $payment = ' AND payment_class = "' . xtc_db_input($_POST['payment_art']) . '"';
    }
    if ($_POST['shipping_art'] != '1') {
      $shipping = ' AND shipping_class = "' . xtc_db_input($_POST['shipping_art']) . '"';
    }

    $orders_query = xtc_db_query('SELECT * FROM ' . TABLE_ORDERS . ' WHERE (date_purchased BETWEEN "' . xtc_db_input($start) . '" AND "' . xtc_db_input($end) . '") ' . $payment . $shipping . $orderstatus . ' ORDER BY orders_id ASC');

    if (xtc_db_num_rows($orders_query)) {

      $exportdata = '"Bestellnummer";';
      $exportdata .= '"Datum";';
      $exportdata .= '"Kundennr.";';
      $exportdata .= '"Firma";';
      $exportdata .= '"Vorname";';
      $exportdata .= '"Nachname";';
      $exportdata .= '"Strasse";';
      $exportdata .= '"Adresszusatz";';
      $exportdata .= '"PLZ";';
      $exportdata .= '"Stadt";';
      $exportdata .= '"Bundesland";';
      $exportdata .= '"Land";';
      $exportdata .= '"Telefon";';
      $exportdata .= '"E-Mail-Adresse";';
      $exportdata .= '"Firma (Lieferanschrift)";';
      $exportdata .= '"Vorname (Lieferanschrift)";';
      $exportdata .= '"Nachname (Lieferanschrift)";';
      $exportdata .= '"Strasse (Lieferanschrift)";';
      $exportdata .= '"Adresszusatz (Lieferanschrift)";';
      $exportdata .= '"PLZ (Lieferanschrift)";';
      $exportdata .= '"Stadt (Lieferanschrift)";';
      $exportdata .= '"Bundesland (Lieferanschrift)";';
      $exportdata .= '"Land (Lieferanschrift)";';
      $exportdata .= '"Firma (Rechnungsanschrift)";';
      $exportdata .= '"Vorname (Rechnungsanschrift)";';
      $exportdata .= '"Nachname (Rechnungsanschrift)";';
      $exportdata .= '"Strasse (Rechnungsanschrift)";';
      $exportdata .= '"Adresszusatz (Rechnungsanschrift)";';
      $exportdata .= '"PLZ (Rechnungsanschrift)";';
      $exportdata .= '"Stadt (Rechnungsanschrift)";';
      $exportdata .= '"Bundesland (Rechnungsanschrift)";';
      $exportdata .= '"Land (Rechnungsanschrift)";';
      $exportdata .= '"Anzahl bestellte Artikel";';
      $exportdata .= '"Versandstatus";';
      $exportdata .= '"Versandmethode";';
      $exportdata .= '"Zahlungsmethode";';
      $exportdata .= '"W&#xE4;hrung";';
      $exportdata .= '"Nettobtrag";';
      $exportdata .= '"Versandkosten";';
      if (defined('MODULE_ORDER_TOTAL_COD_FEE_STATUS') && MODULE_ORDER_TOTAL_COD_FEE_STATUS == 'true') {
        $exportdata .= '"Nachnahmegeb&#xFChr";';
      }
      $exportdata .= '"Umsatzsteuer";';
      $exportdata .= '"Bruttobetrag";';
      $exportdata .= chr(13);

      while ($orders = xtc_db_fetch_array($orders_query)) {

        $paymethod = $orders['payment_class'];
        if ($orders['payment_class'] != '' && $orders['payment_class'] != 'no_payment') {
          if (file_exists(DIR_FS_LANGUAGES . $orders['language'] . '/modules/payment/' . $orders['payment_class'] . '.php') && is_file(DIR_FS_LANGUAGES . $orders['language'] . '/modules/payment/' . $orders['payment_class'] . '.php')) {
            include(DIR_FS_LANGUAGES . $orders['language'] . '/modules/payment/' . $orders['payment_class'] . '.php');
            $paymethod = strip_tags(constant(strtoupper('MODULE_PAYMENT_' . $orders['payment_class'] . '_TEXT_TITLE')));
          }
        }

        $versandstatus_query = xtc_db_query('SELECT orders_status_name FROM ' . TABLE_ORDERS_STATUS . ' WHERE orders_status_id = ' . (int)$orders['orders_status'] . ' AND language_id = ' . (int)$_SESSION['languages_id']);
        if (xtc_db_num_rows($versandstatus_query)) {
          $versandstatus = xtc_db_fetch_array($versandstatus_query);
          $orders_status_name = $versandstatus['orders_status_name'];
        } else {
          $orders_status_name = '';
        }

        $anzahlprodukte_query = xtc_db_query('SELECT products_quantity FROM ' . TABLE_ORDERS_PRODUCTS . ' WHERE orders_id = ' . (int)$orders['orders_id']);
        $anzahl = '0';
        if (xtc_db_num_rows($anzahlprodukte_query)) {
          while ($anzahlprodukte = xtc_db_fetch_array($anzahlprodukte_query)) {
            $anzahl = $anzahl + $anzahlprodukte['products_quantity'];
          }
        }

        $exportdata .= '"' . $orders['orders_id'] . '";';
        $exportdata .= '"' . xtc_datetime_short($orders['date_purchased']) . '";';
        $exportdata .= '"' . $orders['customers_cid'] . '";';
        $exportdata .= '"' . $orders['customers_company'] . '";';
        $exportdata .= '"' . $orders['customers_firstname'] . '";';
        $exportdata .= '"' . $orders['customers_lastname'] . '";';
        $exportdata .= '"' . $orders['customers_street_address'] . '";';
        $exportdata .= '"' . $orders['customers_suburb'] . '";';
        $exportdata .= '"' . $orders['customers_postcode'] . '";';
        $exportdata .= '"' . $orders['customers_city'] . '";';
        $exportdata .= '"' . $orders['customers_state'] . '";';
        $exportdata .= '"' . $orders['customers_country'] . '";';
        $exportdata .= '"' . $orders['customers_telephone'] . '";';
        $exportdata .= '"' . $orders['customers_email_address'] . '";';
        $exportdata .= '"' . $orders['delivery_company'] . '";';
        $exportdata .= '"' . $orders['delivery_firstname'] . '";';
        $exportdata .= '"' . $orders['delivery_lastname'] . '";';
        $exportdata .= '"' . $orders['delivery_street_address'] . '";';
        $exportdata .= '"' . $orders['delivery_suburb'] . '";';
        $exportdata .= '"' . $orders['delivery_postcode'] . '";';
        $exportdata .= '"' . $orders['delivery_city'] . '";';
        $exportdata .= '"' . $orders['delivery_state'] . '";';
        $exportdata .= '"' . $orders['delivery_country'] . '";';
        $exportdata .= '"' . $orders['billing_company'] . '";';
        $exportdata .= '"' . $orders['billing_firstname'] . '";';
        $exportdata .= '"' . $orders['billing_lastname'] . '";';
        $exportdata .= '"' . $orders['billing_street_address'] . '";';
        $exportdata .= '"' . $orders['billing_suburb'] . '";';
        $exportdata .= '"' . $orders['billing_postcode'] . '";';
        $exportdata .= '"' . $orders['billing_city'] . '";';
        $exportdata .= '"' . $orders['billing_state'] . '";';
        $exportdata .= '"' . $orders['billing_country'] . '";';
        $exportdata .= '"' . $anzahl . '";';
        $exportdata .= '"' . $orders_status_name . '";';
        $exportdata .= '"' . $orders['shipping_method'] . '";';
        $exportdata .= '"' . $paymethod . '";';
        $exportdata .= '"' . $orders['currency'] . '";';

        $ot_tax_value = '0';
        $ot_total_value = '0';
        $ot_shipping_value = '0';
        $ot_cod_value = '0';
        $orders_total_query = xtc_db_query('SELECT * FROM ' . TABLE_ORDERS_TOTAL . ' WHERE orders_id = ' . (int)$orders['orders_id']);
        if (xtc_db_num_rows($orders_total_query)) {
          while ($orders_total = xtc_db_fetch_array($orders_total_query)) {
            if ($orders_total['class'] == 'ot_tax') {
              $ot_tax_value .= $ot_tax_value + $orders_total['value'];
            } elseif ($orders_total['class'] == 'ot_total') {
              $ot_total_value = $orders_total['value'];
            } elseif ($orders_total['class'] == 'ot_shipping') {
              $ot_shipping_value = $orders_total['value'];
            } elseif ($orders_total['class'] == 'ot_cod_fee') {
              $ot_cod_value = $orders_total['value'];
            }
          }
        }
        $ot_subtotal_value = $ot_total_value - $ot_tax_value;

        $exportdata .= '"' . number_format($ot_subtotal_value, 2, ",", ".") . '";';
        $exportdata .= '"' . number_format($ot_shipping_value, 2, ",", ".") . '";';
        if (defined('MODULE_ORDER_TOTAL_COD_FEE_STATUS') && MODULE_ORDER_TOTAL_COD_FEE_STATUS == 'true') {
          $exportdata .= '"' . number_format($ot_cod_value, 2, ",", ".") . '";';
        }
        $exportdata .= '"' . number_format($ot_tax_value, 2, ",", ".") . '";';
        $exportdata .= '"' . number_format($ot_total_value, 2, ",", ".") . '";';
        $exportdata .= chr(13);

      }
      $filename = 'bestellungen_' . $_POST['startyear'] . $_POST['startmonth'] . $_POST['startday'] . '-' . $_POST['endyear'] . $_POST['endmonth'] . $_POST['endday'] . '.csv';
      header('content-type: application/csv');
      //header('content-length: ' . strlen($exportdata));
      header('content-disposition: attachment; filename=' . $filename);
      if (defined('DB_SERVER_CHARSET') && DB_SERVER_CHARSET == 'utf8') {
        echo strip_tags(html_entity_decode($exportdata));
      } else {
        echo utf8_encode(strip_tags(html_entity_decode($exportdata)));
      }
      exit;
    } else {
      $fehler = 1;
    }
  }
}
require(DIR_WS_INCLUDES . 'head.php');
?>
  <style type="text/css"><!--
    label {
      cursor: pointer;
    }

    --></style></head>
  <body>
  <!-- header //-->
  <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
  <!-- header_eof //-->

  <!-- body //-->
  <table class="tableBody">
    <tr>
      <?php //left_navigation
      if (USE_ADMIN_TOP_MENU == 'false') {
        echo '<td class="columnLeft2">' . PHP_EOL;
        echo '<!-- left_navigation //-->' . PHP_EOL;
        require_once(DIR_WS_INCLUDES . 'column_left.php');
        echo '<!-- left_navigation eof //-->' . PHP_EOL;
        echo '</td>' . PHP_EOL;
      }
      ?>
      <!-- body_text //-->
      <td class="boxCenter">
        <div class="pageHeadingImage"><?php echo xtc_image(DIR_WS_ICONS . 'heading/icon_statistic.png'); ?></div>
        <div class="flt-l">
          <div class="pageHeading"><?php echo HEADING_TITLE_BESTELLEXPORT; ?></div>
          <div class="main pdg2 flt-l"><?php echo HEADING_SUBTITLE_BESTELLEXPORT; ?></div>
        </div>
        <table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableCenter">
          <tr>
            <td class="main">
              <!-- inhalt //--><br />
              <?php
              if (MODULE_MITS_BESTELLEXPORT_STATUS == 'true') {
                if ($fehler == 1) {
                  ?>
                  <h2><?php echo ERROR_NO_ORDERS_FOUND; ?></h2><h2>
                    <a href="<?php xtc_href_link(FILENAME_MITS_BESTELLEXPORT); ?>" class="button"><?php echo TEXT_NEW_SEARCH; ?></a>
                  </h2>
                  <?php
                } else {
                  ?>
                  <br />
                  <?php echo xtc_draw_form('new_bestellexport', FILENAME_MITS_BESTELLEXPORT, '', 'post', ''); ?>
                  <fieldset>
                    <legend><strong> <?php echo TEXT_BESTELLEXPORT; ?> </strong></legend>
                    <?php
                    $startday = array();
                    for ($z = 1, $m = 32; $z < $m; $z++) $startday[] = array('id' => str_pad($z, 2, '0', STR_PAD_LEFT), 'text' => str_pad($z, 2, '0', STR_PAD_LEFT));
                    echo ' <label for="startday">' . TEXT_DAY . ': </label> ' . xtc_draw_pull_down_menu('startday', $startday, date('d'), 'id="startday"');

                    $startmonth = array();
                    for ($z = 1, $m = 13; $z < $m; $z++) $startmonth[] = array('id' => str_pad($z, 2, '0', STR_PAD_LEFT), 'text' => str_pad($z, 2, '0', STR_PAD_LEFT));
                    echo ' <label for="startmonth">' . TEXT_MONTH . ': </label> ' . xtc_draw_pull_down_menu('startmonth', $startmonth, (date('m') - 1), 'id="startmonth"');

                    $year = date('Y');
                    $startyear = array();
                    for ($z = $year - 30, $m = $year + 1; $z < $m; $z++) $startyear[] = array('id' => $z, 'text' => $z);
                    echo ' <label for="startyear">' . TEXT_YEAR . ': </label> ' . xtc_draw_pull_down_menu('startyear', $startyear, date('Y'), 'id="startyear"');

                    echo '<br /><br />';

                    $endday = array();
                    for ($z = 1, $m = 32; $z < $m; $z++) $endday[] = array('id' => str_pad($z, 2, '0', STR_PAD_LEFT), 'text' => str_pad($z, 2, '0', STR_PAD_LEFT));
                    echo ' <label for="endday">' . TEXT_DAY . ': </label> ' . xtc_draw_pull_down_menu('endday', $endday, date('d'), 'id="endday"');

                    $endmonth = array();
                    for ($z = 1, $m = 13; $z < $m; $z++) $endmonth[] = array('id' => str_pad($z, 2, '0', STR_PAD_LEFT), 'text' => str_pad($z, 2, '0', STR_PAD_LEFT));
                    echo ' <label for="endmonth">' . TEXT_MONTH . ': </label>' . xtc_draw_pull_down_menu('endmonth', $endmonth, date('m'), 'id="endmonth"');

                    $endyear = array();
                    for ($z = $year - 30, $m = $year + 1; $z < $m; $z++) $endyear[] = array('id' => $z, 'text' => $z);
                    echo ' <label for="endyear">' . TEXT_YEAR . ': </label>' . xtc_draw_pull_down_menu('endyear', $endyear, date('Y'), 'id="endyear"');

                    echo '<br /><br />';
                    $payments = explode(';', MODULE_PAYMENT_INSTALLED);
                    echo ' <label for="payment_art">' . TEXT_PAYMENT . ': </label>';
                    $pay_art = array();
                    $pay_art[] = array('id' => '1', 'text' => 'alle');
                    for ($i = 0; $i < count($payments); $i++) {
                      $pay = substr($payments[$i], 0, strrpos($payments[$i], '.'));
                      if (file_exists(DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $payments[$i]) && is_file(DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $payments[$i])) {
                        require(DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $payments[$i]);
                        $payment_text = constant(MODULE_PAYMENT_ . strtoupper($pay) . _TEXT_TITLE);
                      } else {
                        $payment_text = $pay;
                      }
                      $pay_art[] = array('id' => $pay, 'text' => $payment_text);
                    }
                    echo xtc_draw_pull_down_menu('payment_art', $pay_art, 1, 'id="payment_art"');

                    echo '<br /><br />';
                    $shippings = explode(';', MODULE_SHIPPING_INSTALLED);
                    echo ' <label for="shipping_art">' . TEXT_SHIPPING . ': </label>';
                    $ship_art = array();
                    $ship_art[] = array('id' => '1', 'text' => 'alle');
                    for ($i = 0; $i < count($shippings); $i++) {
                      $ship = substr($shippings[$i], 0, strrpos($shippings[$i], '.'));
                      if (file_exists(DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/shipping/' . $shippings[$i]) && is_file(DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/shipping/' . $shippings[$i])) {
                        require(DIR_FS_LANGUAGES . $_SESSION['language'] . '/modules/shipping/' . $shippings[$i]);
                        $shipping_text = constant(MODULE_SHIPPING_ . strtoupper($ship) . _TEXT_TITLE);
                      } else {
                        $shipping_text = $ship;
                      }
                      $ship_art[] = array('id' => $ship, 'text' => $shipping_text);
                    }
                    echo xtc_draw_pull_down_menu('shipping_art', $ship_art, 1, 'id="shipping_art"');

                    echo '<br /><br />';
                    echo ' <label for="status">' . TEXT_ORDER_STATUS . ': </label>';
                    $statusarray = array();
                    $statusarray[] = array('id' => '-1', 'text' => 'alle');
                    $status_query = xtc_db_query('SELECT orders_status_id, orders_status_name FROM ' . TABLE_ORDERS_STATUS . ' WHERE language_id = "' . xtc_db_input((int)$_SESSION['languages_id']) . '"');
                    if (xtc_db_num_rows($status_query)) {
                      while ($statuse = xtc_db_fetch_array($status_query)) {
                        $statusarray[] = array('id' => $statuse['orders_status_id'], 'text' => $statuse['orders_status_name']);
                      }
                    }
                    echo xtc_draw_pull_down_menu('status', $statusarray, -1, 'id="status"');

                    ?>
                    <br /><br />
                    <input type="hidden" name="action" value="export" />
                    <input type="submit" value="<?php echo TEXT_EXPORT_BUTTON; ?>" class="button" onclick="self.document.forms[0].submit()" />
                  </fieldset></form>
                  <?php
                }
              } else {
                echo '<h2>' . ERROR_BESTELLEXPORT_NOT_ACTIVE . '</h2>';
              }
              ?>
              <!-- inhalt //-->
            </td>
          </tr>
        </table>
      </td>
      <!-- body_text_eof //-->
    </tr>
  </table>
  <!-- body_eof //-->
  <!-- footer //-->
  <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
  <!-- footer_eof //-->
  </body></html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>