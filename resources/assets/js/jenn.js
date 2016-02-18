

$(".delayClick").click(
    function(event) {
        event.preventDefault();
        fadeOutPage();
        setTimeout(
            function() {
                window.location.href = event.target.href;
            },
            2000);
    });


function fadeOutPage() {
    $('.stripe').addClass('slideRight');
    //$('h1').addClass('fadeUp');
    //console.log($('.collapse').removeClass('in'));

    //document.getElementsByClassName('collapse')[0].setAttribute('aria-expanded',"false");
    $( ".collapse" ).animate({
        opacity: 1,
        height: "toggle"
    }, 1000, function() {
        // Animation complete.
    });

    $('body').addClass('backgroundFade');
}
