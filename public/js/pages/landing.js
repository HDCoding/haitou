$(function() {

    // Navbar
    //

    var navbarScrollThreshold = 20;
    var navbarBreakpoint = 992;

    // Custom classes that will be applied depending on page scrollTop value
    var navbarCustomClasses = {
        // when user is on the top of the page
        default: {},

        // when page scrollTop value > navbarScrollThreshold
        alt: {}
    };

    // Set custom classes depending on landing variant
    if ($('html').hasClass('landing-1') || $('html').hasClass('landing-3')) {

        navbarCustomClasses = {
            default: {
                variant: 'navbar-light',
                classes: 'pt-lg-4'
            },
            alt: {
                variant: 'bg-white',
                classes: 'py-1'
            }
        };

    } else if ($('html').hasClass('landing-2') || $('html').hasClass('landing-4')) {

        navbarCustomClasses = {
            default: {
                variant: 'navbar-dark',
                classes: 'pt-lg-4'
            },
            alt: {
                variant: 'bg-dark',
                classes: 'py-1'
            }
        };

    }

    // Navbar scroll behaviour
    //

    var $navbar = $('.landing-navbar');
    var $navbarCollapse = $('#landing-navbar-collapse');

    $(document).on('scroll', function(e) {
        var scrollTop = $(document).scrollTop();

        if (scrollTop > navbarScrollThreshold && !$navbar.hasClass('landing-navbar-alt')) {
            $navbar
                .addClass('landing-navbar-alt')
                .removeClass(navbarCustomClasses.default.variant + ' ' + navbarCustomClasses.default.classes)
                .addClass(navbarCustomClasses.alt.variant + ' ' + navbarCustomClasses.alt.classes)
                .find('> div')
                .removeClass('container-fluid')
                .addClass('container');
        } else if (scrollTop <= navbarScrollThreshold && $navbar.hasClass('landing-navbar-alt')) {
            $navbar.removeClass('landing-navbar-alt')
                .addClass(navbarCustomClasses.default.classes)
                .removeClass(navbarCustomClasses.alt.classes)
                .find('> div')
                .addClass('container-fluid')
                .removeClass('container');

            if ($(window).outerWidth() >= navbarBreakpoint || !$navbarCollapse.hasClass('show')) {
                $navbar
                    .addClass(navbarCustomClasses.default.variant)
                    .removeClass(navbarCustomClasses.alt.variant);
            }
        }
    });

    $navbarCollapse.on('show.bs.collapse hidden.bs.collapse', function(e) {
        if ($navbar.hasClass('landing-navbar-alt')) return;

        $navbar[e.type === 'show' ? 'removeClass' : 'addClass'](
            navbarCustomClasses.default.variant
        );

        $navbar[e.type === 'show' ? 'addClass' : 'removeClass'](
            navbarCustomClasses.alt.variant
        );
    });

    $(window).on('resize', function() {
        if ($navbar.hasClass('landing-navbar-alt')) return;

        var sm = $(this).outerWidth() < navbarBreakpoint;
        var alt = $navbar.hasClass(navbarCustomClasses.alt.variant);

        if (sm && !alt && $navbarCollapse.hasClass('show')) {
            $navbar
                .removeClass(navbarCustomClasses.default.variant)
                .addClass(navbarCustomClasses.alt.variant);
        } else if (!sm && alt) {
            $navbar
                .removeClass(navbarCustomClasses.alt.variant)
                .addClass(navbarCustomClasses.default.variant);
        }
    });

    // Anchor links
    //

    $('body').on('click', '.anchor-link', function(e) {
        e.preventDefault();
        $("html, body").stop().animate({
            scrollTop: Math.round($(this.getAttribute('href')).offset().top) + 'px'
        }, 500);
    });

    // Main slider
    //

    $('#landing-slider').each(function() {
        new Swiper(this, {
            autoHeight: true,
            speed: 1000,
            followFinger: false,
            threshold: 50,
            preventClicks: true,
            navigation: {
                nextEl: '#landing-slider-next',
                prevEl: '#landing-slider-prev'
            }
        });
    });

    $('#landing-slider-parallax').each(function() {
        new Swiper(this, {
            parallax: true,
            autoHeight: true,
            speed: 1000,
            followFinger: false,
            threshold: 50,
            preventClicks: true,
            navigation: {
                nextEl: '#landing-slider-next',
                prevEl: '#landing-slider-prev'
            }
        });
    });

    // Introducing video
    //

    $('#landing-video').each(function() {
        plyr.setup(this, {
            tooltips: {
                controls: false,
                seek: true
            }
        })[0];
    });

    // App preview
    //

    $('#landing-preview-slider').each(function() {
        new Swiper(this, {
            slidesPerView: 3,
            spaceBetween: 0,
            threshold: 50,
            speed: 400,
            centeredSlides: true,
            slideToClickedSlide: true,
            breakpoints: {
                992: {
                    slidesPerView: 1,
                    spaceBetween: 20
                }
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            }
        });
    });

    // Reviews
    //

    $('#landing-testimonials-slider').each(function() {
        new Swiper(this, {
            navigation: {
                nextEl: '#landing-testimonials-slider-next',
                prevEl: '#landing-testimonials-slider-prev'
            }
        });
    });

    // Logos
    //

    $('#landing-logos-slider').each(function() {
        new Swiper(this, {
            slidesPerView: 8,
            spaceBetween: 30,
            breakpoints: {
                1200: {
                    slidesPerView: 7,
                },
                992: {
                    slidesPerView: 6,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                576: {
                    spaceBetween: 0,
                },
                480: {
                    slidesPerView: 3
                },
                380: {
                    slidesPerView: 2
                }
            },
            navigation: {
                nextEl: '#landing-logos-slider-next',
                prevEl: '#landing-logos-slider-prev'
            }
        });
    });

});
