$(document).ready(function() {

    let navText = [`<svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21" fill="none">
  <path d="M5.16594 11.6544L21.5922 11.6544L21.5922 8.99903L5.16594 8.99904L12.4047 1.87734L10.4965 -4.58818e-07L4.51395e-07 10.3267L10.4965 20.6534L12.4047 18.7761L5.16594 11.6544Z" fill="#10404B"/>
</svg>`, `<svg xmlns="http://www.w3.org/2000/svg" width="23" height="21" viewBox="0 0 23 21" fill="none">
  <path d="M17.0181 11.6544L0.591793 11.6544L0.591793 8.99903L17.0181 8.99904L9.77929 1.87734L11.6875 -4.58818e-07L22.184 10.3267L11.6875 20.6534L9.77928 18.7761L17.0181 11.6544Z" fill="#10404B"/>
</svg>`];

    $('.owl-banner').owlCarousel({
        mouseDrag: true,
        items: 1,
        margin: 0,
        autoHeight: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 8000,
        autoplayHoverPause: false,
        navText: navText,
        loop: true,
        nav: true
    });

    $('.owl-galeria-sobre').owlCarousel({
        mouseDrag: true,
        autoHeight: true,
        autoplay: true,
        autoplayTimeout: 8000,
        autoplayHoverPause: false,
        navText: navText,
        loop: true,
        responsive: {
            0: {
                nav: false,
                dots: true,
                margin: 0,
                items: 1
            },
            992: {
                dots: true,
                nav: false,
                margin: 15,
                items: 4
            }
        }
    });


    $('.owl-galeria-pagina-teste').owlCarousel({
        mouseDrag: true,
        autoHeight: true,
        autoplay: true,
        autoplayTimeout: 8000,
        autoplayHoverPause: false,
        navText: navText,
        loop: true,
        responsive: {
            0: {
                nav: false,
                dots: true,
                margin: 0,
                items: 1
            },
            992: {
                dots: true,
                nav: false,
                margin: 15,
                items: 4
            }
        }
    });













    setTimeout(function () {
        $('.owl-carousel').trigger('refresh.owl.carousel')
    });

    // $('.owl-galeria').owlCarousel({
    //     mouseDrag: true,
    //     autoHeight: true,
    //     autoplay: true,
    //     autoplayTimeout: 8000,
    //     autoplayHoverPause: false,
    //     navText: navText,
    //     loop: true,
    //     responsive: {
    //         0: {
    //             nav: false,
    //             dots: true,
    //             margin: 0,
    //             items: 1
    //         },
    //         992: {
    //             dots: true,
    //             nav: true,
    //             margin: 20,
    //             items: 4
    //         }
    //     }
    // });
    //
    // $('.owl-danilo').owlCarousel({
    //     mouseDrag: true,
    //     autoHeight: true,
    //     dots: true,
    //     autoplay: true,
    //     autoplayTimeout: 8000,
    //     autoplayHoverPause: false,
    //     navText: navText,
    //     loop: true,
    //     nav: false,
    //     margin: 0,
    //     items: 1
    // });
    //
    // $('.owl-produtos').owlCarousel({
    //     mouseDrag: true,
    //     autoplay: true,
    //     autoplayTimeout: 8000,
    //     autoplayHoverPause: false,
    //     navText: navText,
    //     autoHeight: true,
    //     loop: false,
    //     responsive: {
    //         0: {
    //             nav: false,
    //             dots: true,
    //             margin: 0,
    //             items: 1
    //         },
    //         992: {
    //             nav: true,
    //             dots: true,
    //             margin: 5,
    //             items: 4
    //         }
    //     }
    // });
    // $('.owl-nossa-producao').owlCarousel({
    //     mouseDrag: true,
    //     autoplay: true,
    //     autoplayTimeout: 8000,
    //     autoplayHoverPause: false,
    //     navText: navText,
    //     autoHeight: true,
    //     loop: false,
    //     responsive: {
    //         0: {
    //             nav: false,
    //             dots: true,
    //             margin: 0,
    //             items: 1
    //         },
    //         992: {
    //             nav: true,
    //             dots: true,
    //             margin: 5,
    //             items: 4
    //         }
    //     }
    // });
    // $('.owl-nossos-clientes').owlCarousel({
    //     mouseDrag: true,
    //     autoplay: true,
    //     autoplayTimeout: 8000,
    //     autoplayHoverPause: false,
    //     navText: navText,
    //     autoHeight: true,
    //     loop: false,
    //     responsive: {
    //         0: {
    //             nav: false,
    //             dots: true,
    //             margin: 0,
    //             items: 1
    //         },
    //         992: {
    //             nav: true,
    //             dots: false,
    //             margin: 10,
    //             items: 5
    //         }
    //     }
    // });
    // $('.owl-qualidade').owlCarousel({
    //     mouseDrag: true,
    //     autoplay: true,
    //     autoplayTimeout: 8000,
    //     autoplayHoverPause: false,
    //     navText: navText,
    //     autoHeight: true,
    //     loop: false,
    //     responsive: {
    //         0: {
    //             nav: false,
    //             dots: true,
    //             margin: 0,
    //             items: 1
    //         },
    //         992: {
    //             nav: true,
    //             dots: true,
    //             margin: 10,
    //             items: 4
    //         }
    //     }
    // });
    //
    // $('.owl-depoimentos').owlCarousel({
    //     mouseDrag: true,
    //     autoplay: true,
    //     autoplayTimeout: 8000,
    //     autoplayHoverPause: false,
    //     navText: navText,
    //     autoHeight: true,
    //     loop: true,
    //     responsive: {
    //         0: {
    //             nav: false,
    //             dots: true,
    //             margin: 0,
    //             items: 1
    //         },
    //         992: {
    //             nav: true,
    //             dots: false,
    //             margin: 30,
    //             items: 3
    //         }
    //     }
    // });
});
