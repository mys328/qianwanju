@extends('layouts.backendmaster')

@section('title','上传楼盘图片')

@section('content')
  <script src="/js/angular.min.js"></script>
  <script type="text/javascript">
    angular.module("myapp",[])
    .controller("mycontroller",function($scope,$http){
      $scope.imgForms = [];
      $scope.addImageInput = function(){
        $scope.imgForms.push({id:1});
      }
    })
  </script>
  <div ng-app="myapp" ng-controller="mycontroller">
    <form>
      <input type="button" ng-click="addImageInput()" class="btn btn-danger" value="添加上传框"/>
      <ul ng-repeat="item in imgForms">
        <input type="file"/>
      </ul>
    </form>
  </div>
@stop