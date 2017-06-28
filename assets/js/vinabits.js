jQuery(document).ready(function($){
    setTimeout(runAnimation,0);
    $('.news-carousel').owlCarousel({
        items: 4,
        margin: 28,
        loop: true,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
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
