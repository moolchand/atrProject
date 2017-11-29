angular.module('app')

.controller("invoiceCtrl",function($scope, $mdDialog) {
  $scope.status = '  ';
  $scope.customFullscreen = false;
  
  $scope.Invoice = function(ev) {
    $mdDialog.show({
      controller: DialogController,
      templateUrl: 'viewinvoice.html',
      parent: angular.element(document.html),
      targetEvent: ev,
      clickOutsideToClose:true,
    })
  };

  function DialogController($scope, $mdDialog) {
    $scope.hide = function() {
      $mdDialog.hide();
    };

    $scope.cancel = function() {
      $mdDialog.cancel();
    };

    $scope.answer = function(answer) {
      $mdDialog.hide(answer);
    };
  }
});