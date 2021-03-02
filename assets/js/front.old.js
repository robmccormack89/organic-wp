jQuery(function(){
  
  // first swiper
  var slider_swiper = new Swiper('#slideshow_banner', {
    centeredSlides: true,
    // autoplay: {
    //   delay: 4000,
    //   disableOnInteraction: true,
    // },
    pagination: {
      el: '.swiper-pagination',
      type: 'progressbar',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
  
  // second swiper
  var info_swiper = new Swiper('#slideshow_info', {
    slidesPerView: 1,
    spaceBetween: 15,
    autoplay: {
      delay: 4000,
      disableOnInteraction: true,
    },
    // init: false,
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      // 1024: {
      //   slidesPerView: 4,
      //   spaceBetween: 50,
      // },
    }
  });
  
});