{% extends 'base.twig' %}

{% block content %}

<div class="uk-container" data-template="woo-archive.twig">
  
  {% include 'breads.twig' %}

  {% do action('woocommerce_before_main_content') %}
  
  {% do action('woocommerce_archive_description') %}
  
  <div id="ajax-filters-container">
    {% include 'product-archive.twig' %}
  </div>

  {% do action('woocommerce_after_shop_loop') %}

  {% do action('woocommerce_after_main_content') %}
  
</div>

{% endblock  %}

{% block spec_scripts %}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js" integrity="sha512-7G7ueVi8m7Ldo2APeWMCoGjs4EjXDhJ20DrPglDQqy8fnxsFQZeJNtuQlTT0xoBQJzWRFp4+ikyMdzDOcW36kQ==" crossorigin="anonymous"></script>

<script>

  // using pjax jquery plugin https://github.com/defunkt/jquery-pjax
  jQuery(document).ready( function($) {
    
    // click with event bubbling to top (makes click event work more than once)
    $(document).on('click', '[data-pjax]', function(e) {
      
      // prevent regular clicking of link
      e.preventDefault();
      
      // reset the pjax timeout setting
      $.pjax.defaults.timeout = 20000;
      
      // reduce opacity of poroducts container prior to filter results
      $('#ajax-filters-container').css('opacity','0.5');
      
      // close the offcanvas menu
      UIkit.offcanvas('#FiltersMenu').hide();

      // pjax function
      $.pjax({
        
        // url from the clicked link; url is created using add_query_arg
        url: $(this).attr('href'),
        // container to replace
        container: '#ajax-filters-container',
        // fragment to replace it with
        fragment: '#ajax-filters-container',
        
      }).done(function() {
  
        // trun the opcaity back up on success
        $('#ajax-filters-container').css('opacity','1');
        
      });
        // return false;
    });
    
  });
  
</script>

<!-- <script>
  
  jQuery(document).ready( function($) {
  
      $(document).on('click', 'a[data-pjax]', function(e) {
  
        e.preventDefault();
  
        ajax_url = $(this).attr('href');
  
        var loader = '<div id="ajax_loader" class="loader-ajax uk-height-medium"></div>';
  
        $('#ajax-filters-wrap').html(loader);
  
        $("#ajax-filters-wrap").load(ajax_url + ' #MainProductArchive', function() {
  
          window.history.pushState({},"Filter Results", ajax_url);
  
          var infScroll = new InfiniteScroll( '.archive-posts', {
            path: '.next',
            append: '.item',
            status: '.page-load-status',
            hideNav: '.pagi',
            history: false,
          });
  
        });
  
    });
  });

  // using jquery.load (which uses jquery.get
  // jQuery(document).ready( function($) {
  // 
  //   $("#target").click(function(e){
  // 
  //     e.preventDefault();
  // 
  //     ajax_url = $(this).attr('href');
  // 
  //     var loader = '<div id="ajax_loader" class="loader-ajax uk-height-medium"></div>';
  // 
  //     $('#ajax-filters-wrap').append(loader);
  // 
  //     $("#ajax-filters-wrap").load(ajax_url + ' #MainProductArchive', function() {
  // 
  //       window.history.pushState( 'Details', 'Filtered', ajax_url);
  // 
  //       window.history.pushState({
  //           "pageTitle": response.pageTitle
  //       }, "", ajax_url);
  // 
  //       var infScroll = new InfiniteScroll( '.archive-posts', {
  //         path: '.next',
  //         append: '.item',
  //         status: '.page-load-status',
  //         hideNav: '.pagi',
  //         history: false,
  //       });
  // 
  //     });
  // 
  //   });
  // });

  // using plain jqeury.get
  // jQuery(document).ready( function($) {
  // 
  //   // on click of a filter link
  //   $( '#target' ).click(function(e) {
  // 
  //     // prevent default link behaviour
  //     e.preventDefault();
  // 
  //     // define the ajax_url as the url from the clicked link
  //     ajax_url = $(this).attr('href');
  // 
  //     // define the loader html
  //     loader = '<div id="ajax_loader" class="loader-ajax uk-height-medium"></div>';
  // 
  //     // define the domain/host as the state object for pushState
  //     state = location.protocol + "//" + location.host,
  //     // define the title as title object for pushState
  //     title = '',
  // 
  //     // ajax request using GET with request url gotten from clicked link
  //     $.ajax({
  //       url: ajax_url,
  //       type : 'get',
  //       beforeSend: function () {
  //         // before send, show the loader
  //         $('#ajax-filters-wrap').html(loader);
  //       },
  //       success: function(response) {
  // 
  //         // on success of request, insert #MainProductArchive from response into #ajax-fiters
  //         $('#ajax-filters-wrap').html($(response).find('#MainProductArchive'));
  // 
  //         window.history.pushState(domain, title, ajax_url)
  // 
  //         var infScroll = new InfiniteScroll( '.archive-posts', {
  //           path: '.next',
  //           append: '.item',
  //           status: '.page-load-status',
  //           hideNav: '.pagi',
  //           history: false,
  //         });
  // 
  //       },
  //     })
  // 
  //   });
  //   // ajax_url = "https://organicforhealth.ie/shop/?orderby=price-desc&product_cat=groceries&grid_list=grid-view&s=a";
  // })
  
</script> -->

{% endblock %}