$(document).ready(function(){


    jQuery(window).resize(function() {
        // This will fire each time the window is resized:
        if(jQuery(window).width() <= 925) {
            $("li.dropdown > a.dropdown-toggle").removeClass("disabled");
        } else {
            $("li.dropdown > a.dropdown-toggle").addClass("disabled");
        }
    }).resize();

    //change lang in url
    var urlmenu = document.getElementById('lang-menu');
    urlmenu.onchange = function() {
        self.location=this.options[this.selectedIndex].value;
    };


	//carousel
	if($(".carousel").length > 0){
        $('.carousel').carousel({
            interval: 5000
        });
    }

    //slick carousel main product
   if($('.slick-carousel').length > 0){
     $('.slick-carousel').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 880,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    adaptiveHeight: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

   }

     //slick carousel storyes
     if($('.slick-carousel-storyes').length > 0){
         $('.slick-carousel-storyes').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1
        });
    }

    //slick carousel gallery
    if($('.slick-carousel-gallery').length > 0){
        $('.slick-carousel-gallery').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1
        });
    }
    

    //product tabs
    if($('#myTabs a').length > 0){
        $('#myTabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    }

    if( $('.lbox-slider').length > 0){
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    }
    
});