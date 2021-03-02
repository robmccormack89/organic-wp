// filters badge's titles
jQuery(function($) {
  repagi = function() {
    // get the data-name attreibute from the active/checked values of the various filters
    view_name = $('#GridList a.uk-active').attr('data-name'),
    cat_name = $('.cat-list input.here').attr('data-name'),
    sort_name = $('.ajax-ordering input.here').attr('data-name'),
    // insert the names into the filter badges
    $( ".badge-view" ).text(view_name);
    $( ".badge-cat" ).text(cat_name);
    $( ".badge-sort" ).text(sort_name);
    // //re init pagination inf scroll
    if ($(".uk-pagination").length) {
      $('.archive-posts').infiniteScroll({
        path: '.next',
        append: '.item',
        status: '.page-load-status',
        hideNav: '.pagi',
        history: false,
      });
    };
  };
});

function quickLoad(event) {
  
  // get the data-link value of the clicked link
  var the_link_href = event.target.getAttribute("data-link");
      
  // add a loader onclick; removed when node is replaced in successful fetch call
  document.querySelector('.content-container').classList.add('the-loader');
    
  // fetch request with the clicked llnk
  fetch(the_link_href).then(function (response) {
    // The API call was successful! retunr the repsonse text (html string)
    return response.text();
  }).then(function (html) {
    // Parse HTML string
    var parser = new DOMParser();
    // & convert the into a document object
    var doc_obj = parser.parseFromString(html, 'text/html');
    // Get the content within the object
    var new_content = doc_obj.querySelector('.block-content_wrap');
    // container element to insert into
    var main_container = document.getElementById("MainContent");
    // old content to be replaced
    var old_content = document.querySelector('.block-content_wrap');
    // remove inside of main content & replace it
    main_container.replaceChild(new_content, old_content);
    // add new url to the browser address bar; this is optional with the one page setup
    window.history.pushState({}, '', the_link_href);
    
    repagi();
    
    UIkit.scroll('#Top');
  }).catch(function (error) {
    // There was an error
    console.warn('Something went wrong.', error);
  });
}