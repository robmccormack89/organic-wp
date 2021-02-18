// filters badge's titles
jQuery(function($) {

  filters_badges_titles = function () {
    // get the data-name attreibute from the active/checked values of the various filters
    view_name = $('#GridList a.uk-active').attr('data-name'),
    cat_name = $('.cat-list a.active').attr('data-name'),
    sort_name = $('.ajax-ordering a.active').attr('data-name'),
    // insert the names into the filter badges
    $( ".badge-view" ).append( view_name );
    $( ".badge-cat" ).append( cat_name );
    $( ".badge-sort" ).append( sort_name );
  };

});

// on document ready
jQuery(document).ready( function($) {
  
  // filters badge's titles, see above
  filters_badges_titles();
  
  // click with event bubbling to top (makes click event work more than once)
  $(document).on('click', '[data-pjax]', function(e) {
    
    // prevent regular clicking of link
    e.preventDefault();
    
    // reset the pjax timeout setting
    $.pjax.defaults.timeout = 20000;
  
    // using pjax jquery plugin https://github.com/defunkt/jquery-pjax
    $.pjax({
      // url from the clicked link; url is created using add_query_arg
      url: $(this).attr('href'),
      // container to replace
      container: '#ajax-filters-container',
      // fragment to replace it with
      fragment: '#ajax-filters-container',
    });

  });
  // pjax beforesend
  $(document).on('pjax:send', function() {
    // before sebd, reduce opacity on products grid: loading effect
    $('#ProductGrid').css('opacity','0.5');
  })
  // pjax success
  $(document).on('pjax:complete', function() {
    // on load, full opacity on products grid
    $('#ProductGrid').css('opacity','1');
    // filters badge's titles, see above
    filters_badges_titles();
  })
  // pjax pushState
  $(document).on('pjax:popstate', function() {
    // forward/back buttons state, full opacity on products grid
    $('#ProductGrid').css('opacity','1');
  })
  
});