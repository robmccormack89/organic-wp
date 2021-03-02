jQuery(function($) {
  
  function WooShop() {
    $(".tease-product-buttons .button").addClass("uk-button uk-button-small uk-button-default");
    $(".onsale").addClass("uk-card-badge uk-label");
  };
  $("#MainProductArchive").load(WooShop());
  $("body").on('DOMSubtreeModified', "#MainProductArchive", WooShop);
  
});