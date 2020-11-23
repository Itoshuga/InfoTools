$(document).ready(function(){
    // toggle menu/navbar script
    $('.menu-btn').click(function(){
        $('nav .nav-btn').toggleClass("active");
        $('.menu-btn i').toggleClass("active");
    });

});