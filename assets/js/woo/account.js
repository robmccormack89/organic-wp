jQuery(function($) {
  
  $(".woocommerce-MyAccount-content").addClass("uk-margin-medium-top");
  $("main .button").addClass("uk-button-primary");
  $(".woocommerce-MyAccount-navigation ul").addClass("uk-subnav uk-subnav-pill");
  $(".woocommerce-orders-table").addClass("uk-table-striped uk-table-middle uk-table-justify");
  $(".woocommerce-orders-table").wrap("<div class='uk-overflow-auto'>", "</div>");
  $(".woocommerce-orders-table .woocommerce-orders-table__cell-order-actions .button").addClass("uk-button-small");
  
  function MyAccountRestyleAfterAjax() {
    $("select").addClass("uk-select");
    $(".input-text").addClass("uk-input");
    $("label").addClass("uk-form-label");
  };
  
  $("body").on('DOMSubtreeModified', ".woocommerce-address-fields", MyAccountRestyleAfterAjax);
  
});