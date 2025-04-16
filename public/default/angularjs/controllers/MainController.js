raddarSite.controller('MainController', ['$scope', '$rootScope', '$http', '$timeout', '$sce', function($scope, $rootScope, $http, $timeout, $sce) {

    var $baseUrl = $scope.baseUrl = $('base').attr('href');

    $scope.abrirModalYoutube = function(iframe) {
        if(angular.isDefined(iframe)) {
            $scope.iframeYoutube = $sce.trustAsHtml('<iframe src="https://youtube.com/embed/' + iframe + '" frameborder="0"></iframe>');
            $scope.modalYoutube = true;
            $('#videoModal').modal('show');
        }
    };

    $scope.scrollTo = (selector, offset = 0) => {
        let zoomProp = document.querySelector('body').style.zoom;
        if(!zoomProp || !zoomProp.length || zoomProp === 'unset') zoomProp = 1;

        let selectorTop = document.querySelector(selector).getBoundingClientRect().top * zoomProp;
        let selectorBody = document.body.getBoundingClientRect().top * zoomProp;

        window.scrollTo({
            behavior: 'smooth',
            top:
                selectorTop -
                selectorBody -
                offset,
        })
    }

    $scope.alterarImgPrincipal = function(ordem, classe) {
        $(classe).trigger('to.owl.carousel', [ordem, 300]);
    };

    /*  Aplicando assunto no formulario */
    $rootScope.formulario = {};
    $scope.setAssunto = function(assunto) {

        if(!assunto || assunto.length === 0) {
            delete $rootScope.formulario.assunto;
        } else {
            $rootScope.formulario.assunto = assunto;
        }

    };

    $scope.abrirZapChat = function(msg = '') {
        $rootScope.formulario.mensagem = msg;
        $scope.exibirZapChat = true;
    }

    /* CARRINHO */
    $scope.ajaxPendente = false;

    $scope.adicionarCarrinho = function(idProduto, $event, landing = null) {
        if(!$scope.ajaxPendente) {
            $scope.ajaxPendente = true;
            var btn = $event.currentTarget;
            $(btn).addClass('loading');
            $http({
                method: 'POST',
                url: $baseUrl + "carrinho/funcoes/adicionar",
                data: {id: idProduto}
            }).then(function successCallback(response) {
                if(response.data) {
                    if(landing) {
                        window.location = landing + '?returnUrl=' + window.location;
                    } else {
                        window.location = 'carrinho?returnUrl=' + window.location;
                    }
                }
            });
        }
    }

    $scope.aumentarQtdCarrinho = function(idProduto) {
        if(!$scope.ajaxPendente) {
            $scope.ajaxPendente = true;
            $('#editor' + idProduto).addClass('loading');
            $('#editorMobile' + idProduto).addClass('loading');
            $http({
                method: 'POST',
                url: $baseUrl + "carrinho/funcoes/aumentar",
                data: {id: idProduto}
            }).then(function successCallback(response) {
                if(response.data) {
                    let elem = document.getElementById('qtdCarrinho' + idProduto);
                    elem.innerHTML = parseInt(elem.innerHTML) + 1;
                    elem = document.getElementById('qtdMobileCarrinho' + idProduto);
                    elem.innerHTML = parseInt(elem.innerHTML) + 1;
                    $scope.ajaxPendente = false;
                    $('#editor' + idProduto).removeClass('loading');
                    $('#editorMobile' + idProduto).removeClass('loading');
                }
            });
        }
    }

    $scope.diminuirQtdCarrinho = function(idProduto) {
        if(!$scope.ajaxPendente) {
            $scope.ajaxPendente = true;
            $('#editor' + idProduto).addClass('loading');
            $('#editorMobile' + idProduto).addClass('loading');
            $http({
                method: 'POST',
                url: $baseUrl + "carrinho/funcoes/diminuir",
                data: {id: idProduto}
            }).then(function successCallback(response) {
                if(response.data) {
                    let elem = document.getElementById('qtdCarrinho' + idProduto);
                    if(elem.innerHTML != '1') elem.innerHTML = parseInt(elem.innerHTML) - 1;
                    elem = document.getElementById('qtdMobileCarrinho' + idProduto);
                    if(elem.innerHTML != '1') elem.innerHTML = parseInt(elem.innerHTML) - 1;
                    $scope.ajaxPendente = false;
                    $('#editor' + idProduto).removeClass('loading');
                    $('#editorMobile' + idProduto).removeClass('loading');
                }
            });
        }
    }

    $scope.removerCarrinho = function(idProduto, $event, landing = null) {
        if(!$scope.ajaxPendente) {
            $scope.ajaxPendente = true;
            var btn = $event.currentTarget;
            $(btn).addClass('loading');
            $http({
                method: 'POST',
                url: $baseUrl + "carrinho/funcoes/remover",
                data: {id: idProduto}
            }).then(function successCallback(response) {
                if(response.data) {
                    if(landing) {
                        window.location = landing;
                    } else {
                        window.location = 'carrinho';
                    }
                }
            });
        }
    }

}])
    ;
