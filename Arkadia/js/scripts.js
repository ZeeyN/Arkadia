$("a.scroll").click(function () {
    elementClick = $(this).attr("href");
    destination = $(elementClick).offset().top;
    $('html').animate( { scrollTop: destination }, 1000 );
    return false;
});
