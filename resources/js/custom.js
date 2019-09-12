$(document).ready(function() {
    
    let test = false
    AOS.init();
    $(window).scroll(function() {
        $(window).scroll(function() {
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
        });
    });

});