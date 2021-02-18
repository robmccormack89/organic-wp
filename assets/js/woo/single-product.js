jQuery(function(){
  
  // second swiper
  var info_swiper = new Swiper('#slideshow_related', {
    slidesPerView: 2,
    spaceBetween: 15,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    // init: false,
    pagination: {
      el: '.swiper-pagination',
      dynamicBullets: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      640: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 15,
      },
    }
  });
  
});

jQuery(function($) {
  // add-to-cart
  $(".variations_form table").addClass("uk-table-small uk-table-divider uk-table-middle uk-table-justify uk-position-relative");
  $(".variations_form .button").addClass("uk-button-primary");
  // reviews tab
  $("ol.commentlist").addClass("uk-list uk-list-divider");
  // additional info tab
  $(".woocommerce-product-attributes").addClass("uk-table-small uk-table-divider uk-table-middle uk-table-justify");
  // add-to-cart
  $(".product-right .button").addClass("uk-button-primary");
  $("#ProductButtons .button").addClass("uk-button-small uk-button-default");
  // stock
  $(".in-stock").addClass("uk-text-success");
  $(".out-of-stock").addClass("uk-text-danger");
  
  $(".tab-content h2").addClass("uk-card-title");
});