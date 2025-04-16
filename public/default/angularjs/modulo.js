var $baseUrl =  $('base').attr('href');

var raddarSite = angular.module('raddarSite', ['ngFileUpload', 'checklist-model'],
    function ($httpProvider) {
        // Use x-www-form-urlencoded Content-Type
        $httpProvider.defaults.headers.post = {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }


    });
