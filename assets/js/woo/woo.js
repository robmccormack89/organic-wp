// pagination
jQuery(function($) {
  if ($(".uk-pagination").length) { 
    $('.archive-posts').infiniteScroll({
      path: '.next',
      append: '.item',
      status: '.page-load-status',
      hideNav: '.pagi',
      history: false,
    });
   };
});

jQuery(function($) {

  // global
  function DoAllWoo() {

    // get the data-name attreibute from the active/checked values of the various filters
    view_name = $('#GridList a.uk-active').attr('data-name'),
    cat_name = $('.cat-list input.here').attr('data-name'),
    sort_name = $('.ajax-ordering input.here').attr('data-name'),
    // insert the names into the filter badges
    $( ".badge-view" ).text(view_name);
    $( ".badge-cat" ).text(cat_name);
    $( ".badge-sort" ).text(sort_name);

    // form login
    $(".woocommerce-form-login .woocommerce-form-login__submit").addClass("uk-button-primary uk-margin-top");

    // buttons
    $(".button").addClass("uk-button");
    $("input.submit").addClass("uk-button uk-button-primary");
    $(".woocommerce-message .button").addClass("uk-button-primary uk-button-small");

    // forms
    $(".woocommerce-form__input-checkbox").addClass("uk-checkbox");
    $("input#wp-comment-cookies-consent").addClass("uk-checkbox");
    $(".input-text").addClass("uk-input");
    $(".comment-form input").addClass("uk-input");
    $("input#wp-comment-cookies-consent").removeClass("uk-input");
    $("input.qty").addClass("uk-input");
    $("form label").addClass("uk-form-label");
    $(".woocommerce-form").addClass("uk-form-stacked");
    $(".comment-form").addClass("uk-form-stacked");
    $("form").addClass("uk-form-stacked");
    $("em").addClass("uk-text-danger");
    $("select").addClass("uk-select");
    $("textarea").addClass("uk-textarea");
    $("label").addClass("uk-form-label");

    // tables
    $("table").addClass("uk-table");

    //
    $(".onsale").addClass("uk-card-badge uk-label");

    $("ul.woocommerce-error").addClass("uk-list");
    $("ul.woocommerce-error .uk-button").addClass("uk-button-primary");

    // login/register
    $(".col2-set").attr("uk-grid", "");
    $(".col2-set").addClass("uk-child-width-1-2@m");
  }
  $(".woocommerce").load(DoAllWoo());

});