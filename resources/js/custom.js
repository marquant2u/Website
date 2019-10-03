$(document).ready(function() {

    function fadeOutEffect(cible) {
        var fadeTarget = document.getElementById(cible);
        if( fadeTarget !== "null"){
            var fadeEffect = setInterval(function () {
                if (!fadeTarget.style.opacity) {
                    fadeTarget.style.opacity = 1;
                }
                if (fadeTarget.style.opacity > 0) {
                    fadeTarget.style.opacity -= 0.5;
                } else {
                    clearInterval(fadeEffect);
                }
            }, 200);
        }
    }

    //setTimeout(fadeOutEffect("fadejs"), 6000); 

    let test = false;
    AOS.init();
    $(window).scroll(function() {
        if ($('#skillbar').length > 0) {
            var hT = $('#skillbar').offset().top,
                hH = $('#skillbar').outerHeight(),
                wH = $(window).height(),
                wS = $(this).scrollTop();
            if (wS > (hT+hH-wH) && test === false){
                console.log("log");
                test = true;
                jQuery('.skillbar').each(function(){
                    jQuery(this).find('.skillbar-bar').animate({
                        width:jQuery(this).attr('data-percent')
                    },3000);
                });
            }
        }
    });
});