jQuery(function($) {

  // website preloader animation
  // $(window).load(function() {
  //   $(".theme-preload").fadeOut("slow");
  //   $('body').removeClass('no-overflow');
  // });

  // ajax search js
  $(document).on("input", "#input_search",  _.debounce(function() {
    
    var input_value = $(this).val();
    var query = input_value;
    var req;
    
    if (query.length < 2) {
      $('#response_search_results').hide();
      return false;
    }
    
    if (req != null) req.abort();

    req = $.ajax({
      type: 'post',
      url: myAjax.ajaxurl,
      data: {
        action: 'ajax_live_search',
        query: query
      },
      success: function(response){
        
        if(!response) {
          alert('empty');
          $('#response_search_results').hide();
          return;
        }
        
        var obj = JSON.parse(response);
        
        if (obj.result == 1) {
          document.getElementById("response_search_results").innerHTML = obj.response;
          $('#response_search_results').show();
        }
        
        $('#response_search_results ul li a').wrapInTag({
          words: [input_value]
        });
        
      },
      error: function (request, status, error) {
        $('#response_search_results').hide();
      }
      
    });
  }, 500));

  // search results hide on additional click away
  $(document).on('click', function (e) {
    if ($(e.target).closest(".top-search-bar").length === 0) {
      $("#response_search_results").hide();
    }
  });

  // helper function to highlight search results text
  $.fn.wrapInTag = function (opts) {
    function getText(obj) {
      return obj.textContent ? obj.textContent : obj.innerText;
    }
    var tag = opts.tag || 'strong',
      words = opts.words || [],
      regex = RegExp(words.join('|'), 'gi'),
      replacement = '<' + tag + '>$&</' + tag + '>';
    $(this).contents().each(function () {
      if (this.nodeType === 3) {
        $(this).replaceWith(getText(this).replace(regex, replacement));
      } else if (!opts.ignoreChildNodes) {
        $(this).wrapInTag(opts);
      }
    });
  };

  // add to cart button triggers modal when item is added to cart
  $(document).on('added_to_cart', function(e, fragments, cart_hash, this_button) {
    var modal = UIkit.modal("#MiniCartModal");
    modal.show();
  });
  
  // adding uikit classes to various woo elements
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