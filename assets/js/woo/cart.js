jQuery(function($) {
  // cart
  function WooCart() {
    $(".woocommerce-cart-form").addClass("uk-overflow-auto");
    $(".woocommerce-cart-form .shop_table").addClass("uk-table uk-table-justify uk-table-divider");
    $(".woocommerce-cart-form .product-thumbnail").addClass("uk-width-small");
    $(".woocommerce-cart-form .product-thumbnail img").addClass("uk-preserve-width");
    $(".woocommerce-cart-form .product-quantity").addClass("uk-width-small");
    $(".woocommerce-cart-form .product-name a").addClass("uk-link-text dont-underline");
    $(".woocommerce-cart-form .input-text").addClass("uk-input");
    $(".woocommerce-cart-form .actions").addClass("uk-padding-remove-horizontal");
    $(".woocommerce-cart-form .button").addClass("uk-button uk-width-1-1");
    $(".cart_totals .button").addClass("uk-button-primary");
    $(".woocommerce-cart-form .coupon .button").addClass("uk-button-primary uk-margin-small-top uk-margin-small-bottom");
    $(".woocommerce-cart-form .coupon label").hide();
    $(".woocommerce-cart-form .quantity .screen-reader-text").hide();
  };
  // cart-shipping
  function WooCartShip() {
    $("#shipping_method").addClass("uk-list");
  };
  // cart-totals
  function WooCartTot() {
    $(".cart_totals h2").addClass("uk-h3 uk-margin-top");
    $(".cart_totals .shop_table").addClass("uk-table uk-table-striped");
  };
  // proceed-to-checkout-button
  function WooCartCheck() {
    $(".checkout-button").addClass("uk-button uk-button-primary");
  };
  // shipping-calculator
  function WooShipCalc() {
    $(".shipping-calculator-form").addClass("uk-margin-top");
    $(".woocommerce-shipping-calculator .button").addClass("uk-button uk-button-default uk-button-small");
    $(".woocommerce-shipping-calculator select").addClass("uk-select");
    $(".woocommerce-shipping-calculator .input-text").addClass("uk-input");
  };
  // events
  $(".woocommerce").load(WooCart());
  $(".woocommerce").load(WooCartShip());
  $(".woocommerce").load(WooCartTot());
  $(".woocommerce").load(WooCartCheck());
  $(".woocommerce").load(WooShipCalc());
  $("body").on('DOMSubtreeModified', ".woocommerce", WooCart);
  $("body").on('DOMSubtreeModified', ".woocommerce", WooCartShip);
  $("body").on('DOMSubtreeModified', ".woocommerce", WooCartTot);
  $("body").on('DOMSubtreeModified', ".woocommerce", WooCartCheck);
  $("body").on('DOMSubtreeModified', ".woocommerce", WooShipCalc);
});