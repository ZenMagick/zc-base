<?php
/**
 * canonical link handling
 *
 * @package initSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_canonical.php 16196 2010-05-03 22:05:36Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// CANONICAL HANDLING:
/**
 * for products linked to multiple categories:
 */
if (strstr($current_page, '_info') && isset($_GET['products_id'])) {
  $canonicalLink = zen_href_link($current_page, 'cPath=' . zen_get_generated_category_path_rev(zen_get_products_category_id($_GET['products_id'])) . '&products_id=' . $_GET['products_id'], 'NONSSL', false);
}
/**
 * for product listings:
 */
if ($current_page == 'index' && isset($_GET['cPath'])) {
  $excludeParams = array('zenid', 'action', 'main_page', 'currency', 'typefilter');
  $excludeParams[] = 'language';
  $excludeParams[] = 'disp_order';
  $excludeParams[] = 'page';
  $excludeParams[] = 'sort';
  $excludeParams[] = 'alpha_filter_id';
  $excludeParams[] = 'filter_id';
  $canonicalLink = zen_href_link($current_page, zen_get_all_get_params($excludeParams), 'NONSSL', false);
}
