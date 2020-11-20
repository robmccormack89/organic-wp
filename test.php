<?php

function new_ajax_search() {
     
     $query = $_POST['query'];

     $data = array(
         'result' => 0,
         'response' => ''
     );
     
     if (!empty($query)) {

       $data['result'] = 1;
       
       $cat_args = array(
           'search'     => $query,
       );
       $product_categories = get_terms( 'product_cat', $cat_args );
       
       $products = wc_get_products( array(
           'status' => 'publish',
           'limit' => -1,
           'search_term' => $query,
       ) );
       
       if (!empty($product_categories) || !empty($products)) {
       
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
         
         $response .= '</ul>';
         
       }
       
       $data['response'] = $response;
     
     }

     echo json_encode($data);
     
     die();
 }
 add_action( 'wp_ajax_new_ajax_search', 'new_ajax_search' );
 add_action( 'wp_ajax_nopriv_new_ajax_search', 'new_ajax_search' );
 
 ?>
 
 <div class="top-search-bar">
   <form id="form_validate_search" class="form_search_main uk-width-1-1 uk-inline" role="search" method="get" action="{{site.url}}" accept-charset="utf-8" novalidate="novalidate">
     <div class="uk-search uk-search-default uk-width-1-1">
       <input type="text" name="search" maxlength="300" pattern=".*\S+.*" id="input_search" class="form-control uk-input uk-search-input uk-form-width-large" value="" placeholder="Search..." required="" autocomplete="off"
         aria-invalid="true">
     </div>
     <div id="response_search_results" class="search-results-ajax"></div>
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
         action: 'new_ajax_search',
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