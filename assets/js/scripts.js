/* show cart modal on adding item to cart */
jQuery(function($) {

  // add to cart button triggers modal when item is added to cart
  $(document).on('added_to_cart', function(e, fragments, cart_hash, this_button) {
    var modal = UIkit.modal("#MiniCartModal");
    modal.show();
  });

});

// jquery add classes | frontend customizations
jQuery(function($) {
  $("#loginform").addClass("uk-form-stacked");
  $("label").addClass("uk-form-label");
  $("#loginform .input").addClass("uk-input");
  $("#loginform [ type=checkbox ]").addClass("uk-checkbox");
  $("#loginform .button.button-primary").addClass("uk-button uk-button-default");
  $(".woocommerce-message").addClass("uk-margin-top");
  $(".woocommerce-notices-wrapper .button").addClass("uk-button uk-button-primary uk-button-small uk-margin-small-right");
  $(".mnm_table").addClass("uk-table uk-table-striped uk-table-small");
  $(".input-text.qty").addClass("uk-input");
  $(".mnm_add_to_cart_button").addClass("uk-button uk-button-primary");
  $(".woocommerce-product-details__short-description ul").addClass("uk-list uk-list-striped");
  $(".single_add_to_cart_button").addClass("uk-button uk-button-primary");
});