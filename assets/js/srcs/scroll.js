// load infinite scroll
var InfiniteScroll = require('infinite-scroll');

var infScroll = new InfiniteScroll( '.archive-posts', {
  path: '.next',
  append: '.item',
  button: '.view-more-button',
  // using button, disable loading on scroll 
  scrollThreshold: false,
  status: '.page-load-status',
  hideNav: '.pagi'
});