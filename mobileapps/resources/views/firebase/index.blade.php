<!DOCTYPE HTML>
<html>
<head>
	<script src="/js/angular.min.js"></script>
	<script src="/js/firebase.js"></script>
	<script src="/js/angularfire.min.js"></script>

	<script type="text/javascript">
	var app = angular.module("myapp",["firebase"]);
	var ref = new Firebase("https://fiery-fire-41.firebaseio.com/testdata");
	var ref2 = new Firebase("https://fiery-fire-41.firebaseio.com/testdata/messages");
	var ref3 = new Firebase("https://fiery-fire-41.firebaseio.com/testdata/filePayload");

	app.controller("myctrl",function($scope,$firebaseObject,$firebaseArray){
		

	  	var syncObject = $firebaseObject(ref);
	  	
	  	syncObject.$bindTo($scope, "data");

	  	$scope.messages = $firebaseArray(ref2);
	  	$scope.imageArray = [];

	  	$scope.addMessage = function() {
	    $scope.messages.$add({
	      text: $scope.newMessageText
	    });

	    $scope.handleFileSelect = function(evt) {
	    	alert('handleFileSelect');
			var f = evt.target.files[0];
			var reader = new FileReader();
			reader.onload = function(evt){
				var file = evt.target.result;
				ref3.push(file,function(){
					alert('file pushed');
				});
			};
			console.log('aaaa');
			
			reader.readAsDataURL(f);

		}

		ref3.on('value', function(snap) {
	      snap.forEach(function(data){
	                $scope.imageArray.push(data.val());
	                console.log($scope.imageArray);
	              });
	    });


	  };

	});

	

	



</script>
</head>
<body ng-app="myapp" ng-controller="myctrl">

<input type="text" ng-model="data.text"/>
    <!-- all changes from Firebase magically appear here! -->
    <h1>You said: @{{ data.text }}</h1>

    <ul>
    	<li ng-repeat="m in messages">
    		<input ng-model="m.text" ng-change="messages.$save(m)" />

    		<button ng-click="messages.$remove(m)">Delete Message</button>
    	</li>
    </ul>

    <form ng-submit="addMessage()">
      <input ng-model="newMessageText" />
      <button type="submit">Add Message</button>
    </form>
    <br/><br/><br/>
    <img src="" id="pano"/>
    <input type="file" accept="image/*" capture="camera" id="file-upload" ng-change="handleFileSelect" ng-model="upload"/>



    <ul>
    	<li ng-repeat="image in imageArray">
    	<img ng-src="image"/>
    	</li>
    </ul>
</body>
</html>