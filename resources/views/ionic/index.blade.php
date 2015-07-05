<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>精选楼盘</title>

  <!--
  <link href="//code.ionicframework.com/nightly/css/ionic.css" rel="stylesheet">
  <script src="//code.ionicframework.com/nightly/js/ionic.bundle.js"></script>
  -->
  <link href="/css/ionic.css" rel="stylesheet">

  <script src="/js/ionic.bundle.min.js"></script>
  <script src="/js/firebase.js"></script>
  <script src="/js/angularfire.min.js"></script>
  <script type="text/javascript">
    var util = {};
  
    util.now = function() {
      var now     = new Date(); 
      var year    = now.getFullYear();
      var month   = now.getMonth()+1; 
      var day     = now.getDate();
      var hour    = now.getHours();
      var minute  = now.getMinutes();
      var second  = now.getSeconds(); 
      if(month.toString().length == 1) {
          var month = '0'+month;
      }
      if(day.toString().length == 1) {
          var day = '0'+day;
      }   
      if(hour.toString().length == 1) {
          var hour = '0'+hour;
      }
      if(minute.toString().length == 1) {
          var minute = '0'+minute;
      }
      if(second.toString().length == 1) {
          var second = '0'+second;
      }   
      var dateTime = year+'/'+month+'/'+day+' '+hour+':'+minute+':'+second;   
       return dateTime;
  };

  </script>
  <script type="text/javascript">
    angular.module('ionicApp', ['ionic','firebase'])

.config(function($stateProvider, $urlRouterProvider) {

  $stateProvider
    .state('tabs', {
      url: "/tab",
      abstract: true,
      templateUrl: "templates/tabs.html"
    })
    
    .state('tabs.list',{
      url:"/list",
      views:{
        'home-tab':{
          templateUrl:"templates/list.html",
          controller:'ListTabCtrl'
        }
      }
    })

    .state('tabs.listdetail',{
      url:"/detail?id",
      views:{
        'home-tab':{
          templateUrl:"templates/detail.html",
          controller:'DetailTabCtrl'
        }
      }

    })

    .state('tabs.about', {
      url: "/about",
      views: {
        'about-tab': {
          templateUrl: "templates/about.html"
        }
      }
    })
   
    .state('tabs.contact', {
      url: "/contact",
      views: {
        'contact-tab': {
          templateUrl: "templates/contact.html"
        }
      }
    });


   $urlRouterProvider.otherwise("/tab/list");

})

.controller('ListTabCtrl',function($scope,$http){
  console.log('ListTabCtrl');

  $scope.buildings = [];
  $scope.isLoading = false;
  $scope.skip = 0;
  $scope.take = 5;

  $scope.getData = function(){
    $scope.isLoading = true;
    $http.get("/index.php/buildinginfo/buildings/"+$scope.skip+"/"+$scope.take)
    .success(function(data){
      $scope.buildings = data.concat($scope.buildings);
    })
    .finally(function(data){
      $scope.isLoading = false;
      $scope.$broadcast('scroll.refreshcomplete');
    });
  }

  $scope.doRefresh = function(){
    $scope.skip =$scope.skip + $scope.take;
    $scope.getData();
  }

  $scope.getData();

})

.controller('DetailTabCtrl',function($scope,$http,$stateParams,$firebaseArray){
  $scope.building=null;

  $scope.building_id = $stateParams.id;

  $scope.getData = function(){
    $http.get("/index.php/buildinginfo/building/"+$stateParams.id)
    .success(function(data){
      $scope.building = data;
    })
  }

  var init = function(){
    
    var url = "https://qianwanju.firebaseio.com/booking/customers"
    var ref = new Firebase(url);
    $scope.customers = $firebaseArray(ref);
    $scope.customer = {};
  };


    $scope.book = function(){
    if($scope.customer!=null && $scope.customer.Name!='' && $scope.customer.Mobile!=''){
      $scope.customer.Building_id = $scope.building.id;
      $scope.customer.BuildingName = $scope.building.Name;
      $scope.customer.InsertDate = util.now();
      console.log($scope.customer.InsertDate);
      $scope.customers.$add($scope.customer);
    }
    else{
      alert('请正确填写姓名和手机，谢谢');
    }
  };
  init();
  $scope.getData();
    
});

  </script>

  
</head>

<body ng-app="ionicApp" >

  <ion-nav-bar class="bar-positive">
    <ion-nav-back-button class="button-icon ion-arrow-left-c">
    </ion-nav-back-button>
  </ion-nav-bar>

  <ion-nav-view></ion-nav-view>


  <script id="templates/tabs.html" type="text/ng-template">
    <ion-tabs class="tabs-icon-top tabs-positive">

      <ion-tab title="楼盘" icon="ion-home" href="#/tab/home">
        <ion-nav-view name="home-tab"></ion-nav-view>
      </ion-tab>
