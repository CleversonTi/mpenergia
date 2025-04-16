jQuery(function() {

    /*  Máscaras Campos */
    var behavior = function(val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
        options = {
            onKeyPress: function(val, e, field, options) {
                field.mask(behavior.apply({}, arguments), options);
            }
        };

    $('.telefone, .celular').mask(behavior, options);


    var cpf = function(val) {


        return '000.000.000-00';
    },
        opcoes = {
            onKeyPress: function(val, e, field, options) {
                field.mask(cpf.apply({}, arguments), options);
            }
        };

    $('.cpf').mask(cpf, opcoes);

    $('.mask-money').mask("#.##0,00", {reverse: true});

    $('.hora').mask('00:00');

    $('.dia').mask('00/00/0000');

    var cnpj = function(val) {


        return '00.000.000/0000-00';
    },
        opcoes = {
            onKeyPress: function(val, e, field, options) {
                field.mask(cnpj.apply({}, arguments), options);
            }
        };

    $('.cnpj').mask(cnpj, opcoes);

    /*  Bar Fixed   */
    $(window).on('scroll', function() {
        if($(this).scrollTop() > 250 && window.innerWidth >= 992) {
            $('.barra-fixa').removeClass('oculta');
            $('.botao_whatsapp').addClass('scroll');
        } else {
            $('.barra-fixa').addClass('oculta');
            $('.botao_whatsapp').removeClass('scroll');
        }

    });

    /* FUNCTION RESIZE */
    var resolucao_progrmaacao = 1920;
    var resolucao_minima = 992;

    window.onresize = function() {
        redimensionar();
    };

    function redimensionar() {
        var largura = window.innerWidth;
        if(largura >= resolucao_minima && resolucao_progrmaacao > largura) {
            var proporcao = (largura / resolucao_progrmaacao);
            $('body').css('zoom', proporcao);
        } else {
            $('body').css('zoom', 'unset');
        }
    }

    redimensionar();

    $("#preloader").fadeOut('slow');

    // $('.counterup').counterUp({
    //     delay: 100, // the delay time in ms
    //     time: 1500 // the speed time in ms
    // });

});