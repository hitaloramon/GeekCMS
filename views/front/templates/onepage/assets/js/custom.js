$(function () {
    "use strict";
    // ============================================================== 
    //This is for preloader
    // ============================================================== 
    $(function () {
        $(".preloader").fadeOut();
        $('[data-toggle="tooltip"]').tooltip()
        $('[data-toggle="popover"]').popover()
    });
    // ============================================================== 
    //Fix header while scroll
    // ============================================================== 
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 300) {
            $('.bt-top').addClass('visible');
        } else {
            $('.bt-top').removeClass('visible');
        }
    });
    // ============================================================== 
    // Animation initialized
    // ============================================================== 
    AOS.init();
});

$('a[href^="#"]').on('click', function(event) {
    var target = $(this.getAttribute('href'));
    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top
        }, 700);
    }
});