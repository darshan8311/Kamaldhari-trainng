jQuery(document).ready(function($) {
    $('.kt_rc_carousel_init').each(function() {
        var container = $(this);
        var speed = container.data('carousel-speed'),
        ss = container.data('carousel-ss'), 
        xs = container.data('carousel-xs'),
        sm = container.data('carousel-sm'),
        md = container.data('carousel-md'), 
        xl = container.data('carousel-xl'), 
        sxl = container.data('carousel-sxl'),
        cscroll = container.data('carousel-scroll'), 
        transition = container.data('carousel-transition'),
        auto = container.data('carousel-auto');
        if(cscroll == '1'){
            var scroll_sxl = 1,
                scroll_xl = 1,
                scroll_md = 1,
                scroll_sm = 1,
                scroll_xs = 1,
                scroll_ss = 1;
        } else {
            var scroll_sxl = sxl,
                scroll_xl = xl,
                scroll_md = md,
                scroll_sm = sm,
                scroll_xs = xs,
                scroll_ss = ss;
        }
        container.on('init', function(slick) {
            container.parent('.kt-rc-fadein-carousel').addClass('kt-carousel-loaded');
        });
        container.slick({
            dots: false,
            infinite: true,
            speed: transition,
            autoplay: auto,
            autoplaySpeed: speed,
            slidesToShow: sxl,
            slidesToScroll: scroll_sxl,
            responsive: [
                {
                  breakpoint: 1500,
                  settings: {
                    slidesToShow: xl,
                    slidesToScroll: scroll_xl,
                  }
                },
                {
                  breakpoint: 1200,
                  settings: {
                    slidesToShow: md,
                    slidesToScroll: scroll_md,
                  }
                },
                {
                  breakpoint: 992,
                  settings: {
                    slidesToShow: sm,
                    slidesToScroll: scroll_sm,
                  }
                },
                {
                  breakpoint: 767,
                  settings: {
                    slidesToShow: xs,
                    slidesToScroll: scroll_xs
                  }
                },
                {
                  breakpoint: 544,
                  settings: {
                    slidesToShow: ss,
                    slidesToScroll: scroll_ss
                  }
                }
            ]
        });
    });
});