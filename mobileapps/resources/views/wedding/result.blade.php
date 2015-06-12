<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>婚礼嘉宾信息</title>


  <link href="/css/ionic.css" rel="stylesheet">
  <script src="/js/firebase.js"></script>
  <script src="/js/ionic.bundle.min.js"></script>
  

  <script type="text/javascript">
    var u = {};
    u.isEmpty = function(data){
      return angular.isUndefined(data) || data === null || data === '';
    }

    angular.module('ionicApp', ['ionic'])
    .config(function($stateProvider, $urlRouterProvider) {
        $stateProvider
        .state('home',{
          url:"/home",
          views:{
            '':{
              templateUrl:"templates/home.html",
              controller:'HomeTabCtrl'
            }
          }
        })


       $urlRouterProvider.otherwise("/home");

    })

    .controller('HomeTabCtrl',function($scope,$http){
        console.log('home ctrl');
        $scope.recordings = [];
        $scope.show = function(){

            var fb = new Firebase('https://fiery-fire-41.firebaseio.com/wedding/attendee');
            fb.on("value",function(snapshot){
              //$scope.recordings = snapshot.val();
              snapshot.forEach(function(data){
                $scope.recordings.push(data.val());
              })
              console.log($scope.recordings);

              $scope.$apply();
            })
        };

        $scope.show();
    });
  </script>

  

  
</head>

<body ng-app="ionicApp" >

  <ion-nav-view></ion-nav-view>

  <script id="templates/home.html" type="text/ng-template">
    <ion-nav-view name="home-tab">
        
          <ion-content class="padding">
          <h2>嘉宾信息</h2>
          <div class="list">
            <div class="item" ng-repeat="r in recordings">
              <p>[姓名] <b>@{{r.basic.name}}</b> [配偶] <b>@{{r.basic.mate}}</b></p>
              <p>[人数] <b>@{{r.basic.amount}}</b> [手机] <b>@{{r.basic.mobile}}</b></p>
              <p>[单位] <b>@{{r.basic.company}}</b> [职位] <b>@{{r.basic.position}}</b></p>
              <p><b>@{{r.basic.message}}</b></p>
              
            </div>
          </div>

          </ion-content>
          </ion-nav-view>
    </ion-view>
  </script>

</body>
</html>