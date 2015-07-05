angular.module('ionicApp', ['ionic'])

.controller('MyCtrl', function($scope) {
  
  $scope.data = {
    showDelete: false
  };
  
  $scope.edit = function(item) {
    alert('Edit Item: ' + item.id);
  };
  $scope.share = function(item) {
    alert('Share Item: ' + item.id);
  };
  
  $scope.moveItem = function(item, fromIndex, toIndex) {
    $scope.items.splice(fromIndex, 1);
    $scope.items.splice(toIndex, 0, item);
  };
  
  $scope.onItemDelete = function(item) {
    $scope.items.splice($scope.items.indexOf(item), 1);
  };
  
  $scope.items = [
    { id: 0 , title:'泰欣嘉园',img:'img/1.jpg',description:'均价4万，全款优惠'},
    { id: 1 , title:'泰欣嘉园',img:'img/2.jpg',description:'均价4万，全款优惠'},
    { id: 2 , title:'泰欣嘉园',img:'img/3.jpg',description:'均价4万，全款优惠'},
    { id: 3 , title:'泰欣嘉园',img:'img/4.jpg',description:'均价4万，全款优惠'},

    
  ];
  
});