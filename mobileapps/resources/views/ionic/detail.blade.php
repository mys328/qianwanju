<html ng-app="ionicApp">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Ionic List Directive</title>
   
    <link href="//code.ionicframework.com/nightly/css/ionic.css" rel="stylesheet">
    <script src="//code.ionicframework.com/nightly/js/ionic.bundle.js"></script>
    <script src="js/controllers.js"></script>
    <script type="text/javascript">
      angular.module('ionicApp', ['ionic'])

      .controller('MyCtrl', function($scope) {
        
        $scope.building = {!!$building->toJson()!!}
        
      });
    </script>
  </head>

  <body ng-controller="MyCtrl">
    
    <script type="text/javascript">
      
    </script>

    <ion-header-bar class="bar-positive">
     
      <h1 class="title">热门楼盘</h1>
      
    </ion-header-bar>

    <ion-content>
    
      <div class="list card">

        <div class="item">
          <h2>@{{building.Name}}</h2>
          <p>@{{building.Price}}</p>
        </div>

        <div class="item item-image">
          <img src="@{{building.CoverImage}}}">
        </div>

        <div class="item item-icon-left">
          <i class="icon ion-ios-telephone"></i>
          @{{building.DiscountInformation}}
        </div>

        <div class="item item-icon-left">
          <i class="icon ion-ios-telephone"></i>
          @{{building.News}}
        </div>

        <div class="item item-icon-left">
          <i class="icon ion-ios-telephone"></i>
          @{{building.OpenTime}}
        </div>

        <div class="item item-icon-left">
          <i class="icon ion-ios-telephone"></i>
          @{{building.Developer.Name}}
        </div>


      </div>
    </ion-content>

        
  </body>
</html>