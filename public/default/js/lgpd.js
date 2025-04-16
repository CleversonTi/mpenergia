function verificarTermos() {

    var cache_lgpd = window.localStorage.getItem('termos-lgpd');

    if (!cache_lgpd) {
        // console.log('mostrar barra');
        $('#bar-lgpd').addClass('exibir');
    } else if (cache_lgpd) {
        // console.log('não mostrar barra');
    }
}

function aceitarTermos() {

    window.localStorage.setItem('termos-lgpd', true);
    $('#bar-lgpd').removeClass('exibir');

}

verificarTermos();


