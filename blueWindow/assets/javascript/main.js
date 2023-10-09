
$(document).ready(function() {
    var scrollToTopBtn = $("#scrollToTopBtn");

    $(window).scroll(function() {
        if ($(window).scrollTop() > 250) {
            scrollToTopBtn.fadeIn();
        } else {
            scrollToTopBtn.fadeOut();
        }
    });

    scrollToTopBtn.click(function() {
        $("html, body").animate({scrollTop: 0}, "smooth");
    });
});

