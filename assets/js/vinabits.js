jQuery(document).ready(function($){
  $('.testimonials').owlCarousel({
    loop: true,
    responsiveClass: true,
    dots: false,
    responsive: {
      0: {
        items: 1,
        center: true,
        margin: 10,
      },
      768: {
        items: 3,
        margin: 30,
        autoplay: true,
      }
    }
  })
});
