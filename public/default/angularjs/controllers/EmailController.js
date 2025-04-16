raddarSite.controller('EmailController', ['$scope', '$rootScope', '$http', 'Upload', '$timeout', function($scope, $rootScope, $http, Upload, $timeout) {

    var $baseUrl = $scope.baseUrl = $('base').attr('href');

    /*  Função para validar formulários*/
    var validarFormularios = function(formularioErros) {
        if(formularioErros && formularioErros.required) {
            angular.forEach(formularioErros.required, function(value, key) {
                inputName = value.$name;
                elemento = angular.element($("[name=" + inputName + "]")).addClass('campo-invalido');
            });
        }
    };


    /*  Disparo de E-mail*/

    $scope.submitForm = function(e, link, formularioErros) {


        var formElement = angular.element(e.target).closest('form');
        var nameForm = formElement[0].name;


        if(angular.isUndefined($scope.form) || angular.isString($scope.form) || $scope.form == null || !$scope.form) {
            $scope.form = {};
        }

        /*  Dados aplicados fora do formulários*/
        if($rootScope.formulario) {
            angular.forEach($rootScope.formulario, function(value, key) {
                switch(key) {
                    default:
                        $scope.form[key] = value;
                        break;
                }
            });
        }

        $scope.form.form_name = nameForm;
        validarFormularios(formularioErros);


        eval("var validateF = $scope." + nameForm + ".$valid;");

        if(!validateF) {

            Swal.fire({
                title: 'Dados Incompletos',
                text: "Preencha todos os campos obrigatórios do formulários",
                icon: 'warning',
                timer: 3000,
                timerProgressBar: true,
            });

            return;
        }

        if($scope.ajaxPendente) return;
        $scope.ajaxPendente = true;

        Swal.fire({
            title: 'Enviando...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        if(angular.isDefined(link) && (link.length > 0)) {

            zapTexto = 'Contato efetuado pelo site, dados do formulário: \n';

            a = 0;
            for(var i in $scope.form) {
                if(i !== 'form_name' && $scope.form[i] && $scope.form[i].length > 0) {
                    zapTexto += i + ': ' + $scope.form[i] + ' \n';
                    a++;
                }
            }

            zapTexto = '?text=' + encodeURIComponent(zapTexto);

            link += zapTexto;

            $timeout(function() {
                window.open(link, '_blank');
            }, 200);
        }

        $http({
            method: 'POST',
            url: $baseUrl + "enviar-email",
            data: $scope.form
        }).then(function successCallback(response) {

            $scope.ajaxPendente = false;

            if(response.data.status) {

                Swal.fire({
                    icon: 'success',
                    title: 'Formulário Enviado',
                    text: 'Formulário enviado, redirecionando...',
                });

                if(nameForm == 'carrinho') {
                    window.location = $baseUrl + 'carrinho/enviado';
                } else {
                    window.location = $baseUrl + 'formulario-enviado?path=' + nameForm;
                }


            } else {
                setTimeout(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Desculpe mas não foi possível enviar!',
                        showCloseButton: true,
                        confirmButtonText: 'Continuar'
                    });
                }, 1500);
            }


        }, function errorCallback(response) {

            $scope.ajaxPendente = false;

            setTimeout(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Desculpe mas não foi possível enviar!',
                    showCloseButton: true,
                    confirmButtonText: 'Continuar'
                });
            }, 1500);
        });

    };

    /*  Upload Function File*/
    $scope.uploadFiles = function(file, errFiles) {
        $scope.loadingFile = true;

        $scope.f = file;
        $scope.errFile = errFiles && errFiles[0];

        if(file) {

            file.upload = Upload.upload({
                url: $baseUrl + 'file-upload',
                data: {file: file}
            });

            file.upload.then(function(response) {

                $timeout(function() {
                    file.result = response.data.file;
                    $rootScope.formulario.arquivo = response.data.file_url;
                    $scope.loadingFile = false;

                });

            }, function(response) {

                if(response.status > 0)
                    $scope.errorMsg = response.status + ': ' + response.data;
                $scope.loadingFile = false;


            }, function(evt) {
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        }
    };

    $scope.removerProdutoFormulario = function (produto) {
        var index = $scope.form.produtos.indexOf(produto);
        $scope.form.produtos.splice(index, 1);
    };


}]);
