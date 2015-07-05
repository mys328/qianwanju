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

    .controller('HomeTabCtrl',function($scope,$http,$ionicLoading){
        
        $scope.attendee={};
        $scope.survey={};
        $scope.show = function() {
          $ionicLoading.show({
            template: '提交中...'
          });
        };
        $scope.hide = function(){
          $ionicLoading.hide();
        };

        $scope.key = null;

        $scope.save = function(){

            if(u.isEmpty($scope.attendee.name) || u.isEmpty($scope.attendee.mobile) || u.isEmpty($scope.attendee.amount)){
              alert('请填写打星号的栏位');
              return;
            }

            var attendee = {basic:$scope.attendee,survey:$scope.survey};

            $scope.show();
            var fb = new Firebase('https://fiery-fire-41.firebaseio.com/wedding');
            var attendeeRef = fb.child("attendee");
            //console.log(attendee);

            if($scope.key !== null){
              attendeeRef = attendeeRef.child($scope.key);
              attendeeRef.set(attendee,function(){
                $scope.hide();
                alert('修改成功，谢谢！');
                return;
              })
            }
            else{
              var newAttendeeRef = attendeeRef.push(attendee,function(){

                $scope.key = newAttendeeRef.key();
                //console.log($scope.key);
                $scope.hide();
                alert('提交成功，谢谢！');
              });
            }

            
        };
    });
  </script>

  

  
</head>

<body ng-app="ionicApp" >

  <ion-nav-view></ion-nav-view>

  <script id="templates/home.html" type="text/ng-template">
    <ion-nav-view name="home-tab">
        
        
          <ion-content class="padding">

          <div class="card">
            <img src="/img/wedding-banner.png" style="width:100%"/>
            <div class="item item-text-wrap">
              尊敬的长辈，领导，亲爱的朋友们，感谢您参加周毅和张雯在2015年5月31日上午11点18分在南京河西万达同庆楼举行的婚礼。麻烦您填写以下相关内容，以便我们做好座位安排及抽奖环节！
            </div>
          </div>
            <div class="list">
              <label class="item item-input item-stacked-label">
                <span class="input-label">姓名*</span>
                <input type="text" placeholder="" ng-model="attendee.name" required>
              </label>
              <label class="item item-input item-stacked-label">
                <span class="input-label">配偶姓名</span>
                <input type="text" placeholder="" ng-model="attendee.mate">
              </label>
              <label class="item item-input item-stacked-label">
                <span class="input-label">手机号码*</span>
                <input type="text" placeholder="" ng-model="attendee.mobile" required>
              </label>
              <label class="item item-input item-stacked-label">
                <span class="input-label">参加婚礼人数*</span>
                <input type="text" placeholder="" ng-model="attendee.amount" required>
              </label>
              <label class="item item-input item-stacked-label">
                <span class="input-label">单位</span>
                <input type="text" placeholder="" ng-model="attendee.company">
              </label>
              <label class="item item-input item-stacked-label">
                <span class="input-label">职位</span>
                <input type="text" placeholder="" ng-model="attendee.position">
              </label>
              <label class="item item-input item-stacked-label">
                <span class="input-label">对新人说两句</span>
                <input type="text" placeholder="" ng-model="attendee.message">
              </label>
              
            </div>
            <!--
            <div class="card">
                <div class="item item-text-wrap">
                  如果我倡导朋友圈内的资源共享，请问您可能对以下哪些资源有兴趣？
                </div>
            </div>
              
              
            <ul class="list">

                <li class="item item-toggle">
                   医疗
                   <label class="toggle toggle-assertive">
                     <input type="checkbox" ng-model="survey.medical">
                     <div class="track">
                       <div class="handle"></div>
                     </div>
                   </label>
                </li>

                <li class="item item-toggle">
                   早教
                   <label class="toggle toggle-assertive">
                     <input type="checkbox" ng-model="survey.preschool">
                     <div class="track">
                       <div class="handle"></div>
                     </div>
                   </label>
                </li>

                <li class="item item-toggle">
                   海外代购
                   <label class="toggle toggle-assertive">
                     <input type="checkbox" ng-model="survey.buyoversea">
                     <div class="track">
                       <div class="handle"></div>
                     </div>
                   </label>
                </li>

                <li class="item item-toggle">
                   鲜果配送
                   <label class="toggle toggle-assertive">
                     <input type="checkbox" ng-model="survey.fruit">
                     <div class="track">
                       <div class="handle"></div>
                     </div>
                   </label>
                </li>

                <li class="item item-toggle">
                   旅游
                   <label class="toggle toggle-assertive">
                     <input type="checkbox" ng-model="survey.trip">
                     <div class="track">
                       <div class="handle"></div>
                     </div>
                   </label>
                </li>

                <li class="item item-toggle">
                   英语教学
                   <label class="toggle toggle-assertive">
                     <input type="checkbox" ng-model="survey.english">
                     <div class="track">
                       <div class="handle"></div>
                     </div>
                   </label>
                </li>

            </ul>
            <label class="item item-input item-stacked-label">
              <span class="input-label">其他</span>
              <input type="text" placeholder="装修,信息服务.." ng-model="survey.other">
            </label>
            -->
            <button class="button button-full button-positive" ng-click="save()" >提交</button>
          </ion-content>
          </ion-nav-view>
    </ion-view>
  </script>

</body>
</html>