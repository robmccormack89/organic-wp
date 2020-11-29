<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="top-search-bar">
  <form id="form_validate_search" class="form_search_main uk-width-1-1 uk-inline" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" accept-charset="utf-8" novalidate="novalidate">
    <div class="uk-search uk-search-default uk-width-1-1 uk-light">
      <input type="text" name="search" maxlength="300" pattern=".*\S+.*" id="input_search" class="form-control uk-input uk-search-input uk-form-width-large" value="" placeholder="Start searching for products..." required="" autocomplete="off"
        aria-invalid="true">
			<input type="hidden" name="post_type" value="product" />
    </div>
    <div id="response_search_results" class="search-results-ajax uk-height-max-medium uk-overflow-auto"></div>
  </form>
</div>
