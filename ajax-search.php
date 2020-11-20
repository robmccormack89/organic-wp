<style>
  .search-results-ajax {
    position: absolute;
    width: 100%;
    background-color: #fff;
    border-left: 1px solid #e6e6e6;
    border-right: 1px solid #e6e6e6;
    z-index: 9999999;
    -webkit-box-shadow: 0 3px 6px rgba(0,0,0,.1);
    box-shadow: 0 3px 6px rgba(0,0,0,.1);
  }
  .search-results-ajax ul {
    padding: 0;
    margin: 10px 0;
  }
  .search-results-ajax ul li {
    list-style: none;
  }
  .search-results-ajax ul li a {
    display: block;
    padding: 8px 15px;
  }
  .search-results-ajax ul li a:hover {
    background-color: #f5f5f5;
    color: #116444;
  }
  .search-results-ajax ul li a, .search-results-ajax ul li a:hover {
    text-decoration: none;
  }
  .search-results-ajax ul li a span.uk-text-meta.ajax-search-meta {
    float: right;
    font-size: 11px;
  }
  .search-results-ajax::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
    border-radius: 10px;
  }
  .search-results-ajax::-webkit-scrollbar {
  	width: 10px;
  	background-color: #F5F5F5;
  }
  .search-results-ajax::-webkit-scrollbar-thumb {
    border-radius: 10px;
    background-color: #20845e;
  }
</style>

<?php

function theme_ajax_search() {

  $data = array(
    'result' => 0,
    'response' => ''
  );
  
  $query = $_POST['query'];
  $query_string_upper = ucwords($query);

  if (!empty($query)) {

    $data['result'] = 1;

    $cat_args = array(
      'fields' => 'all',
      'name__like' => $query, 
    );
    $product_categories = get_terms( 'product_cat', $cat_args );

    $products = wc_get_products( array(
      'status' => 'publish',
      'limit' => -1,
      'search_term' => $query,
      'meta_query' => array(
        array(
          'key' => '_stock_status',
          'value' => 'instock'
        ),
      )
    ));
    
    $matching_terms = get_terms( array(
      'taxonomy' => 'product_cat',
      'fields' => 'slugs',
      'name__like' => $query, 
    ));
    $products_in_cat_args = array(
      'posts_per_page' => -1,
      'post_type' => 'product',
      'orderby' => 'title',
      'meta_query' => array(
        array(
          'key' => '_stock_status',
          'value' => 'instock'
        ),
      ),
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'product_cat',
          'field' => 'slug',
          'terms' => $matching_terms
        ),
      ),
    );
    $products_in_cat = new Timber\PostQuery($products_in_cat_args);

    if (!empty($product_categories) || !empty($products) || !empty($products_in_cat) ) {

      $response = '<ul class="">';

      if (!empty($product_categories)) {
        foreach ($product_categories as $product_cateory) {
          $response .= '<li><a class="uk-link-text" href="' . get_term_link($product_cateory) . '">' . $product_cateory->name . ' <span class="uk-text-meta ajax-search-meta">Category</span></a></li>';
        }
      }

      if (!empty($products)) {
        foreach ($products as $product) {
          $response .= '<li><a class="uk-link-text" href="' . get_permalink($product->id) . '">' . $product->name . ' <span class="uk-text-meta ajax-search-meta">Product</span></a></li>';
        }
      }
      
      if (!empty($products_in_cat)) {
        foreach ($products_in_cat as $product_in_cat) {
          $response .= '<li><a class="uk-link-text" href="' . get_permalink($product_in_cat->id) . '">' . $product_in_cat->title . ' ('.$query_string_upper.') <span class="uk-text-meta ajax-search-meta">Product</span></a></li>';
        }
      }

      $response .= '</ul>';

    }

    $data['response'] = $response;

  }

  echo json_encode($data);

  die();
}
add_action( 'wp_ajax_theme_ajax_search', 'theme_ajax_search' );
add_action( 'wp_ajax_nopriv_theme_ajax_search', 'theme_ajax_search' );

?>

<div class="top-search-bar">
  <form id="form_validate_search" class="form_search_main uk-width-1-1 uk-inline" role="search" method="get" action="{{site.url}}" accept-charset="utf-8" novalidate="novalidate">
    <div class="uk-search uk-search-default uk-width-1-1">
      <input type="text" name="search" maxlength="300" pattern=".*\S+.*" id="input_search" class="form-control uk-input uk-search-input uk-form-width-large" value="" placeholder="Search..." required="" autocomplete="off"
        aria-invalid="true">
    </div>
    <div id="response_search_results" class="search-results-ajax uk-height-max-medium uk-overflow-auto"></div>
  </form>
</div>

<script>

 jQuery(function($) {

   $(document).on("keyup", "#input_search",  _.debounce(function() {
     
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
         action: 'theme_ajax_search',
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

   $(document).on('click', function (e) {
     if ($(e.target).closest(".top-search-bar").length === 0) {
       $("#response_search_results").hide();
     }
   });

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
     
 });

</script>