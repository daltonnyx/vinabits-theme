jQuery.fn.protoSlide = function(options) {
    var $ = jQuery;
    return this.each(function() {
        var elem = $(this),
            items = elem.find("li"),
            controlHtml = "";
        
        items.each(function(idx) {
            var li = items[idx];
            controlHtml += '<a class="'+ li.className + ' ' + (idx == 0 ? "active": "") +'"></a>';
        });
        controlHtml += '<a class="prev"><i class="fa fa-angle-left"></i></a>';
        controlHtml += '<a class="next"><i class="fa fa-angle-right"></i></a>';
        elem.on("click", ".slideControl a", function(e) {
            e.preventDefault();
            var control = $(this)[0];
            var current = $(e.delegateTarget).find(".slideControl .active").first();
            var next;
            if(control.className == "prev") {
                next = current.prev();
                if(next[0] == undefined)
                    next = $(e.delegateTarget).find('.slideControl a[class^="slide-"]').last();
            }
            else if (control.className == "next") {
                next = current.next();
                if(next[0].className.indexOf("slide-") == -1) 
                    next = $(e.delegateTarget).find('.slideControl a').first();
            }
            else {
                next = $(control);
            }
            console.log(next[0].className);
            var nextLi = $(e.delegateTarget).find("li."+next[0].className);

            $(e.delegateTarget).find("ul.slider").css({
                "transform": "translateX(-"+nextLi[0].offsetLeft+"px)",
                "-webkit-transform": "translateX(-"+nextLi[0].offsetLeft+"px)",
                "-moz-transform": "translateX(-"+nextLi[0].offsetLeft+"px)",
            });
            current.removeClass("active");
            next.addClass("active");
        });
        var control = document.createElement("DIV");
        control.className = "slideControl";
        jQuery(control).html(controlHtml);
        elem.find(".content").prepend(control);
    });
};
