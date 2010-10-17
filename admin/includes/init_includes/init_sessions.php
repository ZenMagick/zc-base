<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_sessions.php 17498 2010-09-06 21:47:12Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// require the session handling functions
  require(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'sessions.php');

  zen_session_name('zenAdminID');
  zen_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
$path = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$path = (defined('CUSTOM_COOKIE_PATH')) ? CUSTOM_COOKIE_PATH : $path;

if (PHP_VERSION >= '5.2.0') {
  session_set_cookie_params(0, $path, (zen_not_null($cookieDomain) ? '.' . $cookieDomain : ''), FALSE, TRUE);
} else {
  session_set_cookie_params(0, $path, (zen_not_null($cookieDomain) ? '.' . $cookieDomain : ''));
}

// lets start our session
  zen_session_start();
  $session_started = true;

if (! isset ( $_SESSION ['securityToken'] ))
{
  $_SESSION ['securityToken'] = md5 ( uniqid ( rand (), true ) );
}
if (isset ( $_GET ['action'] ) && in_array ( $_GET ['action'], array ('save', 'layout_save', 'update', 'update_sort_order', 'update_confirm', 'copyconfirm', 'deleteconfirm', 'insert', 'move_category_confirm', 'delete_category_confirm', 'update_category_meta_tags', 'insert_category' ) ))
{
  if (strpos ( $PHP_SELF, FILENAME_PRODUCTS_PRICE_MANAGER ) === FALSE && strpos ( $PHP_SELF, FILENAME_PRODUCTS_OPTIONS_NAME ) === FALSE && (strpos( $PHP_SELF, FILENAME_CURRENCIES ) === FALSE) && (strpos( $PHP_SELF, FILENAME_LANGUAGES ) === FALSE) && (strpos( $PHP_SELF, FILENAME_SPECIALS ) === FALSE)&& (strpos( $PHP_SELF, FILENAME_FEATURED ) === FALSE)&& (strpos( $PHP_SELF, FILENAME_SALEMAKER ) === FALSE))
  {
    if ((! isset ( $_SESSION ['securityToken'] ) || ! isset ( $_POST ['securityToken'] )) || ($_SESSION ['securityToken'] !== $_POST ['securityToken']))
    {
      zen_redirect ( zen_href_link ( FILENAME_DEFAULT, '', 'SSL' ) );
    }
  }
}
