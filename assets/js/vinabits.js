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
  });
  $('.pro-cat-carousel').owlCarousel({
        items: 4,
        margin: 30,
        loop: true,
        nav: true,
        dots: false,
        navText: ['<span class="owl-arrow prev-button"></i>','<span class="owl-arrow next-button"></span>']
    });
});
