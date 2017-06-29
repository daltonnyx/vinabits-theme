jQuery(document).ready(function($){
    setTimeout(runAnimation,0);
    $('.news-carousel').owlCarousel({

        loop: true,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1,
                margin: 30
            },
            640: {
                items: 2,
                margin: 28,
            },
            768: {
                items: 3,
                margin: 28
            },
            1170: {
                items: 4,
                margin: 28
            }

        }
    });
    $(window).scroll(runAnimation);

    function runAnimation(){
        $(".has-animation").each(function(idx, elm){
            if($(window).scrollTop() > $(elm).offset().top - $(window).height() * 4/5 // When scroll down
            && $(window).scrollTop() <= $(elm).offset().top + $(elm).height() - $(window).height() * 1/2 // When scroll up
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

    var boxsvg = '<svg width="400" height="118" xmlns="http://www.w3.org/2000/svg"> <style>.path{stroke-dasharray: 1000; stroke-dashoffset: 1000; animation: dash 1.5s linear forwards 1; animation-delay: 1.5s;}.point{animation: blow .5s ease-in-out forwards 1; animation-delay: 2.3s; transform: scale(0); transform-origin: center;}@keyframes dash{from{stroke-dashoffset: 1000;}to{stroke-dashoffset: 0;}}@keyframes blow{from{transform: scale(0);}to{transform: scale(1);}}</style> <g> <title>background</title> <rect fill="none" id="canvas_background" height="120" width="402" y="-1" x="-1"/> <g display="none" overflow="visible" y="0" x="0" height="100%" width="100%" id="canvasGrid"> <rect fill="url(#gridpattern)" stroke-width="0" y="0" x="0" height="100%" width="100%"/> </g> </g> <g> <title>Layer 1</title> <path class="path" stroke="#00baf2" id="svg_6" d="m362.999991,17l35.81183,0l0,100l-392.81183,-0.12519c0,-21.87496 0,-63.99985 0,-85.87481" fill-opacity="null" stroke-width="2" fill="none"/> <ellipse class="point" ry="5" rx="5" id="svg_8" cy="25.875054" cx="6.124995" stroke="#00baf2" fill="#00baf2"/> </g></svg>';
    $('div[class*="amazingslider-text-bg"]').html(boxsvg);
    var mutationObserver = new MutationObserver(function(){
        $('div[class*="amazingslider-text-bg"]').html(boxsvg);
    });
    var slideTextBox = document.querySelector( 'div[class*="amazingslider-text-box"]' );
    mutationObserver.observe(slideTextBox, { childList: true, attributes: false });
    
});
