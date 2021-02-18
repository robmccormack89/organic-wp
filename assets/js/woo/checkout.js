jQuery(function($) {
  // checkout
  function CheckoutRestyleAfterAjax() {

    $(".woocommerce-billing-fields__field-wrapper").attr("uk-grid");
    $(".woocommerce-billing-fields__field-wrapper").addClass("uk-grid-small");

    $(".woocommerce-checkout-review-order-table").addClass("uk-table uk-table-divider");

    $(".wc_payment_methods").addClass("uk-list uk-list-large uk-list-divider");

    $(".input-radio").addClass("uk-radio");
    $(".input-text").addClass("uk-input");
    $(".input-checkbox").addClass("uk-checkbox");
    
    $("label").addClass("uk-form-label");

    $("select").addClass("uk-select");
    
    $(".checkout_coupon button").addClass("uk-button uk-button-default");
    $("#order_review button").addClass("uk-button uk-button-primary");
    
    $("#shipping_method").addClass("uk-list");
  }
  // events
  $("form.checkout").load(CheckoutRestyleAfterAjax());
  $("body").on('DOMSubtreeModified', "form.checkout", CheckoutRestyleAfterAjax);
});