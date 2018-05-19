jQuery(document).ready(function($){
    setTimeout(runAnimation,0);

    $('.news-carousel').owlCarousel({
      margin: 0,
      dots: false,
      loop: true,
      autoplay: false,
      nav: true,
      navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
      responsive: {
          0: {
              items: 1,
          },
          640: {
              items: 2,
          },
          1170: {
              items: 4,
          }
      }
    });

    setTimeout(function() {
        if($(window).width() > 992) {
            var height = $('.section-2 .background-slide .su-slider-slides').height();
            $('.section-2').height(height);
        }
    },700);
    $(window).scroll(runAnimation);
    var $tooltips = $("#tooltips");
    $(".section-1 .news-default-item, .product-card").on('mouseover', function(e) {
        $tooltips.html($(this).find('.tooltips').html());
    });
    $(".section-1 .news-default-item, .product-card").on('mousemove', function(e) {
        var x =  e.pageX + 15, y = e.pageY + 15;
        $tooltips.css({
            top: y + 'px',
            left: x + 'px',
        });
    });

    $(".section-1 .news-default-item, .product-card").on('mouseleave', function(e) {
        //$tooltips.html('');
        $tooltips.css({
            top: '-9999px',
            left: '-9999px',
        });
    });

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


    $("body").on("click", "#content.off", function(e) {
        $("#content").removeClass('off');
    });

    $("body").on("click", ".mobile-menu",function(e) {
        $("#content").addClass('off');
    });

    function add_sub_menu() {
        if($(window).width() < 768) {
            $('.main-navigation .menu-item-has-children').append('<span class="expand"><i class="fa fa-caret-down"></i></span>');
        }
        else {
            $('.main-navigation .menu-item-has-children .expand').remove();
        }
    }

    add_sub_menu();

    $('.main-navigation ul').on("click", ".expand", function(e) {
        e.preventDefault();
        var $li = $(e.currentTarget).closest('li');
        $li.find('.sub-menu').animate({
            "max-height": "400px"
        },400,function (){
            $(e.currentTarget).addClass("expanded");
            $li.find('.sub-menu').css({
                "max-height": "400px"
            });
        });
    });
    $('.main-navigation ul').on("click", ".expanded", function(e) {
        var $li = $(e.currentTarget).closest('li');
        $li.find('.sub-menu').animate({
            "max-height": "0px"
        },400,function (){
            $(e.currentTarget).removeClass("expanded");
            $li.find('.sub-menu').css({
                "max-height": "0px"
            });
        });
    });

    $(window).resize(add_sub_menu);

    // var $section1 = document.querySelector(".section-1"),
    //     secLeft = $section1 ?  $section1.offsetLeft : 0,
    //     secTop =  $section1 ?  $section1.offsetTop  : 0;
    // if(window.innerWidth >=768) {
    //     document.onmousemove = function(event) {
    //         event = event || window.event;
    //         if($section1 != null)
    //             mouseParallax($section1, secLeft, secTop, event.clientX, event.clientY, 0.02);
    //     }
    // }

    // function mouseParallax ( obj, left, top, mouseX, mouseY, speed ) {
    //     obj.style.backgroundPosition = (( (  ( parseInt( obj.clientWidth ) / 64 ) - mouseX ) ) * speed ) + 'px' + ' '
    //                                  + ((( ( ( parseInt( obj.clientHeight ) / 32 ) - mouseY  )  ) * speed ) + 'px');
    // }

    // var text_title = jQuery('[class="amazingslider-text-1"] [class^="amazingslider-title"]').text();
    // var textPath = '<svg width="547" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <defs> <path id="textPath" d="m-0.5,46c87.83333,-15 182.83333,-15 275.5,0c92.66667,15 178.33333,14 269,0"/> </defs> <text xml:space="preserve" text-anchor="start" font-family="Helvetica, Arial, sans-serif" font-size="33.5" id="svg_1" y="48.069319" x="1.064673" stroke-width="0" stroke="#ff0099" fill="#fff"> <textPath id="text-title" xlink:href="#textPath">'+ text_title +'</textPath> </text></svg>';
    // $('div[class*="amazingslider-title"]').html(textPath);
    //
    // var mutationObserver = new MutationObserver(function(){
    //     var text_title = jQuery('[class="amazingslider-text-1"] [class^="amazingslider-title"]').text();
    //     var textPath = '<svg width="547" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"> <defs> <path id="textPath" d="m-0.5,46c87.83333,-15 182.83333,-15 275.5,0c92.66667,15 178.33333,14 269,0"/> </defs> <text xml:space="preserve" text-anchor="start" font-family="Helvetica, Arial, sans-serif" font-size="33.5" id="svg_1" y="48.069319" x="1.064673" stroke-width="0" stroke="#ff0099" fill="#fff"> <textPath id="text-title" xlink:href="#textPath">'+ text_title +'</textPath> </text></svg>';
    //     $('div[class*="amazingslider-title"]').html(textPath);
    // });
    // var slideTextBox = document.querySelector( 'div[class*="amazingslider-text-box"]' );
    // if(slideTextBox != null)
    //     mutationObserver.observe(slideTextBox, { childList: true, attributes: false });

});
