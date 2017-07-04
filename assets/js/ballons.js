jQuery.fn.ballons = function(options) {
    var options = options || {
        //Default option
    };
    var containerHeight = this.innerHeight();
    var containerWidth = this.innerWidth();
    this.find('[class^="ballon-"]').each(function(idx, elm) {
        var elmX = Math.random() * containerWidth - 90;
        var elmY = Math.random() * containerHeight / 4;
        jQuery(elm).css({
            "top": "calc(50% + "+ elmY +"px)",
            "left": elmX + "px"
        });

        jQuery(elm).on("mouseover", function(e) {
            jQuery(this).addClass('flow-up');
        })
    });
    return this;
}
