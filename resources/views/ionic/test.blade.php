<html ng-app="ionicApp">
<head>
	 <link href="//code.ionicframework.com/nightly/css/ionic.css" rel="stylesheet">
    <script src="//code.ionicframework.com/nightly/js/ionic.bundle.js"></script>
    <script type="text/javascript">
    	angular.module('ionicApp', ['ionic'])

	    .controller('MyCtrl', function($scope) {


	    })
	    .config(function($stateProvider) {
	      $stateProvider
	      .state('index', {
	        url: 'ionic',
	        templateUrl: 'home.html'
	      })
	      .state('music', {
	        url: '/music',
	        templateUrl: 'music.html'
	      });
	    });
    </script>
</head>
<body ng-controller="MyCtrl">
	<script id="home" type="text/ng-template">
  <!-- The title of the ion-view will be shown on the navbar -->
    <ion-view view-title="Home">
      <ion-content ng-controller="HomeCtrl">
        <!-- The content of the page -->
        <a href="#/music">Go to music page!</a>
      </ion-content>
    </ion-view>
  </script>

  <ui-view>
  </ui-view>

</body>
</html>