<!--
      <ion-tab title="联系看房" icon="ion-bag" ui-sref="tabs.contact">
        <ion-nav-view name="contact-tab"></ion-nav-view>
      </ion-tab>

      <ion-tab title="关于我们" icon="ion-ios-football" href="#/tab/about">
        <ion-nav-view name="about-tab"></ion-nav-view>
      </ion-tab>
-->
      

    </ion-tabs>
  </script>


  <script id="templates/list.html" type="text/ng-template">
    
    <ion-view view-title="热门">
        
      <ion-content class="padding">
            <ion-refresher
              pulling-text="Pull to refresh..."
              on-refresh="doRefresh()">
            </ion-refresher>

        <!--<ion-spinner icon="spiral" ng-show="isLoading"></ion-spinner>-->

        <ion-list can-swipe="listCanSwipe">

          <ion-item ng-repeat="item in buildings" class="item-thumbnail-left">
            <img ng-src="/uploads/coverimages/@{{item.CoverImage}}">
            <h2>@{{item.Name}}</h2>
            <p><i class="ion-social-yen"></i>@{{item.Price}}元/平米</p>
            <p>
            <a href="#/tab/detail?id=@{{item.id}}">查看详情</a>
            </p>
          </ion-item>
        </ion-list>
      </ion-content>
    </ion-view>
  </script>

  <script id="templates/detail.html" type="text/ng-template">
    <style>
      .item, .item p, .item div p{ white-space:normal; }
    </style>
    <ion-view view-title="楼盘信息">
      <ion-content class="padding">
        <h2>@{{building.Name}}</h2>
        <ion-list>
          <ion-item>
            <ion-card><img src="/uploads/coverimages/@{{building.CoverImage}}" style="max-width: 100%;height: auto;"/></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-ios-home"></i> 开发商 <b>@{{building.developer.Name}}</b>
          </ion-item>
          <ion-item>
            <ion-card></i>物业公司  <b>@{{building.propertycompany.Name}}</b></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-social-yen"></i>均价  <b>@{{building.Price}}</b>元/平米</ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-ios-calendar-outline"></i>开盘日期  <b>@{{building.OpenTime}}</b></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-android-home"></i>物业类型  <b>@{{building.PropertyType}}</b></ion-card>
           </ion-item>
          <ion-item>
            <ion-card><i class="ion-android-home"></i>建筑类型  <b>@{{building.BuildingType}}</b></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-person-stalker"></i>户数  <b>@{{building.DoorAmount}}</b></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-android-car"></i>车位数量  <b>@{{building.StallAmount}}</b></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-hammer"></i>装修  <b>@{{building.Fitment}}</b></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-ios-calendar-outline"></i>容积率  <b>@{{building.Volume}}</b></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-leaf"></i>绿化率  <b>@{{building.GreenPercentage}}</b></ion-card>
          </ion-item>
          <ion-item>
            <ion-card><i class="ion-cash"></i>物业费  <b>@{{building.PropertyFee}}</b></ion-card>
          </ion-item>
          <ion-item>
            <div ng-bind-html='building.News'></div>
          </ion-item>
          <ion-item>
            <ion-card>
            <div class="list">
              <h3>预约看房</h3>
              <label class="item item-input">
                <input type="text" placeholder="姓名" ng-model="customer.Name"/>
              </label>
              <label class="item item-input">
                <input type="text" placeholder="手机" ng-model="customer.Mobile"/>
              </label>
             
              <button class="button button-block button-positive" ng-click="book()">
                预约
              </button>
            </div>
            </ion-card>
          </ion-item>

        </ion-list>
      </ion-content>
    </ion-view>
  </script>
  

  

  <script id="templates/about.html" type="text/ng-template">
    <ion-view view-title="About">
      <ion-content class="padding">
        <h3>Create hybrid mobile apps with the web technologies you love.</h3>
        <p>Free and open source, Ionic offers a library of mobile-optimized HTML, CSS and JS components for building highly interactive apps.</p>
        <p>Built with Sass and optimized for AngularJS.</p>
        <p>
          <a class="button icon icon-right ion-chevron-right" href="#/tab/navstack">Tabs Nav Stack</a>
        </p>
      </ion-content>
    </ion-view>
  </script>

  <script id="templates/contact.html" type="text/ng-template">
    <ion-view title="Contact">
      <ion-content>
        <div class="list">
          <div class="item">
            @IonicFramework
          </div>
          <div class="item">
            @DriftyTeam
          </div>
        </div>
      </ion-content>
    </ion-view>
  </script>

</body>
</html>