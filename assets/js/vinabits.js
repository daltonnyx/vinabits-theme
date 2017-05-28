jQuery(document).ready(function($){
    setTimeout(runAnimation,0);
  /* $('.testimonials').owlCarousel({
   *   loop: true,
   *   responsiveClass: true,
   *   dots: false,
   *   responsive: {
   *     0: {
   *       items: 1,
   *       center: true,
   *       margin: 10,
   *     },
   *     768: {
   *       items: 3,
   *       margin: 30,
   *       autoplay: true,
   *     }
   *   }
   * }); */
  $('.pro-cat-carousel').owlCarousel({
        items: 4,
        margin: 20,
        loop: true,
        nav: true,
        dots: false,
        navText: ['<span class="owl-arrow prev-button"></i>','<span class="owl-arrow next-button"></span>']
    });
    $(window).scroll(runAnimation);

    function runAnimation(){
        $(".has-animation").each(function(idx, elm){
            if($(window).scrollTop() > $(elm).offset().top - $(window).height() * 2/3
            && $(window).scrollTop() <= $(elm).offset().top + $(elm).height() - $(window).height() * 1/3
            && !$(elm).hasClass("animated")) {
               var className = elm.className + " animated";
               elm.className = className;
               elm.style.animationName = "none";
               setTimeout(function(){loadAnimation(elm)}, 1000 / 60);
            }
            
        });
    }
    function loadAnimation(elm) {
        $(elm).removeAttr("style");
        $(elm).removeClass("has-animation");
    }
});
